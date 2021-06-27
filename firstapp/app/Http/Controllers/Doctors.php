<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Doctors extends Controller
{
    function list()
    {
        return view('doctorslist');
    }
} 
