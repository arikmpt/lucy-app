@extends('layouts.master')
@section('page_title', 'Data Operator Edit')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Data Operator Edit</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data Operator Edit</h5>
                </div>
                <div class="card-body">
                {!! Form::open(['route' => 'admin.operator.update']) !!}
                    {!! Form::hidden('id', $admin->id, ['required']) !!}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            {!! Form::text('name', $admin->name, ['class' => 'form-control','required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            {!! Form::email('email', $admin->email, ['class' => 'form-control','required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            {!! Form::password('password', ['class' => 'form-control','required']) !!}
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
