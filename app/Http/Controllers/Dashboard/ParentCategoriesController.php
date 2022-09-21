<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ParentCategoryRequest;
use App\Http\Requests\Dashboard\ParentCategoryUpdateRequest;
use App\Models\Filter;
use App\Models\Kategorije;
use App\Models\MaliOglasi;
use App\Repositories\ProfileRepository;
use App\Services\FilterServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParentCategoriesController extends Controller
{
    /**
     * @var FilterServices
     */
    private $filterServices;
    /**
     * @var ProfileRepository
     */
    private $profileRepository;

    /**
     * ParentCategoriesController constructor.
     * @param FilterServices $filterServices
     * @param ProfileRepository $profileRepository
     */
    public function __construct(FilterServices $filterServices,
                                ProfileRepository $profileRepository)
    {
        parent::__construct();
        $this->filterServices = $filterServices;
        $this->profileRepository = $profileRepository;
    }
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $categories = Kategorije::query()
            ->where('parent_id', null);

        if (isset($data['search']) && $data['search'] !== '') {
            $categories = $categories->where(function ($q) use ($data) {
                $q->where('tip', 'like', '%' . $data['search'] . '%')
                    ->orWhere('id', 'like', '%' . $data['search'] . '%');
            });
        }

        $categories = $categories->paginate(config('constants.per_page'));
        return view('dashboard.categories.parent.index', compact('categories'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $is_parent = true;
        $is_child = false;
        return view('dashboard.categories.parent.create', compact('is_child', 'is_parent'));
    }

    /**
     * @param ParentCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(ChildCategoryRequest $request)
    {
        $data = $request->validated();
        $slug = Str::slug($data['tip']);
        $rows = Kategorije::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get();
        $count = count($rows) + 1;
        if ($count > 1) {
            $slug = "{$slug}-{$count}";
        }

        try {
            DB::beginTransaction();

            Kategorije::create([
                'tip' => $data['tip'],
                'slug' => $slug,
                'color_filters' => $data['color_filters'],
                'color_dropdown' => $data['color_dropdown'],
                'paid' => isset($data['paid']) ? 1 : 0,
                'status' => isset($data['status']) ? 1 : 0,
            ]);

            DB::commit();

            flash()->success('Parent category create successful!');
            return redirect()->route('parentCategories.index');

        } catch (\Exception $e) {
//            dd($e->getMessage());
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $category = Kategorije::find($id);
        $is_parent = true;
        $is_child = false;
        $customFilters = $category->filters;

        return view('dashboard.categories.parent.edit', compact('category', 'is_child', 'is_parent', 'customFilters'));
    }

    /**
     * @param ParentCategoryRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(ParentCategoryRequest $request, $id)
    {
        $data = $request->all();
        $category = Kategorije::find($id);

        $category->update([
            "tip" => $data['tip'],
            "color_filters" => $data['color_filters'],
            "color_dropdown" => $data['color_dropdown'],
        ]);

        if (isset($data['status'])) {
            foreach ($category->children as $item) {
                $item->status = 1;
                $item->save();
            }
            $category->status = 1;
        } else {
            foreach ($category->children as $item) {
                $item->status = 0;
                $item->save();
            }
            $category->status = 0;
        }

        if (isset($data['paid'])) {
            $category->paid = 1;
        } else {
            $category->paid = 0;
        }
        $category->save();

        flash()->success('Parent category updated successful');
        return redirect()->route('parentCategories.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $listings = MaliOglasi::where('tip0', $id)
            ->orWhere('tip1', $id)
            ->get();
        $filters = Filter::where('kat_id', $id)->get();

        $category = Kategorije::find($id);
        try {
            DB::beginTransaction();

            foreach ($listings as $item){
                $this->profileRepository->deleteListing(null, $item->id);
            }
            foreach ($filters as $item){
                $this->filterServices->deleteFilter($item->id);
            }


            Kategorije::destroy($id);

            DB::commit();

            flash()->success("Parent category delete successful");
            return redirect()->route('parentCategories.index');

        } catch (\Exception $e) {
            flash()->error("Parent category deleted filed");
            DB::rollback();
        }
    }
}
