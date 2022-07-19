@extends('layouts.master')
@section('page_title', 'Edit Data Wilayah Sekolah')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Edit Data Wilayah Sekolah</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Data Wilayah Sekolah</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'admin.school.district.update']) !!}
                    {!! Form::hidden('id', $district->id, ['required']) !!}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            {!! Form::text('name', $district->name, ['class' => 'form-control','required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="">Wilayah</label>
                            {!! Form::textarea('districts', $district->districts, ['class' => 'form-control', 'placeholder' => 'Payakumbuh, Bukittingi, Padang','required']) !!}
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
    </div>

@endsection
