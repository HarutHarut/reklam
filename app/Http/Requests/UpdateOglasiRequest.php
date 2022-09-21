<?php

namespace App\Http\Requests;

use App\Models\Filter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateOglasiRequest extends FormRequest
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
        $data =$request->all();
        $rules = [
            'listing_id' => ['required', 'numeric'],
//            'category_id' => ['required', 'numeric'],
            'naslov' => ['required', 'string', 'max:50'],
            'opis' => ['required', 'string', 'max:1000'],
            'cena' => ['required', 'numeric'],
            'parent_regija_id' => ['required', 'numeric'],
            'regija_id' => ['required', 'numeric'],
//            'imgs' => ['required', 'array', 'max:10'],
            'imgs' => ['nullable', 'array', 'max:10'],
            'imgs.*' => ['image', 'mimes:jpeg,png,jpg', 'max:8000'],
            'phone' => ['required'],
            'phone_prefix' => ['required'],
            'contact_email' => ['required'],
            'present' => ['required'],
            'deleteItems' => ['nullable'],
        ];

        foreach ($data as $key => $value) {
            if (strpos($key, 'custom') !== false) {
                $filter = Filter::find(substr($key, strpos($key, "-") + 1));
                if ($filter->is_mandatory == 'required') {
                    $rules[$key] = ['required'];
                }
            }
        }

        return $rules;
    }
}
