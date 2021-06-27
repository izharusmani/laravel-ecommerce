<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    //
    public function list()
    {
        return view('notifications');
    }
}
