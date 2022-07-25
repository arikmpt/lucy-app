@extends('layouts.user')
@section('page_title', 'Biodata')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Biodata</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Biodata</h5>
                    <div class="text-right">
                        <a href="{{ route('user.biodata.edit') }}" class="btn btn-primary">Update Data</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <p>{{ Auth::user()->name }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">NIM</label>
                                <p>{{ Auth::user()->nim }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">No Hp</label>
                                <p>{{ Auth::user()->phone }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <p>{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <p>{{ Auth::user()->gender }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <p>{{ Auth::user()->date_of_birth }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Tempat Lahir</label>
                                <p>{{ Auth::user()->place_of_birth }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Jurusan Yang Dipilih</label>
                                <p>{{ Auth::user()->major }}</p>
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
                                <p>{{ Auth::user()->school ? Auth::user()->school->name : '-' }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <p>{{ Auth::user()->school ? Auth::user()->school->address : '-' }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Jurusan</label>
                                <p>{{ Auth::user()->school ? Auth::user()->school->major : '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tahun Tamat</label>
                                <p>{{ Auth::user()->school ? Auth::user()->school->year_graduate : '-' }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Nilai Terakhir</label>
                                <p>{{ Auth::user()->school ? Auth::user()->school->score : '-' }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Wilayah</label>
                                <p>{{ Auth::user()->school ? Auth::user()->school->cluster : '-' }}</p>
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
                                <p>{{ Auth::user()->father ? Auth::user()->father->name : '-' }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Pekerjaan Ayah</label>
                                <p>{{ Auth::user()->father ? Auth::user()->father->job : '-' }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Ayah</label>
                                <p>{{ Auth::user()->father ? Auth::user()->father->address : '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Ibu</label>
                                <p>{{ Auth::user()->mother ? Auth::user()->mother->name : '-' }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Pekerjaan Ibu</label>
                                <p>{{ Auth::user()->mother ? Auth::user()->mother->job : '-' }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Ibu</label>
                                <p>{{ Auth::user()->mother ? Auth::user()->mother->address : '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@push('scripts')
    
@endpush