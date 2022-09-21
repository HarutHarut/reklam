<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RegistrationRequest extends FormRequest
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
     * @param Request $request
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        $data = $request->all();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password' => ['required', 'string'],
            'tos' => ['required', 'string'],
            'user_type' => ['required', 'string'],
        ];

        if ($data['user_type'] == 2) {
            $rules['company_tax_number'] = ['required', 'string', 'unique:customers'];
            $rules['company_name'] = ['required', 'string', 'max:255'];
            $rules['company_addr'] = ['required', 'string', 'max:255'];
            $rules['region'] = ['required'];
            $rules['phone_prefix'] = ['required'];
            $rules['phone'] = ['required'];

        }
        return $rules;
    }
}
