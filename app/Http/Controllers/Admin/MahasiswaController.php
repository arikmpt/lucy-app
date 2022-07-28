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
use App\Models\Prodi;
use DB;
use Validator;
use PDF;

class MahasiswaController extends Controller
{
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            return DataTables::of(User::get())->addIndexColumn()
            ->addColumn('action', function($model) {
                return '
                    <a href="'.route('admin.mahasiswa.check', $model->id).'" class="btn btn-sm btn-primary">
                        <i class="fas fa-file-alt"></i>
                    </a>
                    <a href="'.route('admin.mahasiswa.edit', $model->id).'" class="btn btn-sm btn-primary">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <button type="button" class="btn btn-sm btn-danger btn-delete">
                        <i class="fas fa-trash"></i>
                    </button>
                ';
            })
            ->toJson();
        }

        $html = $builder->columns([
            [
                'data' => 'DT_RowIndex','title' => '#',
                'orderable' => false,'searchable' => false,
                'width' => '24px'
            ],
            ['data' => 'nim', 'name' => 'NIM', 'title' => 'No Pendaftaran'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Nama'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'phone', 'name' => 'phone', 'title' => 'No Telp'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            [
                'data' => 'action','title' => 'Action',
                'width' => '170px','class' => 'text-center',
                'orderable' => false,
                'searchable' => false
            ]
        ])->minifiedAjax()->responsive()->autoWidth(false);

        $schoolMajors = SchoolMajor::pluck('name','name');
        $schoolClusters = SchoolCluster::pluck('name','name');
         
        return view('pages.admin.mahasiswa.index')
        ->with([
            'html' => $html,
            'schoolMajors' => $schoolMajors,
            'schoolClusters' => $schoolClusters,
        ]);
    }
    public function PDFPrint()
    {
        $user = User::all();
 
    	$pdf = PDF::loadview('pages.admin.mahasiswa.print',['user'=>$user]);
    	return $pdf->download('laporan-mahasiswa.pdf');
    }

    public function filter(Request $request)
    {
        $user = new User();

        if($request->gender) {
            $user->where('gender', $request->gender);
        }
        if($request->school_major) {
            $user->whereHas('school',function($query) use($request){
                $query->where('major', $request->school_major);
            });
        }

        if($request->school_cluster) {
            $user->whereHas('school',function($query) use($request){
                $query->where('cluster', $request->school_cluster);
            });
        }
 
    	return view('pages.admin.mahasiswa.pdfview')
            ->with([
                'user' => $user->get(),
            ]);
    }

    public function reportview()
    {
        $user = User::all();
 
    	return view('pages.admin.mahasiswa.pdfview')
            ->with([
                'user' => $user,
            ]);
    }

    public function new()
    {
        $schoolMajors = SchoolMajor::pluck('name','name');
        $schoolClusters = SchoolCluster::pluck('name','name');
        $prodi = Prodi::pluck('name','name');

        return view('pages.admin.mahasiswa.new')
            ->with([
                'schoolMajors' => $schoolMajors,
                'schoolClusters' => $schoolClusters,
                'prodi' => $prodi,
            ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $schoolMajors = SchoolMajor::pluck('name','name');
        $schoolClusters = SchoolCluster::pluck('name','name');
        $prodi = Prodi::pluck('name','name');

        return view('pages.admin.mahasiswa.edit')
            ->with([
                'user'  => $user,
                'prodi' => $prodi,
                'schoolMajors' => $schoolMajors,
                'schoolClusters' => $schoolClusters
            ]);
    }

    public function check($id)
    {
        $user = User::findOrFail($id);

        return view('pages.admin.mahasiswa.check')
            ->with([
                'user'  => $user,
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

            
            $nopend = User::orderBy('id', 'desc')->first();

            if ($nopend == null) {
                $nop = 'PMB-STTP0000000';
                $nim = substr($nop,8);
                $nopnow = (int)$nim + 1;
                $nimrec = 'PMB-STTP' . sprintf("%07d", $nopnow);
            }
            else {
                $nim = substr($nopend->nim,8);
                $nopnow = (int)$nim + 1;
                $nimrec = 'PMB-STTP' . sprintf("%07d", $nopnow);
            }

            DB::beginTransaction();

            // Save User
            $user = new User;
            $user->nim = $nimrec;
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
            $school = new UserSchool;
            $school->name = $request->school_name;
            $school->address = $request->school_address;
            $school->major = $request->school_major;
            $school->year_graduate = $request->school_year_graduate;
            $school->score = $request->school_score;
            $school->cluster = $request->school_cluster;
            $school->user_id = $user->id;
            $storeSchool = $school->save();

            // Save Father
            $father = new UserFather;
            $father->name = $request->father_name;
            $father->job = $request->father_job;
            $father->address = $request->father_address;
            $father->user_id = $user->id;
            $storeFather = $father->save();

            // Save Mother

            $mother = new UserMother;
            $mother->name = $request->mother_name;
            $mother->job = $request->mother_job;
            $mother->address = $request->mother_address;
            $mother->user_id = $user->id;
            $storeMother = $mother->save();

            if($storeFather && $storeMother && $storeSchool && $storeUser) {
                DB::commit();

                return redirect()->route('admin.mahasiswa.index')->with('status', 'Data saved statusfully');
            }

            return redirect()->back()->with('danger', 'Failed to save');

        } catch (\Throwable $th) {
            dd($th);
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
            $father = UserFather::where('user_id', $request->id)->first() ? UserFather::where('user_id', $request->id)->first() :  new UserFather;
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

                return redirect()->route('admin.mahasiswa.index')->with('status', 'Data updated successfully');
            }

            return redirect()->back()->with('danger', 'Failed to save');

        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('danger', 'Fatal Error');
        }
    }
    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();

            $find2 = UserSchool::where('user_id', $request->id);
            $destroy2 = $find2->delete();

            $find3 = UserFather::where('user_id', $request->id);
            $destroy3 = $find3->delete();
            
            $find4 = UserMother::where('user_id', $request->id);
            $destroy4 = $find4->delete();

            $find1 = User::findOrFail($request->id);
            $destroy1 = $find1->delete();

            if($destroy4 || $destroy3 || $destroy2 || $destroy1) {
                DB::commit();

                return response()->json(['success' => true, 'message' => 'Data deleted successfully'], 200)->header('Content-Type', 'application/json');
            }
            return response()->json(['success' => false, 'message' => 'error'], 400)->header('Content-Type', 'application/json');

        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'error catch'], 200)->header('Content-Type', 'application/json');
        }
            // return $destroy ? response()->json(['success' => true, 'message' => 'Data deleted successfully'], 200)->header('Content-Type', 'application/json') : 
            // response()->json(['success' => false, 'message' => 'Data failed to delete'], 400)->header('Content-Type', 'application/json');
    }
}
