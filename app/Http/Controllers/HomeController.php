<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public $data = [];
    public function index()
    {
        $this->data['title'] = 'Dao tao lap trinh web';
        $this->data['message'] = 'Đăng kí tài khoản thành công';
        return view('clients.home', $this->data);
    }

    public function products()
    {
        $this->data['title'] = 'San pham';
        return view('clients.products', $this->data);
    }

    public function getAdd()
    {
        $this->data['title'] = 'Thêm sản phẩm';

        $this->data['errorMessage'] = 'Vui long kiem tra du lieu nhap vao';

        return view('clients.add', $this->data);
    }

    public function postAdd(ProductRequest $request)
    {
        // $rules = [
        //     'product_name' => 'required|min:6',
        //     'product_price' => 'required|integer'
        // ];

        // $message = [
        //     'product_name.required' => 'Ten san pham bat buoc phair nhap',
        //     'product_name.min' => 'Ten san pham khong duoc nho hon 6 ki tu',
        //     'product_name.required' => 'Gia san pham bat buoc phia nhap',
        //     'product_name.integer' => 'Gia san pham phai la 1 so'
        // ];

        // $message = [
        //     'required' => 'Truong :attribute bat buoc phai nhap',
        //     'min' => 'Truong :attribute khong duoc nho hon :min ki tu',
        //     'integer' => 'Truong :attribute phai la so'
        // ];

        // $request->validate($rules, $message);


        dd($request->all());
    }

    public function putAdd(Request $request)
    {
        dd($request);
    }

    public function getArr()
    {
        $contentArr = [
            'name' => 'Laravel',
            'lesson' => 'Khóa học lập trình laravel',
            'academy' => 'Unicode Academy'
        ];

        return $contentArr;
    }
}
