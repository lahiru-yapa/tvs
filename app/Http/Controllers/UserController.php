<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function allUsers()
    {
        return view('users.alluser');

    }

    public function adduser()
    {
        return view('users.adduser');
    }
    
}
