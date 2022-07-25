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

class BuktiBayarController extends Controller
{
    public function index()
    {
        return view('pages.user.pembayaran.index');
    }

    public function update(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $user = User::findOrFail(Auth::user()->id);

        if($request->hasFile('photo')) {
            $path = ImageUploadHelpers::upload($request->file('photo'), 'bukti/');
            if(Storage::disk('public')->exists($user->path)) {
                Storage::disk('public')->delete($user->path);
            }
        } else {
            $path = null;
        }
        if($path){
            $user->status = "Sudah Bayar";
            $user->struk = $path;
        }
        else {
            return redirect()->back()->with('danger', 'Failed to save');
        }

        $store = $user->save();
        
        return $store ? redirect()->route('user.pembayaran.index')->with('status', 'Data saved statusfully')
        : redirect()->back()->with('danger', 'Failed to save');
    }
}
