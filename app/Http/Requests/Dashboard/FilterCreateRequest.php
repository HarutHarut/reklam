<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FilterCreateRequest extends FormRequest
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
//        dd($data);
        $rules = [
            'category_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'filter_type' => ['required'],
            'is_mandatory' => ['nullable'],
        ];

        if($data['filter_type']){
//            dd(!$data['option_range']);
            if(!$data['option_range'] || $data['option_range'] == null){

                $rules['options'] = ['array'];
                $rules['options.*'] = ['required'];
            }else{
                $rules['option_range'] = ['required'];
            }
        }

        return $rules;
    }
}
