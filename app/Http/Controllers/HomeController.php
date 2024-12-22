<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Rules\Uppercase;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public $data = [];
    public function index()
    {
        $this->data['title'] = 'Dao tao lap trinh web';
        $this->data['message'] = 'Đăng kí tài khoản thành công';

        // $users = DB::select('SELECT * FROM users WHERE email=:email', [
        //     'email' => 'hoangan@gmail.com'
        // ]);

        // dd($users);

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

        $rules = [
            'product_name' => ['required', 'min:6'],
            'product_price' => ['required', 'integer']
        ];

        $messages = [
            'required' => 'Truong :attribute bat buoc phai nhap',
            'min' => 'Truong :attribute khong duoc nho hon :min ki tu',
            'integer' => 'Truong :attribute phai la so'
        ];

        $attributes = [
            'product_name' => 'Ten san pham',
            'product_price' => 'Gia san pham'
        ];

        // $request->validate($rules, $message);

        // $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        // $validator->validate();

        // $request->validate($rules, $messages);

        return response()->json(['status'=>'success']);

        // $validator->validate();

        // if ($validator->fails()) {
        //     $validator->errors()->add('msg', 'Vui long kiem tra lai du lieu');
        //     // return 'validate that bai';
        // } else {
        //     // return 'validate thanh cong';
        //     return redirect()->route('product')->with('msg', 'validate thanh cong');
        // }

        // return back()->withErrors($validator);
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
