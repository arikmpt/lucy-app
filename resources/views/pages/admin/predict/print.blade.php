<!DOCTYPE html>
<html>
<head>
	<title>Report Prediksi Pendaftaran</title>
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
		<h5>Report Prediksi Pendaftaran</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
                <th>Nama</th>
                <th>No Hp</th>
                <th>Email</th>
                <th>Jenis Kelamin</th>
                <th>Tujuan Jurusan</th>
                <th>Asal Sekolah</th>
                <th>Wilayah Asal Sekolah</th>
                <th>Jurusan Asal Sekolah</th>
                <th>Status</th>
			</tr>
		</thead>
		<tbody>
            @foreach($predicts as $predict)
                <tr>
                    <td>{{ $predict->name }}</td>
                    <td>{{ $predict->phone }}</td>
                    <td>{{ $predict->email }}</td>
                    <td>{{ $predict->gender }}</td>
                    <td>{{ $predict->major }}</td>
                    <td>{{ $predict->school }}</td>
                    <td>{{ $predict->school_cluster }}</td>
                    <td>{{ $predict->school_major }}</td>
                    <td>{{ $predict->percentage }}</td>
                    <td>
                        <p>DAFTAR {{ $predict->percentage }}%</p>    
                        <p>TIDAK DAFTAR {{ $predict->unpercentage }}%</p>    
                    </td>
                </tr>
            @endforeach
		</tbody>
	</table>
 
</body>
</html>