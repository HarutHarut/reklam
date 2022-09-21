<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\Customer;
use App\Models\Regije;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\CompanySearchService;
use App\Services\CryptService;
use App\Services\EmailCreateService;
use App\Services\ImageService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;
    /**
     * @var CryptService
     */
    private $crypt;
    /**
     * @var ImageService
     */
    private $imageService;

    /**
     * Create a new controller instance.
     *
     * @param CryptService $crypt
     * @param ImageService $imageService
     */
    public function __construct(CryptService $crypt, ImageService $imageService)
    {
        parent::__construct();
        $this->middleware('guest');
        $this->crypt = $crypt;
        $this->imageService = $imageService;
    }

//    /**
//     * Get a validator for an incoming registration request.
//     *
//     * @param  array  $data
//     * @return \Illuminate\Contracts\Validation\Validator
//     */
//    protected function validator(array $data)
//    {
//        return Validator::make($data, [
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            //'password' => ['required', 'string', 'min:8', 'confirmed'],
//            'password' => ['required', 'string'],
//            'tos' => ['required', 'string'],
//        ]);
//    }

    /**
     * @param $tax
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function checkTaxNumber($tax)
    {
        $companySearchService = new CompanySearchService();
        $companySearchService = $companySearchService->getCompanyByTaxNumber($tax);

        if(count($companySearchService) && $companySearchService !== null){
            $region = trim(strstr($companySearchService[0]->pošta, ' '), " ");
            $regija_id = Regije::where('regija' , $region)->first()->id;
            $data['company_name'] = $companySearchService[0]->kratko_ime && $companySearchService[0]->kratko_ime !== '/' ? $companySearchService[0]->kratko_ime : $companySearchService[0]->dolgo_ime;
            $data['company_addr'] = $companySearchService[0]->naslov;
            $data['regija_id'] = $regija_id;
            return response()->json($data, 200);
        }
        return response()->json(['message' =>'Podjetje s to davčno številko ne obstaja'], 422);

    }

    /**
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    protected function register(RegistrationRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            if ($data['user_type'] == 2) {
                $customer = Customer::create([
                    'user_id' => $user->id,
                    'status' => 0,
                    'subjekt' => $data['user_type'],
                    'username' => $data['name'],
                    'email_address' => $data['email'],
                    //'telefon' => $data['phone_prefix'] . ' ' . $data['phone'],
                    'password' => Hash::make($data['password']),
                    'company_name' => $data['company_name'],
                    'company_addr' => $data['company_addr'],
                    'regija_id' => $data['region'],
                    'country_code' => $data['phone_prefix'],
                    'telefon' => $data['phone'],
                    'company_tax_number' => $data['company_tax_number'],
                ]);
            }


            $hash = $this->crypt->getResetPasswordHash($user);

            DB::commit();

            $view = 'emails.registrationVerify';
            $viewData = [
                'subject' => "Registration verify",
                'email' => $data['email'],
                'user' => $user,
                'url' => $hash,
            ];
            EmailCreateService::create(
                $user->id,
                $data['email'],
                $viewData['subject'],
                view($view, $viewData)->render(),
                'emails.registrationVerify',
                config('constants.email_type.registrationVerify')
            );

            $message = 'Please check your email';

            return response()->json([
                'user' => $user,
                'message' => $message
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function emailVerify(Request $request)
    {
        $data = $this->crypt->decrypt($request->get('hash'));
        try {

            $user = User::query()->find($data['user_id']);

            if ($user) {
                $user->email_verified_at = date('Y-m-d h:i:s');
                $user->save();
                Auth::loginUsingId($data['user_id'], $remember = true);
                return redirect()->route('profile.index', ['firstLogin' => true]);
            }


        } catch (\Throwable $e) {
//            dd($e->getMessage());
            return $this->error(400, $e->getMessage());
        }

    }
}
