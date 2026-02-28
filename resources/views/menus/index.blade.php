@extends('layouts.app')
@section('main-content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Menus</h1>
        <a href="{{ route('menus.create') }}" class="btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Parent</th>
                        <th>Route</th>
                        <th>Permission</th>
                        <th>Aksi</th>
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
$('#table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('menus.data') }}",
    columns: [
        {data:'name'},
        {data:'parent'},
        {data:'route'},
        {data:'permission_name'},
        {data:'action', orderable:false, searchable:false},
    ]
});
</script>
@endpush