@extends('layouts.master')
@section('page_title', 'Data Mahasiswa')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Data Mahasiswa</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data Mahasiswa</h5>
                    <div class="text-right">
                        <a href="{{ route('admin.mahasiswa.print') }}" class="btn btn-primary">
                            Report Data
                        </a>
                        <a href="{{ route('admin.mahasiswa.new') }}" class="btn btn-success">Tambah Baru</a>
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
                    <h4 class="modal-title">Upload Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Upload Excel File</label>
                        {!! Form::file('file', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
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
                            remove(form, "{{ route('admin.mahasiswa.destroy') }}", "{{ csrf_token() }}")
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