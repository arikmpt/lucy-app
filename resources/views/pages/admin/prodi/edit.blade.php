@extends('layouts.master')
@section('page_title', 'Data Prodi Edit')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Data Prodi Edit</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data Prodi Edit</h5>
                </div>
                <div class="card-body">
                {!! Form::open(['route' => 'admin.prodi.update']) !!}
                    {!! Form::hidden('id', $prodi->id, ['required']) !!}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Code</label>
                            {!! Form::text('code', $prodi->code, ['class' => 'form-control','required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="">Name</label>
                            {!! Form::text('name', $prodi->name, ['class' => 'form-control','required']) !!}
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
