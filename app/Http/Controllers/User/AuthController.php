<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Auth;

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

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);

        $store = $user->save();

        return $store ? redirect()->route('user.auth.index')->with('status', 'Pendaftaran berhasil, silakan masuk untuk melanjutkan')
            :  redirect()->back()->with('danger', 'Fatal Error!');
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

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('user.dashboard.index');
        } else {
            return redirect()->back()->with('danger', 'Password / Email Anda Salah');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('user.auth.index');
    }
}
