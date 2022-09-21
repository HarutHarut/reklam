<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BlockPhoneRequest;
use App\Models\BlockPhone;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhoneNumbersController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $phoneNumbers = BlockPhone::query();
        if(isset($data['search']) && $data['search'] !== '' && $data['search'] !== null){
            $phoneNumbers = $phoneNumbers->where(function ($q) use ($data) {
                $q->where('phone_number', 'like', '%' . $data['search'] . '%')
                    ->orWhere('id', 'like', '%' . $data['search'] . '%');
            });
        }
        $phoneNumbers = $phoneNumbers->paginate(config('constants.per_page'));
        return view('dashboard.phone_numbers.index', compact('phoneNumbers'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard.phone_numbers.create');
    }

    /**
     * @param BlockPhoneRequest $request
     * @return RedirectResponse
     */
    public function store(BlockPhoneRequest $request)
    {
        $data = $request->validated();

        try {

            BlockPhone::create([
                'phone_number' => $data['phone_number'],
                'description' => $data['description'],
            ]);
            flash()->success('Phone number created successful');
            return redirect()->route('phone-numbers.index');

        } catch (\Exception $e) {
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
        $phone_number = BlockPhone::find($id);
        return view('dashboard.phone_numbers.edit', compact('phone_number'));
    }

    /**
     * @param BlockPhoneRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(BlockPhoneRequest $request, $id)
    {
        $data = $request->validated();
        $phone_number = BlockPhone::find($id);

        try {
            $phone_number->update([
                'phone_number' => $data['phone_number'],
                'description' => $data['description'],
            ]);

            flash()->success('Phone number uspešno posodobljen!');
            return redirect()->route('phone-numbers.index');

        } catch (\Exception $e) {
//            dd($e->getMessage());
            DB::rollback();
        }
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        BlockPhone::destroy($id);
        flash()->success('Phone number deleted successful!');
        return redirect()->route('phone-numbers.index');
    }
}
