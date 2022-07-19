@extends('layouts.master')
@section('page_title', 'Profile')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Profile</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Name:</label>
                        <p>{{ Auth::guard('admin')->user()->name }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label>
                        <p>{{ Auth::guard('admin')->user()->email }}</p>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                        Sunting Profile
                    </button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-password">
                        Ganti Password
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => 'admin.profile.update', 'method' => 'PUT']) !!}
                <div class="modal-header">
                    <h4 class="modal-title">Sunting Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        {!! Form::text('name', Auth::guard('admin')->user()->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <p>{{ Auth::guard('admin')->user()->email }}</p>
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

    <div class="modal fade" id="modal-password" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ganti Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Password Lama</label>
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="">Password Baru</label>
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="">Konfirmas Password</label>
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>        
    </div>
@endsection