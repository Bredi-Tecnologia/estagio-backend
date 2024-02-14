<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "category_id" => 'required|int',
            "name" => 'required|string|max:256',
            "price" => 'required|numeric|min:0'
        ];
    }

    public function validate()
    {
        return [
          "product" => [
              'category_id' => request()->category_id,
              'name' => request()->name,
              'price' => request()->price
          ]
        ];
    }
}
