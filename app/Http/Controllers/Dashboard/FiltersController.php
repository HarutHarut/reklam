<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\FilterCreateRequest;
use App\Http\Requests\Dashboard\FilterUpdateRequest;
use App\Models\Filter;
use App\Models\FilterMaliOglasi;
use App\Models\FiltersOption;
use App\Models\Kategorije;
use App\Services\FilterServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FiltersController extends Controller
{
    /**
     * @var FilterServices
     */
    private $filterServices;

    /**
     * ParentCategoriesController constructor.
     * @param FilterServices $filterServices
     */
    public function __construct(FilterServices $filterServices)
    {
        parent::__construct();
        $this->filterServices = $filterServices;
    }
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $filters = Filter::query();
        if (isset($data['search']) && $data['search'] !== '') {
            $filters = $filters->where(function ($q) use ($data) {
                $q->where('naziv', 'like', '%' . $data['search'] . '%')
                    ->orWhere('id', 'like', '%' . $data['search'] . '%');
            })
                ->orWhereHas('kategorije', function ($q) use ($data) {
                    $q->where('tip', 'like', '%' . $data['search'] . '%');
                });
        }
        $filters = $filters->paginate(config('constants.per_page'));
        return view('dashboard.filters.index', compact('filters'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getType(Request $request)
    {
        $data = $request->all();
        $type = 'options';
        if (config('constants.filter_type.' . $data['filter_type']) == 'range') {
            $type = 'range_option';
        }
        return response()->json($type, 200);

    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        //$categories = Kategorije::query()->where('parent_id', '!=', 0)->get();
        $categories=Kategorije::all();
        //$categories = Kategorije::query()
            //->where('parent_id', null)->get();
        return view('dashboard.filters.create', compact('categories'));
    }

    /**
     * @param FilterCreateRequest $request
     * @return RedirectResponse
     */
    public function store(FilterCreateRequest $request)
    {
        $data = $request->validated();
        $required = '';
        if (isset($data['is_mandatory'])) {
            $required = 'required';
        }

        try {
            DB::beginTransaction();

            $filter = Filter::create([
                'kat_id' => $data['category_id'],
                'naziv' => $data['name'],
                'tip' => $data['filter_type'],
                'is_mandatory' => $required,
            ]);

            if (isset($data['options']) && count($data['options']) && $data['options'][0] !== null) {
                foreach ($data['options'] as $item) {
                    FiltersOption::create([
                        'f_id' => $filter->id,
                        'option' => $item,
                    ]);
                }
            }
            if (isset($data['option_range']) && $data['option_range'] !== null) {
                FiltersOption::create([
                    'f_id' => $filter->id,
                    'option' => $data['option_range'],
                ]);
            }

            DB::commit();

            flash()->success('Filter created successful');
            return redirect()->route('filters.index');

        } catch (\Exception $e) {
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
        $filter = Filter::find($id);
        $categories = Kategorije::query()
            ->where('parent_id', null)->get();
        return view('dashboard.filters.edit', compact('categories', 'filter'));
    }

    /**
     * @param FilterUpdateRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(FilterUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $filter = Filter::find($id);
        $required = '';
        if (isset($data['is_mandatory'])) {
            $required = 'required';
        }

        try {
            DB::beginTransaction();

            $filter->update([
                'kat_id' => $data['category_id'],
                'naziv' => $data['name'],
                'tip' => $data['filter_type'],
                'is_mandatory' => $required,
            ]);

            if (isset($data['options']) && count($data['options']) && $data['options'][0] !== null) {
                foreach ($filter->filtersOptions as $item) {
                    $item->delete();
                }
                foreach ($data['options'] as $item) {
                    FiltersOption::create([
                        'f_id' => $filter->id,
                        'option' => $item,
                    ]);
                }
            }
            if (isset($data['option_range']) && $data['option_range'] !== null) {
                foreach ($filter->filtersOptions as $item) {
                    $item->delete();
                }

                FiltersOption::create([
                    'f_id' => $filter->id,
                    'option' => $data['option_range'],
                ]);

            }

            DB::commit();

            flash()->success('Filter uspešno posodobljen!');
            return redirect()->route('filters.index');

        } catch (\Exception $e) {
//            dd($e->getMessage());
            DB::rollback();
        }
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        DB::beginTransaction();

            $this->filterServices->deleteFilter($id);

        DB::commit();

        flash()->success('Filter delete successful!');
        return redirect()->route('filters.index');
    }
}
