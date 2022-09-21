<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdatePasswordRequest extends FormRequest
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
//            'old_password' => ['required'],
            'password' => ['required', 'confirmed'],
            'reset' => ['nullable'],
        ];

        if(isset($data['old_password']) && $data['old_password'] !== null){

            $rules['old_password'] = ['required'];
        }
        return $rules;
    }
}
/**
 * Get the validation rules that apply to the request.
 *
 * @return array<string, mixed>
 */
