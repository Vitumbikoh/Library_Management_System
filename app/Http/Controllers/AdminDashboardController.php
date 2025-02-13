<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index($section = 'dashboard')
    {
        // Check if the section exists or use 'home' by default
        return view('admin.layout', ['content' => $section]);
        
    }


    
}
