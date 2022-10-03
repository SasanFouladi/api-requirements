<?php

namespace App\Http\Requests\API\V1;

use Illuminate\Foundation\Http\FormRequest;

class ProductListRequest extends FormRequest
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
            'category' => ['nullable', 'string'],
            'price_from' => ['nullable', 'integer', 'min:0'],
            'price_to' => ['nullable', 'integer', 'gt:price_from','max:99999999'],
            'per_page' => ['sometimes', 'integer', 'min:5', 'max:50']
        ];
    }
}
