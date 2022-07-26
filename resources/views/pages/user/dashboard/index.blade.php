@extends('layouts.user')
@section('page_title', 'Dashboard')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <img src="{{ asset('assets/images/sttp.jpeg') }}" alt="logo-sttp" class="img-fluid">
        </div>
    </div>
@endsection