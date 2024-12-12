<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function __construct() {}

    // hiển thị danh sách chuyên mục (phương thức get)
    public function index(Request $request)
    {
        // if (isset($_GET['id'])) {
        //     echo $_GET['id'];
        // }

        $ip = $request->ip();

        // echo 'IP la'.$ip;

        // if ($request->isMethod('GET')) {
        //     echo 'Phuong thuc GET';
        // }

        $id = $request->input('id');

        return view('clients/categories/list');
    }

    // lay ra mot chuyen muc theo id (phương thức get)
    public function getCategory($id)
    {
        // return 'Danh sách chuyên mục'.$id;
        return view('clients/categories/edit');
    }

    //  cap nhat mot chuyen muc (phương thức post)
    public function updateCategory($id)
    {
        return 'Submit sửa chuyên mục' . $id;
    }

    // show form thêm dữ liệu (phương thức get)
    public function addCategory(Request $request)
    {
        // $path = $request->path();
        // echo $path;

        $cateName = $request->old('category_name', 'mac dinh');

        return view('clients/categories/add');
    }

    // them du lieu vao chuyen muc (phương thức post)
    public function handleAddCategory(Request $request)
    {

        // $allData = $request->all();
        // dd($allData);
        // if ($request->isMethod('POST')) {
        //     echo 'Phuong thuc POST';
        // }
        // print_r($allData);
        // return redirect(route('categories.add'));
        // return 'Submit thêm chuyên mục';

        // $cateName = $request->query('id');

        if ($request->has('category_name')) {
            $cateName = $request->category_name;
            $request->flash(); 
            // set session flash

            return redirect(route('categories.add'));
        } else {
            return 'Khong co category';
        }
    }

    // xóa dữ liệu (phương thức delete)
    public function deleteCategory($id)
    {
        return 'Submit xáo chuyên mục' . $id;
    }

    // xu ly lay thong tin file
    public function handleFile(Request $request) {
        
    }
}
