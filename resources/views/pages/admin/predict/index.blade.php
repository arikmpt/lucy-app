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
                                    <td>{{ $predict->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection