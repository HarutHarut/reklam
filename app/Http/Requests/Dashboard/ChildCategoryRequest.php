<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ChildCategoryRequest extends FormRequest
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
    public function rules()
    {
        return [
            'tip' => ['required', 'string', 'max:255'],
//            'color_filters' => ['required'],
//            'color_dropdown' => ['required', 'string', 'max:255'],
            'parentCategory_id' => ['required'],
            'status' => ['nullable'],
            'vrstni_red' => ['required'],
        ];
    }
}
