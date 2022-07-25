@extends('layouts.user')
@section('page_title', 'Pembayaran')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Pembayaran</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Bukti Pembayaran</h5>
                </div>
                <div class="card-body">
                    <div class="struk-photo">
                        @if (Auth::user()->status == "Belum Bayar")
                        <p>Anda belum meng-upload bukti pembayaran.</p>
                        @else
                        <img src="{{ asset('/storage') }}/{{ Auth::user()->struk }}" alt="struk-photo" class="img-fluid">
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                        Upload Bukti Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route'=>'user.pembayaran.update','enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}
                {!! Form::hidden('id', Auth::user()->id, ['class' => 'form-control']) !!}
                <div class="modal-header">
                    <h4 class="modal-title">Upload Bukti Pembayaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" class="form-control dropify" name="photo" data-max-file-size="3M" data-allowed-file-extensions="jpg png jpeg">
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