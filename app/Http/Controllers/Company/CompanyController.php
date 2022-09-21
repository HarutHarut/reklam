<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CustomersCategory;
use App\Models\CustomersTrgovina;
use App\Models\MaliOglasi;
use App\Services\FilterServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * @var FilterServices
     */
    private $filterServices;

    /**
     * CompanyController constructor.
     * @param FilterServices $filterServices
     */
    public function __construct(FilterServices $filterServices)
    {
        parent::__construct();
        $this->filterServices = $filterServices;
    }

    /**
     * @param Request $request
     * @param $slug
     * @return Application|Factory|View
     */
    public function index(Request $request, $slug = null)
    {
        $data = $request->all();
        $category = '';
        $customersTrgovinasCount = CustomersTrgovina::query();
        $customerCategories = CustomersCategory::with('customersTrgovinas');
        $results = CustomersTrgovina::with('customer.maliOglases');
        if($slug !== null){
            $category = CustomersCategory::where('slug', $slug)->first();
            $customersTrgovinasCount = $category->customersTrgovinas;
            $results = $category->customersTrgovinas();
        }
        $customersTrgovinasCount = $customersTrgovinasCount->count();
        $customerCategories = $customerCategories->get();
        $results = $this->filterServices->companyFilter($results, $data);
        $results = $results->paginate(config('constants.per_page'));
        $resultCount = $results->total();

        return view('company.eshops', compact(
            'customerCategories',
            'results',
               'category',
               'resultCount',
               'customersTrgovinasCount'
        )
        );
    }

    public function single(Request $request, $slug)
    {
        $company = CustomersTrgovina::with('listings')
            ->where('slug', $slug)
            ->first();
        $results = $company->listings()->paginate(config('constants.per_page'));
        $resultCount = $results->total();
        return view('company.companySingle', compact(
            'company',
            'results',
            'resultCount'
        ));
    }

}
