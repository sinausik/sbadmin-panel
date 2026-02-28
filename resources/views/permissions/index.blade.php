@extends('layouts.app')
@section('main-content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Permission Management</h1>
        <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th>Nama Permission</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

</div>
@endsection

@push('css')
<link href="{{ asset('sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('js')
<script src="{{ asset('sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
$(function(){
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('permissions.data') }}",
        columns: [
            {data:'name'},
            {data:'action', orderable:false, searchable:false},
        ]
    });

    $(document).on('click','.btn-delete',function(){
        if(confirm('Hapus data?')){
            $.ajax({
                url: '/permissions/'+$(this).data('id'),
                type: 'DELETE',
                data: {_token:'{{ csrf_token() }}'},
                success: function(){
                    $('#table').DataTable().ajax.reload();
                }
            });
        }
    });
});
</script>
@endpush