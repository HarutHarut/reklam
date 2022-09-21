<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\OglasiRequest;
use App\Models\Bike;
use App\Models\BlockPhone;
use App\Models\Customer;
use App\Models\Filter;
use App\Models\FilterMaliOglasi;
use App\Models\Kategorije;
use App\Models\ListingImage;
use App\Models\MaliOglasi;
use App\Models\MaliOglasiKontakt;
use App\Models\Regije;
use App\Models\User;
use App\Services\FilterServices;
use App\Services\ImageService;
use App\Services\PaidService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OglasiController extends Controller
{

    /**
     * @var ImageService
     */
    private $imageService;
    /**
     * @var PaidService
     */
    private $paidService;


    /**
     * OglasiController constructor.
     * @param ImageService $imageService
     * @param PaidService $paidService
     */
    public function __construct(ImageService $imageService,
                                PaidService $paidService)
    {
        parent::__construct();
        $this->imageService = $imageService;
        $this->paidService = $paidService;
    }

    /**
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function novOglas()
    {
        $user = Auth::user() ?? null;
        $categories = Kategorije::with('children')
            ->where('parent_id', null)
            ->get();

        $aboveLimit = true;
        if ($user) {
            if($user->customer){
                $posts = MaliOglasi::where('user_id', $user->customer->id)->get();
                $postCount = $posts->count();
                if(count($user->customer->customersTrgovinas))
                {

                    if(isset($user->customer->activePackage)
                        && $user->customer->activePackage->package_duration >= Carbon::now()->format('Y-m-d H:i:s')
                        && $user->customer->activePackage->paidItem->listing_count !== null)
                    {
                        $aboveLimit = $postCount <= $user->customer->activePackage->paidItem->listing_count;
                    }else{
                        $aboveLimit = $postCount <= config('constants.post.limit');
                    }

                }
//                $aboveLimit =
//                    $postCount <= config('constants.post.limit')
//                    && count($user->customer->customersTrgovinas)
//                    && isset($user->customer->activePackage)
//                    && $user->customer->activePackage->package_duration >= Carbon::now()->format('Y-m-d H:i:s');
//                dd(count($user->customer->customersTrgovinas));
            }else{
                return redirect()->route('profile.index', ['firstLogin' => true]);
            }

        }


        $regions = Regije::where('parent_id', 0)
            ->where('country_id', 1)
            ->get();

        return view('profile.nov-oglas', compact(
            'categories',
            'aboveLimit',
            'regions'
        ));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function checkCategory(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $productTypes = 'public';
        $category = Kategorije::find($data['categoryId']);
        $category = FilterServices::categoryAlphaParent($category);
        $parentCategoryId = $category->id;
        $checkPaidCategory = 1;

        if($category->paid == 1){
            $checkPaidCategory = 0;

            if($user && $user->customer){
                $checkPaidCategory = $this->paidService->checkPremiumPackage();
            }else if(!$user && $category->paid = 1){
                $checkPaidCategory = 2;
            }
        }

//        dd($checkPaidCategory);
        $customFilters = Filter::with('filtersOptions')
            ->where('kat_id', $category->id)
            ->get();
        foreach ($customFilters as $item) {
            $item['tip'] = config('constants.filter_type.' . $item['tip']);
        }
        if ($data['step'] == 1) {
            if ($category->slug == 'zasebni-stiki' || $category->slug == 'storitve-in-delo') {
                $productTypes = 'private';
            }
        }

        return response()->json([
            'showOrRedirect' => $checkPaidCategory,
            'productTypes' => $productTypes,
            'customFilters' => $customFilters,
            'categoryId' => $data['categoryId'],
            'parentCategoryId' => $parentCategoryId,
        ],
            200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function checkRegion(Request $request)
    {
        $data = $request->all();
        $childRegion = Regije::find($data['region_id'])->child;

        return response()->json($childRegion, 200);
    }

    /**
     * @param OglasiRequest $request
     * @return JsonResponse
     */
    public function store(OglasiRequest $request)
    {
        $data = $request->validated();
        $notify_expiration = 0;
        if(isset($data['notify_expiration'])){
            $data['contact_email'];
            $notify_expiration = 1;
        }
        $orders = json_decode($data['present']);
        $present = 0;
        $status = 1;
        if(count($orders)){
            $present = substr($orders[0], strpos($orders[0], ":") + 1);
        }
        $customFilter = [];

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $customer = $user && $user !== null ? $user->customer : null;
            if(isset($data['status']) && $data['status'] !== null){
                $status = $data['status'];
            }
            $blockPhone = BlockPhone::where('phone_number', $data['phone_prefix'] . $data['phone'])->first();

            if($blockPhone){
                return response()->json(['err_message' => 'Your phone number is blocked!'], 422);
            }

            $customer_id = config('constants.nonLoggedUser');
            $slug = Str::slug($data['naslov']);
            $rows = MaliOglasi::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get();
            $count = count($rows) + 1;
            if ($count > 1) {
                $slug = "{$slug}-{$count}";
            }
            $listing = MaliOglasi::create([
                'tip_oglasa' => $data['tip_oglasa'],
                'tip1' => $data['category_id'],
                'tip0' => $data['parent_category_id'],
                'naslov' => $data['naslov'],
                'opis' => $data['opis'],
                'keywords' => '',
                'datum_vnosa' => now(),
                'datum_poteka' => now()->addDays(30),
//                'datum_poslanega_opozorila' => '0000-00-00 00:00:00',
                'sifra' => '',
                'slug' => $slug,
                'cena' => $data['cena'],
                'status' => $status,
                'regija_id' => $data['regija_id'],
                'notify_expiration' => $notify_expiration,
            ]);

            if ($data['imgs']) {
                foreach ($data['imgs'] as $key => $item) {
                    $imageFileName = rand(1000000, 99999999999) . Str::slug($item->getClientOriginalName(), '.');
                    $path = $this->imageService->savePhoto($item, 'products/' . $listing->id, $imageFileName);

                    $parentListing = ListingImage::create([
                        'parent_id' => null,
                        'listing_id' => $listing->id,
                        'title' => $item->getClientOriginalName(),
                        'url' => config("app.url") . '/storage/' . $path,
                        'sort' => 1,
                    ]);
                    $thumbPath = $this->imageService->attachment($item, 'products/' . $listing->id, $imageFileName, null, 210);
                    $thumbListing = ListingImage::create([
                        'parent_id' => $parentListing->id,
                        'listing_id' => $listing->id,
                        'title' => $item->getClientOriginalName(),
                        'url' => config("app.url") . '/storage/' . $thumbPath,
                        'sort' => 2,
                    ]);
                    if($key == $present){
                        $thumbListing->present = true;
                        $thumbListing->save();
                    }
                }
            }

            foreach ($data as $key => $value) {
                if (strpos($key, 'custom-') !== false) {
                    $key = substr($key, strpos($key, "-") + 1);
                    $customFilter[$key] = $value;
                }
            }

            if (count($customFilter)) {
                foreach ($customFilter as $key => $value) {
                    if (is_array(json_decode($value))) {
                        foreach (json_decode($value) as $item) {
                            FilterMaliOglasi::create([
                                'listing_id' => $listing->id,
                                'f_id' => $key,
                                'f_o_id' => (int)$item,
                            ]);
                        }
                    } else {
                        FilterMaliOglasi::create([
                            'listing_id' => $listing->id,
                            'f_id' => $key,
                            'f_o_id' => (int)$value,
                        ]);
                    }

                }
            }

            if (!$user) {
                if(isset($data['quick_reg'])){

                    $user = User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => Hash::make($data['password']),
                        'email_verified_at' => now()
                    ]);

                    $customer = Customer::updateOrCreate(
                        [
                            'user_id' => $user->id,
                        ],
                        [
                            'country_code' => $data['phone_prefix'],
                            'telefon' => $data['phone'],
                            'status' => 0,
                            "username" => $data['name'],
                            "email_address" => $data['contact_email'],
                            "regija_id" => $data['regija_id'],
                            "password" => $data['password'],

                        ]);
                    $customer_id = $customer->id;
                }

                MaliOglasiKontakt::create([
                    'listing_id' => $listing->id,
                    'country_code' => $data['phone_prefix'],
                    'telefon' => $data['phone'],
                    'kontakt_email' => $data['contact_email'],
                    'sms_verfied' => 0,
                ]);

            }else{
                $customer_id = $user->customer->id;
            }
            $listing->user_id = $customer_id;
            $listing->save();
            $listing['image'] = $listing->listingImagesPresent()->first()->url;
            $listing['parent_region'] = Regije::find($data['parent_regija_id'])->regija;
            $listing['region'] = Regije::find($data['regija_id'])->regija;

            DB::commit();

            return response()->json([
                'listing' => $listing,
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}
