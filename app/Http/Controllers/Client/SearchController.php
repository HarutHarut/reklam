<?php

namespace App\Http\Controllers\Client;

use App\Filters\ProductFilters;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Favorites;
use App\Models\Kategorije;
use App\Models\MaliOglasi;
use App\Models\Regije;
use App\Services\FilterServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class SearchController extends Controller
{
    /**
     * @var FilterServices
     */
    private $filterServices;

    public function __construct(FilterServices $filterServices)
    {
        $this->filterServices = $filterServices;
    }

    /**
     * @param Request $request
     * @return Response|RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $filtersShow = true;
        $customer = [];
        if (isset($data['dontShowFilter'])) {
            $filtersShow = false;

        }
        if (isset($data['customer_id'])) {
            $customer = Customer::find($data['customer_id']);
        }
        $regions = Regije::where('parent_id', 0)
            ->where('country_id', 1)
            ->get();

        $checkedRegions = [];
        if (isset($data['regions'])) {
            if (!is_array($data['regions'])) {
                $checkedRegions = json_decode($data['regions']);

            } else {
                $checkedRegions = $data['regions'];
            }
        }

        $result = MaliOglasi::sort(request()->get('sortType'));
        $result = $this->filterServices->productFilters($result, $data);

        $searchResultCategories = $result
            ->with(['kategorijeTip1' => function ($query) {
                $query->select('id', 'tip', 'slug');
            }])
            ->get()
            ->groupBy('kategorijeTip0');

        $maxPrice = max_price($result);
        $result = $result->paginate(config('constants.per_page'));
        $resultCount = $result->total();
        $searchQuery = $data['searchQuery'] ?? null;
        $productTypes = config('constants.product_type');
        $allProductsCount = MaliOglasi::query()
            ->where(['status' => true])
            ->count();
        $categories = Kategorije::query()
            ->where(['status' => true, 'parent_id' => null])
            ->whereHas('maliOglasesTip0')
            ->with(['children.maliOglasesTip1'])
            ->withCount(['maliOglasesTip0'])
            ->orderBy('vrstni_red')
            ->get();

        return response()->view('client.search.index',
            compact(
                'regions',
                'result',
                'searchQuery',
                'checkedRegions',
                'searchResultCategories',
                'productTypes',
                'allProductsCount',
                'categories',
                'resultCount',
                'filtersShow',
                'customer',
                'maxPrice'
            )
        );
    }

    /**
     * @param Request $request
     * @return string
     */
    public function searchProducts(Request $request): string
    {
        $data = $request->all();
        $customFilter = [];
        $data['custom_filters'] = json_decode($data['custom_filters']) ?? [];
        foreach ($data['custom_filters'] as $key => $item) {
            $key = substr($key, strpos($key, "-") + 1);
            $customFilter[$key] = $item;
        }
        $data['custom_filters'] = $customFilter;
        $slug = $data['category'] ?? '';
        $category = '';
        if (isset($slug) && $slug !== '') {
            $category = Kategorije::query()
                ->where(['status' => true, 'slug' => $slug])
                ->with(['filters', 'children', 'kategorije.children'])
                ->firstOrFail();
        }
        $result = MaliOglasi::query();
        $result = $this->filterServices->productFilters($result, $data);
        $result = $result->paginate(config('constants.per_page'));
        $resultCount = $result->total();
        $renderInformation = view('client.includes.pagination', compact('result', 'category'))->render();

        return response()->json(
            [
                'renderInformation' => $renderInformation,
                'resultCount' => $resultCount
            ]
        )->getContent();

    }

    /**
     * @param Request $request
     * @return string
     */
    public function searchCompanyProducts(Request $request): string
    {
        $data = $request->all();
        $result = MaliOglasi::with('kategorijeTip0')
            ->where('user_id', $data['customer_id']);
        $result = $this->filterServices->productFilters($result, $data);
        $resultCount = $result->total();
        $result = $result->paginate(config('constants.per_page'));

        return view('client.includes.pagination', compact('result', 'resultCount'))->render();
    }

    /**
     * @param Request $request
     * @return string
     */
    public function searchCategories(Request $request): string
    {
        $data = $request->all();
        if (isset($data['custom_filters'])) {
            $data['custom_filters'] = [];
        }

        $searchResultCategories = MaliOglasi::sort($data['sortType'])
            ->with(['kategorijeTip0' => function ($query) {
                $query->select('id', 'tip', 'slug');
            }]);
        $searchResultCategories = $this->filterServices->productFilters($searchResultCategories, $data);
        $resultCount = count($searchResultCategories->get());
        $searchResultCategories = $searchResultCategories->get()
            ->groupBy('kategorijeTip0');

        return view('client.search._searchResultCategories', compact('searchResultCategories'))->render();
    }
}
