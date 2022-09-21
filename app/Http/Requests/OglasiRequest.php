<?php

namespace App\Http\Requests;

use App\Models\Filter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OglasiRequest extends FormRequest
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
            'tip_oglasa' => ['required', 'numeric'],
            'category_id' => ['required', 'numeric'],
            'parent_category_id' => ['required', 'numeric'],
            'naslov' => ['required', 'string', 'max:50'],
            'opis' => ['required', 'string', 'max:1000'],
            'keywords' => ['nullable', 'string'],
            'cena' => ['required', 'numeric'],
            'parent_regija_id' => ['required', 'numeric'],
            'regija_id' => ['required', 'numeric'],
            'imgs' => ['required', 'array', 'max:10'],
            'imgs.*' => ['image', 'mimes:jpeg,png,jpg', 'max:8000'],
            'phone' => ['required'],
            'phone_prefix' => ['required'],
            'contact_email' => ['required'],
            'present' => ['required'],
            'notify_expiration' => ['nullable'],
            'status' => ['nullable'],
        ];

        foreach ($data as $key => $value) {
            if (strpos($key, 'custom') !== false) {
                $filter = Filter::find(substr($key, strpos($key, "-") + 1));
                if ($filter->is_mandatory == 'required') {
                        $rules[$key] = ['required'];
                }
            }
        }

        if (!Auth::check() && isset($data['quick_reg'])) {
            $rules['name'] = ['required', 'string', 'max:50'];
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
            $rules['password'] = ['required', 'string'];
            $rules['tos'] = ['required'];
        }

        return $rules;
    }
}
