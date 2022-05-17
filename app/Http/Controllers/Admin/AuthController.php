<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function indexLogin()
    {
        return view('pages.admin.auth.login');
    }
}
