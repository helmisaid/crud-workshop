<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Logic untuk menampilkan data dashboard 
        return view('dashboard'); 
    }
}
