<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('main.dashboard');
    }

    public function employees()
    {
        return view('main.employees');
    }

    public function departments()
    {
        return view('main.departments');
    }
}
