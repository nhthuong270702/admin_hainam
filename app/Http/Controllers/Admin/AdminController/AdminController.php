<?php

namespace App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.dashboard');
    }
}
