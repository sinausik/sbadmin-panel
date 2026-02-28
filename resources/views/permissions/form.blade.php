@extends('layouts.app')
@section('main-content')
<div class="container-fluid">

    <div class="card shadow">
        <div class="card-body">

            <form method="POST" action="{{ isset($permission) ? route('permissions.update',$permission->id) : route('permissions.store') }}">
                @csrf
                @if(isset($permission)) @method('PUT') @endif

                <div class="mb-3">
                    <label>Nama Permission</label>
                    <input type="text" name="name" class="form-control" value="{{ $permission->name ?? '' }}">
                </div>

                <button class="btn btn-success">Simpan</button>

            </form>

        </div>
    </div>

</div>
@endsection