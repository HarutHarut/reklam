<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ChildCategoryRequest;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChildCategoriesController extends Controller
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
            ->where('parent_id', '!=', null);

        if(isset($data['search']) && $data['search'] !== ''){
            $categories = $categories->where(function ($q) use ($data) {
                $q->where('tip', 'like', '%' . $data['search'] . '%')
                    ->orWhere('id', 'like', '%' . $data['search'] . '%');
            });
        }

        if (isset($data['vrstni_red']) && $data['vrstni_red'] !== '') {
            if ($data['vrstni_red'] == 'vrstni_red') {
                $categories = $categories->orderByDesc('vrstni_red');
            }
        }

        $categories = $categories->paginate(config('constants.per_page'));
        return view('dashboard.categories.child.index', compact('categories'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $parentCategories = Kategorije::where('parent_id', null)->get();
        $is_parent = false;
        $is_child = true;
        return view('dashboard.categories.child.create', compact('is_child', 'is_parent', 'parentCategories'));
    }

    /**
     * @param ChildCategoryRequest $request
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
                'parent_id' => $data['parentCategory_id'],
//                'color_dropdown' => $data['color_dropdown'],
//                'paid' => isset($data['paid']) ? 1 : 0,
                'status' => isset($data['status']) ? 1 : 0,
                'vrstni_red' => $data['vrstni_red'],
            ]);

            DB::commit();

            flash()->success('Child category create successful!');
            return redirect()->route('childCategories.index');

        } catch (\Exception $e) {
//            dd($e->getMessage());
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
        $parentCategories = Kategorije::where('parent_id', null)->get();
        $category = Kategorije::find($id);
        $is_parent = false;
        $is_child = true;
        return view('dashboard.categories.child.edit', compact('category', 'is_child', 'is_parent', 'parentCategories'));
    }

    /**
     * @param ChildCategoryRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(ChildCategoryRequest $request, $id)
    {
        $data = $request->all();
        $category = Kategorije::find($id);

        $category->update([
            "tip" => $data['tip'],
            "parent_id" => $data['parentCategory_id'],
            'status' => isset($data['status']) ? 1 : 0,
            'vrstni_red' => $data['vrstni_red'],
        ]);

        flash()->success('Child category updated successful');
        return redirect()->route('childCategories.index');
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

            flash()->success("Child category delete successful");
            return redirect()->route('childCategories.index');

        } catch (\Exception $e) {
            flash()->error("Child category deleted filed");
            DB::rollback();
        }

    }
}
