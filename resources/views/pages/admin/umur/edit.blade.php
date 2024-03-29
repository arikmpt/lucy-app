@extends('layouts.master')
@section('page_title', 'Edit Data Umur')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Edit Data Umur</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Data Umur</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'admin.umur.update']) !!}
                    {!! Form::hidden('id', $data->id, ['required']) !!}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            {!! Form::text('name', $data->name, ['class' => 'form-control','required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="">Dari</label>
                            {!! Form::number('start_range', $data->start_range, ['class' => 'form-control','required', 'min' => '1']) !!}
                        </div>
                        <div class="form-group">
                            <label for="">Sampai</label>
                            {!! Form::number('end_range', $data->end_range, ['class' => 'form-control','required','min' => '1']) !!}
                        </div>
                        <div class="form-group">
                            <label for="">Nilai Prediksi</label>
                            {!! Form::select('predict_value', [
                                '100' => '100',
                                '75' => '75',
                                '50' => '50',
                                '25' => '25',
                                '0' => '0',
                            ], $data->predict_value, 
                            ['class' => 'form-control','required','placeholder' => 'Pilih Salah Satu']) !!}
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
