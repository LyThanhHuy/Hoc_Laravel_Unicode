<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    //
    public function index()
    {
        // return 'Home';
        $title = 'Hoc lap trinh web tai unicode';
        $content = 'Hoc lap trinh laravel 8x tai unicode';

        // $dataView = [
        //     'titleData' => $title,
        //     'contentData' => $content
        // ];
        // return view('home', compact('title', 'content'));
        // return view('home')->with('title', $title);
        return view('home')->with(['title'=>$title, 'content'=>$content]);
        // return View::make('home')->with(['title' => $title, 'content' => $content]);

        // $contentView = view('home')->render();
        // // $contentView = $contentView->render();
        // return $contentView;
    }

    public function getNews()
    {
        return 'Danh sach tin tuc';
    }

    public function getCategories($id)
    {
        return 'Danh sach tin tuc new' . $id;
    }

    public function getProductDetail($id) {
        return view('clients.products.detail', compact('id'));
    }
}
