<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        $data = $request->all();
//        dd($data['user_id']);
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $data['user_id']],
            'role_id' => ['required'],
            // 'package_id' => ['required'],
            // 'package_duration' => ['required', 'string', 'max:255'],
            'country_code' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:255'],
            'regija_id' => ['required'],
            'naslov' => ['required', 'string', 'max:255'],
        ];
    }
}
