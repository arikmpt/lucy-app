<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function indexLogin()
    {
        return view('pages.user.auth.login');
    }

    public function indexRegister()
    {
        return view('pages.user.auth.register');
    }
}
