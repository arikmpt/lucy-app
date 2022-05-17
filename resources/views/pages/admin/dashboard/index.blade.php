@extends('layouts.master')
@section('page_title', 'Dashboard Page')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard Page</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Card title</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection