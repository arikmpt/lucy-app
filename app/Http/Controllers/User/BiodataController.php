<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolMajor;
use App\Models\Cluster;
use App\Models\User;
use App\Models\UserFather;
use App\Models\UserMother;
use App\Models\UserSchool;
use App\Models\Prodi;
use Auth;
use DB;
use Validator;

class BiodataController extends Controller
{
    public function index()
    {

        if(!Auth::user()->father || !Auth::user()->mother || !Auth::user()->school) {
            return redirect()->route('user.biodata.edit');
        }
        return view('pages.user.biodata.index');
    }

    public function edit()
    {
        $schoolMajors = SchoolMajor::pluck('name','name');
        $schoolClusters = Cluster::pluck('name','name');
        $prodi = Prodi::pluck('name','name');
        return view('pages.user.biodata.edit')->with([
            'user' => User::findOrFail(Auth::user()->id),
            'prodi' => $prodi,
            'schoolMajors' => $schoolMajors,
            'schoolClusters' => $schoolClusters 
        ]);
    }

    public function update(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'id'    => 'required',
                'email' => 'required|unique:users,email,'.$request->id,
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            DB::beginTransaction();

            // Save User
            $user = User::findOrFail($request->id);
            $user->nim = $request->nim;
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password =  bcrypt('123456789');
            $user->date_of_birth = $request->date_of_birth;
            $user->place_of_birth = $request->place_of_birth;
            $user->gender = $request->gender;
            $user->major = $request->major;
            $user->status = 'Belum Bayar';
            $storeUser = $user->save();

            // Save School
            $school = UserSchool::where('user_id', $request->id)->first() ? UserSchool::where('user_id', $request->id)->first() : new UserSchool;
            $school->name = $request->school_name;
            $school->address = $request->school_address;
            $school->major = $request->school_major;
            $school->year_graduate = $request->school_year_graduate;
            $school->score = $request->school_score;
            $school->cluster = $request->school_cluster;
            $school->user_id = $request->id;
            $storeSchool = $school->save();

            // Save Father
            $father = UserFather::where('user_id', $request->id)->first() ? UserFather::where('user_id', $request->id)->first() : new UserFather;
            $father->name = $request->father_name;
            $father->job = $request->father_job;
            $father->address = $request->father_address;
            $father->user_id = $request->id;
            $storeFather = $father->save();

            // Save Mother

            $mother = UserMother::where('user_id', $request->id)->first() ? UserMother::where('user_id', $request->id)->first() : new UserMother;
            $mother->name = $request->mother_name;
            $mother->job = $request->mother_job;
            $mother->address = $request->mother_address;
            $mother->user_id = $request->id;
            $storeMother = $mother->save();

            if($storeFather && $storeMother && $storeSchool && $storeUser) {
                DB::commit();

                return redirect()->route('user.biodata.index')->with('status', 'Data updated successfully');
            }

            return redirect()->back()->with('danger', 'Failed to save');

        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Fatal Error');
        }
    }

}
