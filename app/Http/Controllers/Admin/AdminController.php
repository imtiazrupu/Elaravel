<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.admin_login');
    }

    public function index()
    {
        return view('backend.dashboard_content');
    }
}
