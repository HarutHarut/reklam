<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Models\Regije;
use App\Models\User;
use App\Services\CryptService;
use App\Services\EmailCreateService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Mockery\Exception;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * @var CryptService
     */
    private $crypt;

    public function __construct(CryptService $crypt)
    {
        $this->crypt = $crypt;
    }

    /**
     * @return Application|Factory|View
     */
    public function forgot()
    {
        $regions = Regije::where('parent_id', 0)
            ->where('country_id', 1)
            ->get();
        return view('auth.passwords.forgot', compact('regions'));
    }

    /**
     * @param ForgotPasswordRequest $request
     * @return Application|Factory|View
     */
    public function forgotUpdate(ForgotPasswordRequest $request)
    {
        $data = $request->validated();
        $regions = Regije::where('parent_id', 0)
            ->where('country_id', 1)
            ->get();
        $user = User::where('email', $data['email'])->first();
        $message = 'Please checke your email';

        if (!$user) {
            $message = 'User not found.';
        }else{
            $hash = $this->crypt->getResetPasswordHash($user);
            $view = 'emails.forgot';
            $viewData = [
                'subject' => "ForgotPassword",
                'user' => $user,
                'url' => $hash,
            ];
            EmailCreateService::create(
                $user->id,
//                $product->customer->email_address,
                $user->email,
                $viewData['subject'],
                view($view, $viewData)->render(),
                'emails.forgot',
                config('constants.email_type.forgot_password')
//
            );
        }

        return view('auth.passwords.forgot', compact('message', 'regions'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function resetPassword(Request $request)
    {

        $data = $this->crypt->decrypt($request->get('hash'));
        try {

            $user = User::query()->find($data['user_id']);

            if ($user) {
                Auth::loginUsingId($data['user_id'], $remember = true);
                return redirect()->route('profile.index', ['firstLogin' => true, 'reset' => true]);
            }


        } catch (\Throwable $e) {
//            dd($e->getMessage());
            return $this->error(400, $e->getMessage());
        }

    }

}
