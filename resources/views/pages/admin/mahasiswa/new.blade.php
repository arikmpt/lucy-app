@extends('layouts.master')
@section('page_title', 'Data Mahasiswa Baru')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Data Mahasiswa</li>
        <li class="breadcrumb-item active">Baru</li>
    </ol>
@endsection
@section('content')
    {!! Form::open(['route' => 'admin.mahasiswa.store']) !!}
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
                                <label for="">Nama</label>
                                {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">No Hp</label>
                                {!! Form::text('phone', null, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                {!! Form::email('email', null, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                {!! Form::select('gender', ['L' => 'Laki - Laki', 'P' => 'Perempuan'], null, 
                                    ['class' => 'form-control','required','placeholder' => 'Pilih Salah Satu']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                {!! Form::text('date_of_birth', null, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Tempat Lahir</label>
                                {!! Form::text('place_of_birth', null, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Jurusan Yang Dipilih</label>
                                {!! Form::select('major', $prodi, null, 
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
                                {!! Form::text('school_name', null, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                {!! Form::textarea('school_address', null, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Jurusan</label>
                                {!! Form::select('school_major', $schoolMajors, null, 
                                    ['class' => 'form-control','required','placeholder' => 'Pilih Salah Satu']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tahun Tamat</label>
                                {!! Form::text('school_year_graduate', null, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Nilai Terakhir</label>
                                {!! Form::text('school_score', null, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Wilayah</label>
                                {!! Form::select('school_cluster', $schoolClusters, null, 
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
                                {!! Form::text('father_name', null, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Pekerjaan Ayah</label>
                                {!! Form::text('father_job', null, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Ayah</label>
                                {!! Form::textarea('father_address', null, ['class' => 'form-control','required']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Ibu</label>
                                {!! Form::text('mother_name', null, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Pekerjaan Ibu</label>
                                {!! Form::text('mother_job', null, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Ibu</label>
                                {!! Form::textarea('mother_address', null, ['class' => 'form-control','required']) !!}
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