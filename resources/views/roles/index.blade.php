@extends('layouts.app')
@section('main-content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Role Management</h1>
        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Role
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th>Nama Role</th>
                        <th>Permissions</th>
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
        ajax: "{{ route('roles.data') }}",
        columns: [
            {data:'name'},
            {data:'permissions'},
            {data:'action', orderable:false, searchable:false},
        ]
    });

    // DELETE
    $(document).on('click','.btn-delete',function(){
        if(confirm('Hapus data?')){
            $.ajax({
                url: '/roles/'+$(this).data('id'),
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