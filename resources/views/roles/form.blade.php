@extends('layouts.app')
@section('main-content')
<div class="container-fluid">

    <div class="card shadow">
        <div class="card-body">

            <form method="POST" action="{{ isset($role) ? route('roles.update',$role->id) : route('roles.store') }}">
                @csrf
                @if(isset($role)) @method('PUT') @endif

                <div class="mb-3">
                    <label>Nama Role</label>
                    <input type="text" name="name" class="form-control" value="{{ $role->name ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>Permissions</label>
                    <div class="row">
                        @foreach($permissions as $perm)
                        <div class="col-md-3">
                            <div class="form-check">
                                <input type="checkbox" name="permissions[]"
                                       value="{{ $perm->name }}"
                                       class="form-check-input"
                                       {{ in_array($perm->name, $selected ?? []) ? 'checked':'' }}>
                                <label class="form-check-label">{{ $perm->name }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <button class="btn btn-success">Simpan</button>

            </form>

        </div>
    </div>

</div>
@endsection