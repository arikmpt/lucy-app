<!DOCTYPE html>
<html>
<head>
	<title>Report Pendaftaran Mahasiswa</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Report Pendaftaran Mahasiswa</h4>
	</center>
 
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
 
</body>
</html>