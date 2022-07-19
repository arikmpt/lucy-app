<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use DataTables;
use App\Models\SchoolMajor;
use App\Models\SchoolCluster;
use App\Models\User;
use App\Models\UserFather;
use App\Models\UserMother;
use App\Models\UserSchool;
use DB;
use Validator;

class MahasiswaController extends Controller
{
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            return DataTables::of([])->addIndexColumn()
            ->toJson();
        }
    
        $html = $builder->columns([
            [
                'data' => 'DT_RowIndex','title' => '#',
                'orderable' => false,'searchable' => false,
                'width' => '24px'
            ],
            ['data' => 'nim', 'name' => 'NIM', 'title' => 'NIM'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Nama'],
            ['data' => 'gender', 'name' => 'gender', 'title' => 'Jenis Kelamin'],
            [
                'data' => 'action','title' => 'Action',
                'width' => '170px','class' => 'text-center',
                'orderable' => false,
                'searchable' => false
            ]
        ])->minifiedAjax()->responsive()->autoWidth(false);

        return view('pages.admin.mahasiswa.index')
        ->with([
            'html' => $html
        ]);
    }

    public function new()
    {
        $schoolMajors = SchoolMajor::pluck('name','name');
        $schoolClusters = SchoolCluster::pluck('name','name');

        return view('pages.admin.mahasiswa.new')
            ->with([
                'schoolMajors' => $schoolMajors,
                'schoolClusters' => $schoolClusters
            ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $schoolMajors = SchoolMajor::pluck('name','name');
        $schoolClusters = SchoolCluster::pluck('name','name');

        return view('pages.admin.mahasiswa.new')
            ->with([
                'user'  => $user,
                'schoolMajors' => $schoolMajors,
                'schoolClusters' => $schoolClusters
            ]);
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            DB::beginTransaction();

            // Save User
            $user = new User;
            $user->nim = '123456789';
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password =  bcrypt('123456789');
            $user->date_of_birth = $request->date_of_birth;
            $user->place_of_birth = $request->place_of_birth;
            $user->gender = $request->gender;
            $user->major = $request->major;
            $storeUser = $user->save();

            // Save School
            $school = new UserSchool;
            $school->name = $request->school_name;
            $school->address = $request->school_address;
            $school->major = $request->school_major;
            $school->year_graduate = $request->school_year_graduate;
            $school->score = $request->school_score;
            $school->school_cluster = $request->school_cluster;
            $school->user_id = $storeUser->id;
            $storeSchool = $school->save();

            // Save Father
            $father = new UserFather;
            $father->name = $request->father_name;
            $father->job = $request->father_job;
            $father->address = $request->father_address;
            $father->user_id = $storeUser->id;
            $storeFather = $father->save();

            // Save Mother

            $mother = new UserMother;
            $mother->name = $request->mother_name;
            $mother->job = $request->mother_job;
            $mother->address = $request->mother_address;
            $mother->user_id = $storeUser->id;
            $storeMother = $mother->save();

            if($storeFather && $storeMother && $storeSchool && $storeUser) {
                DB::commit();

                return redirect()->route('admin.mahasiswa.index')->with('status', 'Data saved statusfully');
            }

            return redirect()->back()->with('danger', 'Failed to save');

        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Fatal Error');
        }
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
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password =  bcrypt('123456789');
            $user->date_of_birth = $request->date_of_birth;
            $user->place_of_birth = $request->place_of_birth;
            $user->gender = $request->gender;
            $user->major = $request->major;
            $storeUser = $user->save();

            // Save School
            $school = UserSchool::where('user_id', $request->id)->firstOrFail();
            $school->name = $request->school_name;
            $school->address = $request->school_address;
            $school->major = $request->school_major;
            $school->year_graduate = $request->school_year_graduate;
            $school->score = $request->school_score;
            $school->school_cluster = $request->school_cluster;
            $school->user_id = $request->id;
            $storeSchool = $school->save();

            // Save Father
            $father = UserFather::where('user_id', $request->id)->firstOrFail();
            $father->name = $request->father_name;
            $father->job = $request->father_job;
            $father->address = $request->father_address;
            $father->user_id = $request->id;
            $storeFather = $father->save();

            // Save Mother

            $mother = UserMother::where('user_id', $request->id)->firstOrFail();
            $mother->name = $request->mother_name;
            $mother->job = $request->mother_job;
            $mother->address = $request->mother_address;
            $mother->user_id = $request->id;
            $storeMother = $mother->save();

            if($storeFather && $storeMother && $storeSchool && $storeUser) {
                DB::commit();

                return redirect()->route('admin.mahasiswa.index')->with('status', 'Data updated successfully');
            }

            return redirect()->back()->with('danger', 'Failed to save');

        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Fatal Error');
        }
    }
}
