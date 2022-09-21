<?php

namespace App\Http\Controllers\Client;

use App\Filters\ProductFilters;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Filter;
use App\Models\Kategorije;
use App\Models\ListingImage;
use App\Models\MaliOglasi;
use App\Models\User;
use App\Repositories\SinglePageRepository;
use App\Services\CategoryService;
use App\Services\FilterServices;
use App\Services\SinglePageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CategoryController extends Controller
{
    /**
     * @param string $slug
     * @param Request $request
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(string $slug, Request $request): Response
    {
        $data = $request->all();
        $compact = CategoryService::categoryIndex($slug, $data);

        return response()->view('client.category.index', $compact);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function apiCategory(Request $request)
    {
        $lastSlug = request()->segment(count(request()->segments()));
        $listing = MaliOglasi::where('slug', $lastSlug)->first();
        if($listing){
            $data = SinglePageService::listingData($listing->id);
            return response()->view('client.category.listingSingle', $data);
        }
        $compact = CategoryService::categoryIndex($lastSlug, $request->all());

        return response()->view('client.category.index', $compact);
    }

    /**
     * @param $listing_id
     * @return Response
     */
    public function listingSingleURL($listing_id)
    {
        $data = SinglePageService::listingData($listing_id);
        return response()->view('client.category.listingSingle', $data);
    }

    /**
     * @param string $slug
     * @param string $listingSlug
     * @return Response
     */
    public function listingSingle($slug, $listingSlug)
    {
        $product = MaliOglasi::with(['listingImages', 'customer.customersTrgovinas'])
            ->where('slug', $listingSlug)->first();
        $data = SinglePageService::listingData($product->id);

        return response()->view('client.category.listingSingle', $data);
    }

    /**
     * @param Request $request
     * @param ProductFilters $filters
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function allProducts(Request $request, ProductFilters $filters)
    {
        $data = $request->all();
        $customer = Customer::with('customersTrgovinas')->find($data['customer_id']);
        $customersTrgovinas = $customer->customersTrgovinas;
        $products = MaliOglasi::filter($filters)
            ->with('kategorijeTip0')
            ->where('user_id', $data['customer_id']);

        if (request()->get('sortType')) {
            $products = $products->sort(request()->get('sortType'));
        } else {
            $products = $products->orderBy('date_sort', 'desc');
        }
        $result = $products->paginate(config('constants.per_page'));
        $resultCount = $result->total();

        return response()->view('client.category.eshop', compact(
                'result',
                'resultCount',
                'customersTrgovinas',
                'customer'
            )
        );
    }
}
