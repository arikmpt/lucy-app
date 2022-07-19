<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;

class AuthController extends Controller
{
    public function indexLogin()
    {
        return view('pages.admin.auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard.index');
        } else {
            return redirect()->back()->with('danger', 'Password / Email Anda Salah');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('user.auth.index');
    }
}
