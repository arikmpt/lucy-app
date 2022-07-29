@extends('layouts.user')
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
                        <p>{{ Auth::user()->name }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Phone:</label>
                        <p>{{ Auth::user()->phone }}</p>
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
                {!! Form::open(['route'=>'user.profile.update','enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}
                <div class="modal-header">
                    <h4 class="modal-title">Sunting Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group update-photo">
                        <label for="">Photo Profile</label>
                        <input type="file" class="form-control dropify" name="photo" data-max-file-size="3M" data-allowed-file-extensions="jpg png jpeg">
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        {!! Form::text('name', Auth::user()->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        {!! Form::text('phone', Auth::user()->phone, ['class' => 'form-control']) !!}
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
                {!! Form::open(['route' => 'user.profile.change_password', 'method' => 'PUT']) !!}
                <div class="modal-header">
                    <h4 class="modal-title">Ganti Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Password Lama</label>
                        {!! Form::password('old_password', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="">Password Baru</label>
                        {!! Form::password('new_password', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="">Konfirmas Password</label>
                        {!! Form::password('confirm_password', ['class' => 'form-control']) !!}
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
@endsection