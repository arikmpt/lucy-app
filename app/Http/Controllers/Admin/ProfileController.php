<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use Validator;
use Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.admin.profile.index');
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

        $user = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $user->name = $request->name;
        $store = $user->save();
        
        return $store ? redirect()->route('admin.profile.index')->with('status', 'Data saved statusfully')
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

        if (Hash::check($request->old_password, Auth::guard('admin')->user()->password) == false) {
            return redirect()->back()->with('danger', 'Password lama salah');
        }

        $new_password   = Hash::make($request->new_password);
        $update = Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => $new_password ]);

        return $update ? redirect()->route('admin.profile.index')->with('status', 'Ganti password berhasil')
             : redirect()->back()->with('danger', 'Gagal ganti password');
    }
}
