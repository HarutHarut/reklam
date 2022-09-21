<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProfileUpdateRequest extends FormRequest
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
//        $data = $request->all();
        if(isset($data['profile_logo']) || isset($data['profile_cover'])){
//            $rules['profile_logo'] = ['required', 'file', 'max:5000'];
//            $rules['profile_cover'] = ['required', 'file', 'max:5000'];
            $rules['profile_logo'] = ['nullable', 'file', 'max:5000'];
            $rules['profile_cover'] = ['nullable', 'file', 'max:5000'];
        }

        return [
            "user_id" => ['required'],
            "name" => ['required', 'string', 'max:255'],
            "email" => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->user()->id],

            "username" => ['required', 'string', 'max:255'],
            "phone_prefix" =>  ['required', 'string', 'max:255'],
            "phone" => ['required', 'numeric'],
            "region" => ['required']
        ];

//        return $rules;
    }
}
