<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Predict;
use App\Models\User;
use App\Models\SchoolCluster;
use App\Models\SchoolMajor;

class PredictController extends Controller
{
    public function index()
    {
        $this->process();
        $predicts = Predict::paginate(50);

        return view('pages.admin.predict.index')->with([
            'predicts' => $predicts
        ]);
    }

    public function process()
    {
        $delete_first = Predict::query()->truncate();
        $jenis_kelamin = 0;
        $asal_sekolah = 0;
        $jurusan_sekolah = 0;
        $nilai = 0;
        $umur = 0;
        $status = 'TIDAK MENDAFTAR';

        $users = User::get();

        foreach($users as $user) {
            if($user->gender === "L") {
                $jenis_kelamin += 50;
            }

            if($user->gender === "P") {
                $jenis_kelamin += 50;
            }

            $cluster = SchoolCluster::where('districts', $user->school->cluster)->first();

            if($cluster) {
                $asal_sekolah += $cluster->predict_value;
            }

            $major = SchoolMajor::where('name', $user->school->major)->first();

            if($major) {
                $jurusan_sekolah += $major->predict_value;
            }

            if($user->school->score >= 7) {
                $nilai += 100;
            }

            if($user->school->score <= 6) {
                $nilai += 50;
            }

            $umur = 100;

            $proRate = ($jenis_kelamin + $asal_sekolah + $jurusan_sekolah + $nilai + $umur) / 5;

            if($proRate > 75) {
                $status = 'AKAN MENDAFTAR';
            } else if($proRate > 50 && $proRate < 75) {
                $status = 'MUNGKIN MENDAFTAR';
            } else {
                $status = 'TIDAK MENDAFTAR';
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
            $predict->school = $user->school->name;
            $predict->school_major = $user->school->major;
            $predict->school_cluster = $user->school->cluster;
            $predict->status = $status;
            $predict->user_id = $user->id;
            $predict->save();
        }

    }
}