<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserUpdateRequest;
use App\Models\Customer;
use App\Models\CustomerPackage;
use App\Models\PaidItem;
use App\Models\Regije;
use App\Models\Roles;
use App\Models\User;
use App\Repositories\ProfileRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * @var ProfileRepository
     */
    private $profileRepository;

    /**
     * UsersController constructor.
     * @param ProfileRepository $profileRepository
     */
    public function __construct(ProfileRepository $profileRepository)
    {
        parent::__construct();
        $this->profileRepository = $profileRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $users = User::query()
            ->whereHas('customer');
            /*->where('role_id', '!=', 1);*/

        //        dd($users->get());

        if (isset($data['search']) && $data['search'] !== '') {
            $users = $users->where(function ($q) use ($data) {
                $q->where('name', 'like', '%' . $data['search'] . '%')->orWhere('id', 'like', '%' . $data['search'] . '%');
            });
        }
        if (isset($data['order_by']) && $data['order_by'] !== '') {
            if ($data['order_by'] == 'created_at') {
                $users = $users->orderByDesc('created_at');
            } elseif ($data['order_by'] == 'listing_count') {
                $users = $users->whereHas('customer', function ($q) {
                    $q->whereHas('maliOglases')
                        ->withCount(['maliOglases'])
                        ->orderByDesc('mali_oglases_count');
                });

                //                $users = $users->whereHas('customer');
                //
                //                $users = $users
                ////                    ->with('maliOglases')
                //                    ->whereHas('maliOglases')
                //                    ->withCount(['maliOglases'])
                //                    ->orderByDesc('mali_oglases_count');

                //                dd($users->get());

                //dd($users->orderBy('mali_oglases_count', 'asc')->first());
            }
        }
        $users = $users->paginate(config('constants.per_page'));
        return view('dashboard.users.index', compact('users'));
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
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Roles::query()->get();
        $packages = PaidItem::query()->get();
        $regions = Regije::query()->get();
        return view('dashboard.users.edit', compact('user', 'roles', 'packages', 'regions'));
    }

    /**
     * @param UserUpdateRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->all();
        //        dd($data);
        $user = User::find($id);
        DB::beginTransaction();

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
        ]);
        //
        $customer = Customer::updateOrCreate(
            [
                'user_id' => $id,
            ],
            [
                'status' => 1,
                'username' => $data['name'],
                'email_address' => $data['email'],
                'country_code' => $data['country_code'],
                'telefon' => $data['phone'],
                'regija_id' => $data['regija_id'],
                'naslov' => $data['naslov'],
                'status' => $data['status'],
            ],
        );
        /*$customer->activePackage->update([
            'paid_item_id' => $data['package_id'],
            'package_duration' => str_replace('T', ' ', $data['package_duration']),
        ]);*/
        if(isset($data['package_id']) && $data['package_id'] != null){
            $activePackage = CustomerPackage::updateOrCreate(
                [
                    'customer_id' => $customer->id,
                ],
                [
                    'paid_item_id' => $data['package_id'],
                    'package_duration' => str_replace('T', ' ', $data['package_duration']),
                ],
            );
    }

        DB::commit();

        flash()->success('Uporabnik uspešno posodobljen!');
        return redirect()->route('users.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);
        try {
            DB::beginTransaction();
            if ($user->customer) {
                $listings = $user->customer->maliOglases;
                foreach ($listings as $item) {
                    $this->profileRepository->deleteListing($user, $item['id']);
                }
                $customer = Customer::destroy($user->customer->id);
            }

            $user->delete();
            DB::commit();

            flash()->success('Uporabnik uspešno izbrisan!');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            flash()->error('Uporabnik neuspešno izbrisan!');
            DB::rollback();
        }
    }
}
