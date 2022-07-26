<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Validator;
use Hash;
use Storage;
use App\Helpers\ImageUploadHelpers;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.user.profile.index');
    }

    public function dashboard()
    {
        return view('pages.user.dashboard.index');
    }

    public function update(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $user = User::findOrFail(Auth::user()->id);

        if($request->hasFile('photo')) {
            $path = ImageUploadHelpers::upload($request->file('photo'), 'profile/');
            if(Storage::disk('public')->exists($user->path)) {
                Storage::disk('public')->delete($user->path);
            }
        } else {
            $path = null;
        }
        if($path){
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->photo = $path;
        }
        else {
            $user->name = $request->name;
            $user->phone = $request->phone;
        }

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
