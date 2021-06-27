<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    //
    public function list()
    {
        return view('doctorslist');
    }
}
