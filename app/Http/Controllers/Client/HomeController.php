<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Kategorije;
use App\Models\MaliOglasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */

    public function index(Request $request): Response
    {
        $message = null;
        if ($request->get('message')) {
            $message = $request->get('message');
        }
//        dd($message);
        $companyFoundationDate = Carbon::parse(config('constants.company_foundation_date'))->age;

//        $popularCategories = \cache()->remember('homepage-popular-categories', 60*60*24, function () {
//            return Kategorije::query()
//                ->whereNotNull('parent_id')
//                ->whereHas('maliOglasesTip1')
//                ->withCount(['maliOglasesTip1'])
//                ->orderByDesc('mali_oglases_tip1_count')
//                // ->orderBy('vrstni_red')
//                ->take(7)
//                ->get();
//        });


        $popularCategories = Kategorije::query()
            // can be subcategories also
            //->whereNotNull('parent_id')
            ->whereHas('maliOglasesTip1')
            ->withCount(['maliOglasesTip1'])
            ->orderByDesc('vrstni_red')
            ->take(7)
            ->get();


        $customers = Customer::whereHas('maliOglases')
            ->withCount(['maliOglases'])
            ->orderByDesc('mali_oglases_count')
            ->havingRaw('mali_oglases_count > 3');

        $recommendedStores = $customers
            ->with('customersTrgovinas')
            ->where(['status' => true])
            ->whereHas('maliOglasesWithLimit')
            ->inRandomOrder()
            ->take(3)
            ->get()
            ->each(function ($customer) {
                $customer->load('maliOglasesWithLimit');
            });

        $customersCount = Customer::query()
            ->where(['status' => true])
            ->count();

        $productQuery = MaliOglasi::query()
            ->where(['status' => true]);
        $latestProducts = (clone $productQuery)
            ->orderByDesc('datum_vnosa')
            ->take(5)
            ->get();
        $allProductsCount = MaliOglasi::query()
            ->where(['status' => true])
            ->count();

        return response()
            ->view('client.home.index', compact(
                'companyFoundationDate',
                'popularCategories',
                'recommendedStores',
                'customersCount',
                'latestProducts',
                'allProductsCount',
                'message'
            ));
    }

    public function faq(Request $request): Response
    {
        return response()->view('client.faq.index');
    }

}
