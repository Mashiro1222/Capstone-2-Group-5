<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('landing'); // Ensure 'landing.blade.php' exists in 'resources/views'
    }
}