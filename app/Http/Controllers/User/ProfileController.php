<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Validator;
use Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.user.profile.index');
    }

    public function update(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $store = $user->save();
        
        return $store ? redirect()->route('user.profile.index')->with('status', 'Data saved statusfully')
        : redirect()->back()->with('danger', 'Failed to save');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        if (Hash::check($request->old_password, Auth::user()->password) == false) {
            return redirect()->back()->with('danger', 'Password lama salah');
        }

        $new_password   = Hash::make($request->new_password);
        $update = User::where('id', Auth::user()->id)->update(['password' => $new_password ]);

        return $update ? redirect()->route('user.profile.index')->with('status', 'Ganti password berhasil')
             : redirect()->back()->with('danger', 'Gagal ganti password');
    }
}
