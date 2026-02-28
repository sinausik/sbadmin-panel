<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index');
    }

    public function data()
    {
        return DataTables::of(Role::query())
            ->addColumn('permissions', function($role){
                return $role->permissions->pluck('name')->implode(', ');
            })
            ->addColumn('action', function($row){
                return '
                    <a href="'.route('roles.edit',$row->id).'" class="btn btn-warning btn-sm">Edit</a>
                    <button data-id="'.$row->id.'" class="btn btn-danger btn-sm btn-delete">Delete</button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.form', compact('permissions'));
    }

    public function store(Request $request)
    {
        $role = Role::create(['name'=>$request->name]);
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success','Berhasil');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $selected = $role->permissions->pluck('name')->toArray();

        return view('roles.form', compact('role','permissions','selected'));
    }

    public function update(Request $request, Role $role)
    {
        $role->update(['name'=>$request->name]);
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success','Berhasil');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['success'=>true]);
    }
}
