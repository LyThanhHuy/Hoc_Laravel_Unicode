<?php

namespace App\Http\Controllers;

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
        return view('clients.add', $this->data);
    }

    public function postAdd(Request $request)
    {
        dd($request);
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

    public function downloadImage(Request $request)
    {
        // dd($request->image);
        if (!empty($request->image)) {
            $image = trim($request->image);

            $fileName = 'image_'.uniqid().'.jpg';
            // $fileName = basename($image);
            // return response()->download($image);

            // return response()->streamDownload(function () use ($image) {
            //     $imageContent = file_get_contents($image);
            //     echo $imageContent;
            // }, $findName);

            return response()->download($image, $fileName);
        }
    }
}
