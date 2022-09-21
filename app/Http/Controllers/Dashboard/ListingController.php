<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kategorije;
use App\Models\MaliOglasi;
use App\Models\Regije;
use App\Repositories\ProfileRepository;
use App\Services\DashboardServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ListingController extends Controller
{
    /**
     * @var ProfileRepository
     */
    private $profileRepository;
    /**
     * @var DashboardServices
     */
    private $dashboardServices;

    /**
     * ListingController constructor.
     * @param ProfileRepository $profileRepository
     * @param DashboardServices $dashboardServices
     */
    public function __construct(ProfileRepository $profileRepository,
                                DashboardServices $dashboardServices)
    {
        parent::__construct();
        $this->profileRepository = $profileRepository;
        $this->dashboardServices = $dashboardServices;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $categories = Kategorije::query()
//            ->where('parent_id', null)
            ->get();
        $listings = MaliOglasi::query();
        $listings = $this->dashboardServices->productFilters($listings, $data);
        $listings = $listings->paginate(config('constants.per_page'));
        return view('dashboard.listings.index', compact('listings', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
        $listing = MaliOglasi::find($id);
        $regions = Regije::query()->get();
        return view('dashboard.listings.edit', compact('listing', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
       $data=$request->all();
         $listing=MaliOglasi::find($id);
         try{
            DB::beginTransaction();
            $listing->update([
                "naslov"=>$data["naslov"],
                "cena"=>$data["cena"],
                "regija"=>$data["regija"],
                "datum_poteka"=>$data["datum_poteka"],
                "opis"=>$data["opis"],
            ]);
            DB::commit();
            flash()->success("Oglas uspešno posodobljen!");
            return redirect()->route("listings.index");
         }catch(\Exception $e){
            dd($e->getMessage());
            DB::rollback();
         }
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $this->profileRepository->deleteListing(null, $id);

            DB::commit();

            flash()->success("Oglas uspešno izbrisan");
            return redirect()->route('listings.index');

        } catch (\Exception $e) {
            flash()->error("listing deleted filed");
            DB::rollback();
        }
    }
}
