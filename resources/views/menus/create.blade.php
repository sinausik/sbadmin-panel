@extends('layouts.app')
@section('main-content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ isset($menu) ? route('menus.update',$menu->id) : route('menus.store') }}">
            @csrf
            @if(isset($menu)) @method('PUT') @endif

                <div class="mb-3">
                    <label for="menuName">Nama Menu</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama Menu" value="{{ $menu->name ?? '' }}">
                </div>

                <div class="mb-3">
                    <label for="menuMain">Main Menu</label>
                    <select name="parent_id" class="form-control">
                    <option value="">-- Main Menu --</option>
                    @foreach($parents as $id=>$name)
                        <option value="{{ $id }}" {{ ($menu->parent_id ?? '') == $id ? 'selected':'' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="menuRoute">Route Name</label>
                    <input type="text" name="route" class="form-control" placeholder="Route name">
                </div>

                <div class="mb-3">
                    <label for="menuIcon">Icon</label>
                    <input type="text" name="icon" class="form-control" placeholder="fas fa-users">
                </div>

                <div class="mb-3">
                    <label for="menuPermission">Permission</label>
                    <select name="permission_name" class="form-control">
                    <option value="">-- Tanpa Permission --</option>
                    @foreach($permissions as $perm)
                        <option value="{{ $perm }}">{{ $perm }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="menuOrder">Order</label>
                    <input type="number" name="order" class="form-control">
                </div>

                <button class="btn btn-success">Simpan</button>

            </form>
        </div>
    </div>
</div>
@endsection