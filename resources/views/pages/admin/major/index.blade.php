@extends('layouts.master')
@section('page_title', 'Data Jurusan')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Data Jurusan</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data Jurusan</h5>
                    <div class="text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                            Tambah Jurusan
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
                {!! Form::open(['route' => 'admin.school.major.store']) !!}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="">Nilai Prediksi</label>
                        {!! Form::select('predict_value', [
                            '100' => '100',
                            '75' => '75',
                            '50' => '50',
                            '25' => '25',
                            '0' => '0',
                        ], null, 
                        ['class' => 'form-control','required','placeholder' => 'Pilih Salah Satu']) !!}
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
    <script>
        $(document).ready(function() {
    
            $('table#dataTableBuilder tbody').on( 'click', 'td button', function (e) {
                var mode = $(this).attr("data-mode");
                var parent = $(this).parent().get( 0 );
                var parent1 = $(parent).parent().get( 0 );
                var row = $('#dataTableBuilder').DataTable().row(parent1);
                var data = row.data();

                if($(this).hasClass('btn-delete')) {
                    Swal.fire({
                        title: 'Apakah Anda Yakin Untuk Menghapus Data Ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yakin',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.value) {
                            const form = {
                                id : data.id,
                            }
                            remove(form, "{{ route('admin.school.major.destroy') }}", "{{ csrf_token() }}")
                            .then((res) => {
                                success(res.message)
                                $('#dataTableBuilder').DataTable().ajax.reload();
                            })
                            .catch((err) => {
                                if(Array.isArray(err.responseJSON.message)){
                                    err.responseJSON.message.forEach(function(v) {
                                        error(v)
                                    })
                                } else {
                                    error(err.responseJSON.message)
                                }
                                $('#dataTableBuilder').DataTable().ajax.reload();
                            })
                            
                        }
                    })
                } 
            })
        })
    </script>
@endpush