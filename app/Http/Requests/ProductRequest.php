<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => 'required|min:6',
            'product_price' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'truong :attribute bat buoc phair nhap',
            'product_name.min' => 'truong :attribute khong duoc nho hon 6 ki tu',
            'product_price.required' => 'truong :attribute bat buoc phia nhap',
            'product_price.integer' => 'truong :attribute phai la 1 so'
        ];
    }

    public function attributes()
    {
        return [
            'product_name' => 'Ten san pham',
            'product_price' => 'Gia san pham'
        ];
    }
}
