<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Predict;
use App\Models\User;
use App\Models\SchoolCluster;
use App\Models\SchoolMajor;
use App\Models\Umur;
use PDF;
use Carbon\Carbon;

class PredictController extends Controller
{
    public function index()
    {
        $this->process();
        $predicts = Predict::paginate(50);
        $pdaftar = Predict::where('status', 'DAFTAR')->count();
        $count = Predict::get()->count();

        $persentasedaftar = 100 / $count * $pdaftar;

        return view('pages.admin.predict.index')->with([
            'predicts' => $predicts,
            'persentasedaftar' => $persentasedaftar,
        ]);
    }
    public function print()
    {
        $predicts = Predict::all();
 
    	$pdf = PDF::loadview('pages.admin.predict.print',['predicts'=>$predicts])->setPaper('a4', 'landscape');
    	return $pdf->stream('laporan-prediksi-pendaftaran.pdf');
    }

    public function filter(Request $request)
    {
        $predicts = Predict::query();

        $pdaftar = Predict::where('status', 'DAFTAR')->count();
        $count = Predict::get()->count();

        $persentasedaftar = 100 / $count * $pdaftar;

        if($request->status) {
            $predicts->where('status', $request->status);
        }

        $pdf = PDF::loadview('pages.admin.predict.print',['predicts'=>$predicts->get(), 'persentasedaftar' => $persentasedaftar]);
    	return $pdf->stream('laporan-prediksi-pendaftaran.pdf');
    }

    public function process()
    {
        $delete_first = Predict::query()->truncate();
        $jenis_kelamin = 0;
        $asal_sekolah = 0;
        $jurusan_sekolah = 0;
        $nilai = 0;
        $umur = 0;
        $status = 'TIDAK';

        $users = User::get();

        foreach($users as $user) {
            if($user->gender === "L") {
                $jenis_kelamin = 50;
            }

            if($user->gender === "P") {
                $jenis_kelamin = 50;
            }

            if($user->school) {
                $cluster = SchoolCluster::where('name', $user->school->cluster)->first();
    
                if($cluster) {
                    $asal_sekolah = $cluster->predict_value;
                }
                $major = SchoolMajor::where('name', $user->school->major)->first();
    
                if($major) {
                    $jurusan_sekolah = $major->predict_value;
                }
    
                if($user->school->score >= 8) {
                    $nilai = 100;
                }
    
                if($user->school->score <= 7) {
                    $nilai = 60;
                }
    
                if($user->school->score <= 6) {
                    $nilai = 40;
                }
            }

            $age = Carbon::parse($user->date_of_birth)->diff(Carbon::now())->y;

            $findUmur = Umur::where('start_range', '<=', $age)->orWhere('end_range', '>=', $age)->first();

            if($findUmur) {
                $umur = $findUmur->predict_value;
            }
            
            $proRate = ($jenis_kelamin + $asal_sekolah + $jurusan_sekolah + $nilai + $umur) / 5;

            if($proRate >= 60) {
                $status = 'DAFTAR';
            } else {
                $status = 'TIDAK';
            }
            
            $predict = new Predict();
            $predict->nim = $user->nim;
            $predict->name = $user->name;
            $predict->phone = $user->phone;
            $predict->email = $user->email;
            $predict->date_of_birth = $user->date_of_birth;
            $predict->place_of_birth = $user->place_of_birth;
            $predict->gender = $user->gender;
            $predict->major = $user->major;
            $predict->school = $user->school ? $user->school->name : null;
            $predict->school_major = $user->school ? $user->school->major : null;
            $predict->school_cluster = $user->school ? $user->school->cluster : null;
            $predict->status = $status;
            $predict->user_id = $user->id;
            $predict->percentage = $proRate;
            $predict->unpercentage = 100 - (int)$proRate;
            $predict->save();
        }
    }
}
