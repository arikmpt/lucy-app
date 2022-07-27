@extends('layouts.master')
@section('page_title', 'Data Report View')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Data Report View</li>
    </ol>
@endsection
@section('content')

	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Data Mahasiswa</h5>
					<div class="text-right">
						<a href="{{ route('admin.mahasiswa.print') }}" class="btn btn-success">
							Download PDF
						</a>
					</div>
				</div>
				<div class="card-body">
					<table class='table table-bordered'>
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>NIM</th>
								<th>Jenkel</th>
								<th>Email</th>
								<th>No. Telp</th>
								<th>TTL</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							@php $i=1 @endphp
							@foreach($user as $data)
							<tr>
								<td>{{ $i++ }}</td>
								<td>{{$data->name}}</td>
								<td>{{$data->nim}}</td>
								<td>{{$data->gender}}</td>
								<td>{{$data->email}}</td>
								<td>{{$data->phone}}</td>
								<td>{{$data->place_of_birth . " " . $data->date_of_birth}}</td>
								<td>{{$data->status}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
		
@endpush