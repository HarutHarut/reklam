<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdateOglasiRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Customer;
use App\Models\Favorites;
use App\Models\FilterMaliOglasi;
use App\Models\Kategorije;
use App\Models\ListingImage;
use App\Models\MaliOglasi;
use App\Models\MaliOglasiKontakt;
use App\Models\Regije;
use App\Models\User;
use App\Repositories\ProfileRepository;
use App\Services\FilterServices;
use App\Services\ImageService;
use App\Services\ProfileService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * @var FilterServices
     */
    private $filterServices;
    /**
     * @var ImageService
     */
    private $imageService;
    /**
     * @var ProfileRepository
     */
    private $profileRepository;
    /**
     * @var ProfileService
     */
    private $profileService;

    /**
     * Create a new controller instance.
     *
     * @param FilterServices $filterServices
     * @param ImageService $imageService
     * @param ProfileRepository $profileRepository
     * @param ProfileService $profileService
     */
    public function __construct(FilterServices $filterServices,
                                ImageService $imageService,
                                ProfileRepository $profileRepository,
                                ProfileService $profileService)
    {
        parent::__construct();
        $this->filterServices = $filterServices;
        $this->imageService = $imageService;
        $this->profileRepository = $profileRepository;
        $this->profileService = $profileService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $listingStatus = '';
        $checkedSort = '';
        $firstLogin = $data['firstLogin'] ?? false;
        $reset = $data['reset'] ?? false;
//        $firstLogin = false;
        $message = '';
        $profilePageSeg = '';
        $regions = Regije::where('parent_id', 0)
//            ->where('country_id', 1)
            ->get();

        $userId = Auth::id();
        $user = User::with('customer.activePackage')
            ->where('id', $userId)
            ->first();

        if (!$user->customer) {
            $firstLogin = true;
            $message = 'Please, fill in all the data';
        }

        $customer = $user->customer ?? [];

        $result = MaliOglasi::where('user_id', $user->customer->id ?? 0);
//            ->where('status', 1);

        if (isset($data['sort']) && $data['sort'] !== null) {
            if ($data['sort'] == 'cena') {
                $result = $result->orderByDesc('cena');
                $checkedSort = 'cena';
            } elseif ($data['sort'] == 'datum_vnosa') {
                $result = $result->orderByDesc('datum_vnosa');
                $checkedSort = 'datum_vnosa';
            }
        }
        if (isset($data['statusFilter']) && $data['statusFilter'] !== null) {
            $newData = $this->filterServices->userProductFilters($result, $data['statusFilter']);
            $result = $newData['query'];
            $listingStatus = $newData['listingStatus'];
        } else {
            $result = $result->where('status', 1);
        }

        $result = $result->paginate(config('constants.per_page'));


        if (isset($data['profilePageSeg']) && $data['profilePageSeg'] !== '') {
            $profilePageSeg = $data['profilePageSeg'];

            if ($profilePageSeg == 'saved') {
                $favoritesId = Favorites::where('user_id', $userId)->pluck('mali_oglasi_id');
                $result = MaliOglasi::whereIn('id', $favoritesId)
                    ->paginate(config('constants.per_page'));
            }

        }

        $allProductsCount = MaliOglasi::query()
            ->where(['status' => true])
            ->count();
        $favoritesCount = count($user->favorite);

        $page = $request->segment(2);

        $statistics = $this->profileService->statistics($user);

        return view('profile.index', compact(
            'user',
            'customer',
            'profilePageSeg',
            'result',
            'allProductsCount',
            'regions',
            'favoritesCount',
            'firstLogin',
            'message',
            'reset',
            'page',
            'statistics',
            'listingStatus',
            'checkedSort'
        ));
    }

    /**
     * @param Request $request
     * @return string
     */
    public function filter(Request $request)
    {
        $data = $request->all();
        $listingStatus = '';
        $deleteble = true;
        $user = Auth::user();
        $result = [];
        $customer = $user->customer ?? [];
        $profilePageSeg = '';

        if (isset($customer)) {
            $result = MaliOglasi::where('user_id', $user->customer->id);
            if (isset($data['filter']) && $data['filter'] !== null) {
                $newData = $this->filterServices->userProductFilters($result, $data['filter']);
                $result = $newData['query'];
                $listingStatus = $newData['listingStatus'];
            }

        }

        $statistics = $this->profileService->statistics($user);

        $result = $result->paginate(config('constants.per_page'));


        $renderInformation = view('profile.includes.pagination', compact('result', 'deleteble', 'profilePageSeg', 'statistics'))->render();

        return response()->json(
            [
                'renderInformation' => $renderInformation,
                'listingStatus' => $listingStatus
            ]
        )->getContent();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function favorite(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $userId = Auth::id() ?? 0;
        $product_id = $data['product_id'];
        $favoritesCount = 0;

        if ($userId) {
            $favorite = Favorites::where('user_id', $userId)
                ->where('mali_oglasi_id', $data['product_id'])
                ->first();
            if ($favorite) {
                $favorite->delete();
            } else {
                Favorites::create([
                    'user_id' => $userId,
                    'mali_oglasi_id' => $data['product_id'],
                ]);
            }
            $favoritesCount = count($user->favorite);
            return response()->json(['favoritesCount' => $favoritesCount], 200);

        } else {
            $favorites = $request->cookie('favorites') ?? '';
            $favoritesArr = explode(',', $favorites);
            if (in_array($product_id, $favoritesArr)) {
                $favoritesArr = array_diff($favoritesArr, [$product_id]);
                $favorites = implode(',', $favoritesArr);
                $favorites = str_replace($product_id . ',', '', $favorites);
            } else {
                $favoritesArr[] = $product_id;
                $favorites = implode(',', $favoritesArr);
            }
            $minutes = 60 * 24;
            $response = new Response('');
            $response->withCookie(cookie('favorites', $favorites, $minutes));

            $favoritesCount = MaliOglasi::whereIn('id', $favoritesArr)->count();
            return response()->json(['favoritesCount' => $favoritesCount], 200)->withCookie(cookie('favorites', $favorites, $minutes));
        }

    }

    public function packages()
    {
        return view('profile.includes.packages');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function favoriteNoAuth(Request $request)
    {
        $favorites = $request->cookie('favorites') ?? '';
        $favoritesArr = explode(',', $favorites);
        $result = MaliOglasi::whereIn('id', $favoritesArr)->paginate(config('constants.per_page'));
        $regions = Regije::where('parent_id', 0)
            ->where('country_id', 1)
            ->get();
        return view('shraneni-oglasi', compact('result', 'regions'));
    }

    /**
     * @param $id
     * @return string
     */
    public function edit($id)
    {
        $user = User::find($id);
        $regions = Regije::where('parent_id', 0)
//            ->where('country_id', 1)
            ->get();
        return view('profile.includes.edit', compact('user', 'regions'))->render();
    }

    /**
     * @param ProfileUpdateRequest $request
     * @return JsonResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        $avatar = null;

        try {
            DB::beginTransaction();

            $user->update([
                "name" => $data['name'],
                "email" => $data['email'],
            ]);

            if ($request->hasFile('profile_cover')) {
                if ($user['avatar']) {
                    $replaceURL = config("app.url") . "/storage/";
                    $delete_path = str_replace($replaceURL, '', $user['avatar']);

                    Storage::delete('public/' . $delete_path);
                }
                if ($user['profile_photo_path']) {
                    $replaceURL = config("app.url") . "/storage/";
                    $delete_path = str_replace($replaceURL, '', $user['profile_photo_path']);

                    Storage::delete('public/' . $delete_path);
                }
                $imageFileName = rand(1000000, 99999999999) . Str::slug($request->file('profile_cover')->getClientOriginalName(), '.');
                $path = $this->imageService->savePhoto($request->file('profile_cover'), 'users/' . $user->id, $imageFileName);
                $thumbPath = $this->imageService->attachment($request->file('profile_cover'), 'users/' . $user->id, $imageFileName, null, 90);
                $user['profile_photo_path'] = config("app.url") . '/storage/' . $path;
                $user['avatar'] = config("app.url") . '/storage/' . $thumbPath;
                $user->save();
            }

            $customer = Customer::updateOrCreate(
                [
                    "user_id" => $user->id
                ],
                [
                    'status' => 0,
                    "username" => $data['username'],
                    "country_code" => $data['phone_prefix'],
                    "telefon" => $data['phone'],
                    "email_address" => $data['email'],
                    "regija_id" => $data['region'],
//                    "password" => $user->password
                ]);

            if ($request->hasFile('profile_logo')) {
                if ($customer->customersTrgovinas[0]['logo']) {
                    $replaceURL = config("app.url") . "/storage/";
                    $delete_path = str_replace($replaceURL, '', $customer->customersTrgovinas[0]['logo']);
                    Storage::delete('public/' . $delete_path);
                }

                $imageFileName = rand(1000000, 99999999999) . Str::slug($request->file('profile_logo')->getClientOriginalName(), '.');
                $path = $this->imageService->savePhoto($request->file('profile_logo'), 'customersTrgovinas/' . $customer->customersTrgovinas[0]->id, $imageFileName);
                // $path = $this->imageService->attachment($request->file('profile_logo'), 'customersTrgovinas/' . $customer->customersTrgovinas[0]->id, $imageFileName, null, 90);
                $customer->customersTrgovinas[0]->logo = config("app.url") . '/storage/' . $path;
                $customer->customersTrgovinas[0]->save();
            }
            DB::commit();

            return response()->json(['message' => 'The profile updated successful'], 200);

        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    /**
     * @param $id
     * @return string
     */
    public function editPassword($id)
    {
        return view('profile.includes.change_password')->render();
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return JsonResponse
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        $customer = $user->customer;

        if (isset($data['reset']) && $data['reset'] !== null) {
            $user->update(['password' => Hash::make($data['password'])]);
            return response()->json(['message' => 'The password updated successful'], 200);
        }

        if (Hash::check($data['old_password'], Auth::user()->password)) {
            $user->update(['password' => Hash::make($data['password'])]);
            return response()->json(['message' => 'The password updated successful'], 200);
        }
        return response()->json(['message' => 'The password does not match'], 422);
    }

    /**
     * @return string
     */
    public function upgrade()
    {
        return view('profile.includes.upgrade')->render();
    }

    /**
     * @return string
     */
    public function prolong()
    {
        return view('profile.includes.prolong')->render();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $user = Auth::user();
        try {
            DB::beginTransaction();

            $this->profileRepository->deleteListing($user, $id);

            DB::commit();

            flash()->success("Oglas uspešno izbrisan");
            return redirect()->route('profile.index');

        } catch (\Exception $e) {
            flash()->error("listing deleted filed");
            DB::rollback();
        }

    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroyMany(Request $request)
    {
        $data = $request->all();
        $result = $data['result'];
        $user = Auth::user();
        try {
            DB::beginTransaction();

            foreach ($result as $item) {
                $this->profileRepository->deleteListing($user, $item['id']);
            }

            DB::commit();
            flash()->success("listings deleted success");
            return redirect()->route('profile.index');

        } catch (\Exception $e) {
            flash()->error("listings deleted filed");
            DB::rollback();
        }
    }

    /**
     * @param $listing_id
     * @return RedirectResponse
     */
    public function changeStatus($listing_id)
    {
        $listing = MaliOglasi::find($listing_id);
        $listing->status = !$listing->status;
        $listing->save();
        $className = 'active';
        if ($listing->status == 0) {
            $className = 'inactive';
        }
        return redirect()->route('profile.index');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function prologon30($id)
    {
        $listing = MaliOglasi::find($id);
        $date = $listing->datum_poteka;
        try {

            $newDate = date('Y-m-d H:i:s', strtotime($date . ' + 30 days'));
            $listing->datum_poteka = $newDate;
            $listing->warning_sent = null;
            $listing->warning_email_count = null;

            $listing->save();
            $message = "listing active sortable until $newDate";

            return response()->json($message, 200);

        } catch (\Exception $e) {
            flash()->error("listing sortable activated filed");
            DB::rollback();
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function prologon7($id)
    {
        $listing = MaliOglasi::find($id);
        $date = $listing->date_sort;
        try {

            $newDate = date('Y-m-d H:i:s', strtotime($date . ' + 7 days'));
            $listing->date_sort = $newDate;
            $listing->save();
            $message = "listing active until $newDate";

            return response()->json($message, 200);

        } catch (\Exception $e) {
            flash()->error("listing activated filed");
            DB::rollback();
        }
    }

    /**
     * @param $id
     * @return string
     */
    public function editListing($id)
    {
        $productTypes = config('constants.product_type');
        $user = Auth::user();
        $listing = MaliOglasi::where('id', $id)->where('user_id', $user->customer ? $user->customer->id : 0)->first();
        $category = FilterServices::categoryAlphaParent($listing->kategorijeTip1);
        $customFilters = $category->filters;

        $parentRegionId = $listing->regije->parent->id;
        $listingCustomFilters = $listing->customFilters()->pluck('f_o_id', 'f_id');
        if ($category->slug == 'zasebni-stiki' || $category->slug == 'storitve-in-delo') {
            $productTypes = config('constants.private_product_type');
        }

        $regions = Regije::where('parent_id', 0)
            ->where('country_id', 1)
            ->get();
        $childRegions = Regije::where('parent_id', $parentRegionId)
            ->get();

        if ($listing) {
            return view('profile.includes.editListing', compact(
                'user',
                'listing',
                'regions',
                'productTypes',
                'customFilters',
                'listingCustomFilters',
                'parentRegionId',
                'childRegions'
            ))->render();
        }
    }

    /**
     * @param UpdateOglasiRequest $request
     * @return JsonResponse
     */
    public function listingUpdate(UpdateOglasiRequest $request)
    {
        $data = $request->all();
        $orders = json_decode($data['present']);
        $present = 0;


        $customFilter = [];

        try {
            DB::beginTransaction();

            $user = Auth::user();

            $listing = MaliOglasi::find($data['listing_id']);

            if (count($orders)) {
                list($type, $number) = explode("-", $orders[0]);
                if ($type == 'edit') {

                    $presentImage = $listing->listingImagesThumb->where('present', 1)->first();
                    if (isset($presentImage)) {
                        $presentImage->present = 0;
                        $presentImage->save();
                    }
                    $newPresentImage = $listing->listingImagesThumb->find($number) ?? $listing->listingImagesThumb->first();
                    $newPresentImage->present = 1;
                    $newPresentImage->save();
                } else {
//                $present = substr($orders[0], strpos($orders[0], ":") + 1);
                    $presentImage = $listing->listingImagesThumb->where('present', 1)->first() ?? $listing->listingImagesThumb->first();

                    if (isset($presentImage)) {
                        $presentImage->present = 0;
                        $presentImage->save();
                    }

                    $present = $number;

                }
            } else {
                $newPresentImage = $listing->listingImagesThumb->first();
                if (isset($newPresentImage)) {
                    $newPresentImage->present = 1;
                    $newPresentImage->save();
                }

            }

            $listing->update([
                'tip_oglasa' => $data['tip_oglasa'],
                'naslov' => $data['naslov'],
                'opis' => $data['opis'],
                'keywords' => '',
                'datum_vnosa' => now(),
                'datum_poteka' => now(),
                'datum_poslanega_opozorila' => now(),
                'sifra' => '',
                'cena' => $data['cena'],
                'status' => 1,
                'regija_id' => $data['regija_id'],
            ]);
            if (count(json_decode($data['deleteItems']))) {

                foreach (json_decode($data['deleteItems']) as $item) {
                    $listingThumbParentId = ListingImage::where('id', $item)->first()->parent_id;
                    $listingImages = ListingImage::where(function ($q) use ($listingThumbParentId) {
                        $q->where('id', $listingThumbParentId)->orWhere('parent_id', $listingThumbParentId);
                    })->get();
                    foreach ($listingImages as $listingImage) {
                        $replaceURL = config("app.url") . "/storage/";
                        $delete_path = str_replace($replaceURL, '', $listingImage->url);
                        Storage::delete('public/' . $delete_path);
                        ListingImage::destroy($listingImage->id);
                    }

                }
            }
            if (isset($data['imgs'])) {

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
                    if ($key == $present) {
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
                foreach ($listing->customFilters as $item) {
                    $item->delete();
                }
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

            DB::commit();

            return response()->json(['message' => 'The listing updated successful'], 200);
        } catch (\Exception $e) {
//            dd($e->getMessage(), $e->getLine());
            DB::rollback();
        }
    }

}
