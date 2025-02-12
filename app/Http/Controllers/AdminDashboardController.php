<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index($section = 'home')
    {
        // Check if the section exists or use 'home' by default
        return view('admin.dashboard', ['content' => $section]);
    }
}
