<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return response()->json(['message' => 'Welcome to Home Page']);
    }

    public function about()
    {
        return response()->json(['message' => 'This is the About Page']);
    }
}
