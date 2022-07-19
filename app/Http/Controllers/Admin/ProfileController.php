<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use Validator;

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
}
