<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

/**
 * Class CryptService
 * @package App\Services
 */
class CryptService
{
    /**
     * @param $user
     * @return string
     */
    public function getResetPasswordHash($user)
    {
        return Crypt::encrypt([
            'user_id' => $user->id,
            'expires' => Carbon::now()->addHours(config('auth.password_reset_expire'))->timestamp
        ]);
    }

    public function decrypt($hash)
    {
        return Crypt::decrypt($hash);
    }
}
