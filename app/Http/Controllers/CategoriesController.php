<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function __construct() {}

    // hiển thị danh sách chuyên mục (phương thức get)
    public function index()
    {
        // return 'Danh sách chuyên mục';
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
    public function addCategory()
    {
        return view('clients/categories/add');
    }

    // them du lieu vao chuyen muc (phương thức post)
    public function handleAddCategory()
    {
        return redirect(route('categories.add'));
        // return 'Submit thêm chuyên mục';
    }

    // xóa dữ liệu (phương thức delete)
    public function deleteCategory($id)
    {
        return 'Submit xáo chuyên mục' . $id;
    }
}
