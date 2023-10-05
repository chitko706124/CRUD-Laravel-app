<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsAuthenticated;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function home()
    {
        return view('dashboard.index');
    }
}
