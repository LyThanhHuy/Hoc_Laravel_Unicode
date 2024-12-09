<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        echo 'khoi dong';
        // return 'khoi dong dashboard';
        // Sử dụng section để check login
        
    }
    public function index() {
        return '<h2>Dashboard welcome</h2>';
    }
}
