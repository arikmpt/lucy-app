@extends('layouts.master')
@section('page_title', 'Sunting Data Mahasiswa')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Data Mahasiswa</li>
        <li class="breadcrumb-item active">Sunting</li>
    </ol>
@endsection
@section('content')
    {!! Form::open(['route' => 'admin.mahasiswa.update']) !!}
    {!! Form::hidden('id', $user->id, []) !!}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Biodata</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">No Pendaftaran</label>
                                {!! Form::text('nim', $user->nim, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Nama</label>
                                {!! Form::text('name', $user->name, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">No Hp</label>
                                {!! Form::text('phone', $user->phone, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                {!! Form::email('email', $user->email, ['class' => 'form-control','required']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                {!! Form::select('gender', ['L' => 'Laki - Laki', 'P' => 'Perempuan'], $user->gender, 
                                    ['class' => 'form-control','required','placeholder' => 'Pilih Salah Satu']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                {!! Form::text('date_of_birth', $user->date_of_birth, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Tempat Lahir</label>
                                {!! Form::text('place_of_birth', $user->place_of_birth, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Jurusan Yang Dipilih</label>
                                {!! Form::select('major', $prodi, $user->major, 
                                    ['class' => 'form-control','required','placeholder' => 'Pilih Salah Satu']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Asal Sekolah / Perguruan Tinggi</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama</label>
                                {!! Form::text('school_name', $user->school->name, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                {!! Form::textarea('school_address', $user->school->address, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Jurusan</label>
                                {!! Form::select('school_major', $schoolMajors, $user->school->major, 
                                    ['class' => 'form-control','required','placeholder' => 'Pilih Salah Satu']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tahun Tamat</label>
                                {!! Form::text('school_year_graduate', $user->school->year_graduate, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Nilai Terakhir</label>
                                {!! Form::text('school_score', $user->school->score, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Wilayah</label>
                                {!! Form::select('school_cluster', $schoolClusters, $user->school->cluster, 
                                    ['class' => 'form-control','required','placeholder' => 'Pilih Salah Satu']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data Orang Tua</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Ayah</label>
                                {!! Form::text('father_name', $user->father->name, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Pekerjaan Ayah</label>
                                {!! Form::text('father_job', $user->father->job, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Ayah</label>
                                {!! Form::textarea('father_address', $user->father->address, ['class' => 'form-control','required']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Ibu</label>
                                {!! Form::text('mother_name', $user->mother->name, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Pekerjaan Ibu</label>
                                {!! Form::text('mother_job', $user->mother->job, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Ibu</label>
                                {!! Form::textarea('mother_address', $user->mother->address, ['class' => 'form-control','required']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            
        </div>
    </div>
    {!! Form::close() !!}

@endsection
@push('scripts')
    
@endpush