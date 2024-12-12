<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public $data = [];
    public function index() {
        $this->data['welcome'] = 'hoc lap trinh laravel tai <b>unicode</b>';
        return view('home', $this->data);
    }
}
