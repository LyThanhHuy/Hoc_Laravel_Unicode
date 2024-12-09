<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index() {
        return 'Home';
    }

    public function getNews() {
        return 'Danh sach tin tuc';
    }

    public function getCategories($id)
    {
        return 'Danh sach tin tuc new'.$id;
    }
}
