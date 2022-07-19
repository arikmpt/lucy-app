@extends('layouts.master')
@section('page_title', 'Data Wilayah')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Data Wilayah</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data Wilayah</h5>
                    <div class="text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                            Tambah Wilayah
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    {!! $html->table() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                {!! Form::open(['route' => 'admin.school.district.store']) !!}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="">Wilayah</label>
                        {!! Form::text('districts', null, ['class' => 'form-control','required']) !!}
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
@push('scripts')
    {!! $html->scripts() !!}
@endpush