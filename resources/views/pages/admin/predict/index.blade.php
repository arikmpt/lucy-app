@extends('layouts.master')
@section('page_title', 'Prediksi Pendaftaran')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Prediksi Pendaftaran</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data Prediksi Pendaftaran</h5>
                    <div class="text-right">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                            Filter Data Report
                        </button>
                        <a href="{{ route('admin.predict.print') }}" class="btn btn-primary">
                            Report All Data
                        </a>
                    </div>
                </div>
                <div class="modal fade" id="modal-default" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Filter Report</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            {!! Form::open(['route' => 'admin.predict.filter']) !!}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">STATUS</label>
                                    {!! Form::select('status', ['DAFTAR' => 'DAFTAR', 'TIDAK' => 'TIDAK DAFTAR'], null, 
                                                ['class' => 'form-control','placeholder' => 'Pilih Salah Satu']) !!}
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>        
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>No Hp</th>
                                <th>Email</th>
                                <th>Tempat Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Tujuan Jurusan</th>
                                <th>Asal Sekolah</th>
                                <th>Wilayah Asal Sekolah</th>
                                <th>Jurusan Asal Sekolah</th>
                                <th>Persentase Daftar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($predicts as $predict)
                                <tr>
                                    <td>{{ $predict->name }}</td>
                                    <td>{{ $predict->phone }}</td>
                                    <td>{{ $predict->email }}</td>
                                    <td>{{ $predict->place_of_birth }} {{ $predict->date_of_birth }} </td>
                                    <td>{{ $predict->gender }}</td>
                                    <td>{{ $predict->major }}</td>
                                    <td>{{ $predict->school }}</td>
                                    <td>{{ $predict->school_cluster }}</td>
                                    <td>{{ $predict->school_major }}</td>
                                    <td>
                                        <p>{{ $predict->percentage }}%</p>    
                                        {{-- <p>TIDAK DAFTAR {{ $predict->unpercentage }}%</p>     --}}
                                    </td>
                                    <td>{{ $predict->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <h3>Total Daftar : {{ $persentasedaftar }}%</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection