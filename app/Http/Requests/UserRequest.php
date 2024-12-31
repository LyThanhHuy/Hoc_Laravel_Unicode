<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $uniqueEmail = 'unique:users';

        if (session('id')) {
            $id = session('id');
            $uniqueEmail = 'unique:users,email,' . $id;
        }

        return [
            'fullname' => 'required|min:5',
            'email' => 'required|email,' . $uniqueEmail,
            'group_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if ($value == 0) {
                        $fail('Bat buoc phai chon nhom');
                    }
                }
            ],
            'status' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Ten bat buoc phai nhap',
            'fullname.min' => 'Ho va ten phai tu :min ki tu tro len',

            'email.required' => 'Email bat buoc phai nhap',
            'email.email' => 'Email khong dung dinh dang',
            'email.unique' => 'Email da to tai tren he thong',

            'group_id.required' => 'Nhom khong duoc de trong',
            'group_id.integer' => 'Nhom khong hop le',

            'status.required' => 'Trang thai khong duoc de trong',
            'status.integer' => 'Trang thai khong hop le',
        ];
    }
}
