<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('Views/auth/login');
    }

    public function dashboard()
    {
        return view('Views/employe/dashboard');
    }
}
