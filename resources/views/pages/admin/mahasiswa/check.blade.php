@extends('layouts.master')
@section('page_title', 'Bukti Pembayaran')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Bukti Pembayaran</li>
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
                        @if ($user->status == "Belum Bayar")
                        <p>User belum meng-upload bukti pembayaran.</p>
                        @elseif ($user->status == "Admin Register")
                        <p>Daftar offline, pembayaran cash</p>
                        @else
                        <img src="{{ asset('/storage') }}/{{ $user->struk }}" alt="struk-photo" class="img-fluid">
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary"  onclick="history.back()">
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection