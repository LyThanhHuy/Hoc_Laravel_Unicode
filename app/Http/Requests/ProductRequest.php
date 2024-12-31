<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count() > 0) {
                $validator->errors()->add('msg', 'da co loi xay ra');
            }
        });
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'create_at' => date('Y-m-d H:i:s'),
        ]);
    }

    protected function failedAuthorization()
    {
        // throw new AuthorizationException('Ban dang truy cap khu vuc cam');

        // throw new HttpResponseException(redirect('/')->with('msg', 'ban khong co quyen ruy cao')->with('type', 'danger'));

        throw new HttpResponseException(abort(404));
    }
}
