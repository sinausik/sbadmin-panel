@extends('layouts.app')
@section('main-content')
<div class="container-fluid">

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ isset($user) ? route('users.update',$user->id) : route('users.store') }}">
                @csrf
                @if(isset($user)) @method('PUT') @endif

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    <small>Kosongkan jika tidak diubah</small>
                </div>

                <div class="mb-3">
                    <label>Role</label>
                    <select name="roles[]" class="form-control">
                        @foreach($roles as $role)
                        <option value="{{ $role }}" {{ in_array($role, $selected ?? []) ? 'selected':'' }}>
                            {{ $role }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-success">Simpan</button>

            </form>

        </div>
    </div>

</div>
@endsection