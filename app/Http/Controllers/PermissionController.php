<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        return view('permissions.index');
    }

    public function data()
    {
        return DataTables::of(Permission::query())
            ->addColumn('action', function($row){
                return '
                    <a href="'.route('permissions.edit',$row->id).'" class="btn btn-warning btn-sm">Edit</a>
                    <button data-id="'.$row->id.'" class="btn btn-danger btn-sm btn-delete">Delete</button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('permissions.form');
    }

    public function store(Request $request)
    {
        Permission::create(['name'=>$request->name]);

        return redirect()->route('permissions.index')->with('success','Berhasil');
    }

    public function edit(Permission $permission)
    {
        return view('permissions.form', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $permission->update(['name'=>$request->name]);

        return redirect()->route('permissions.index')->with('success','Berhasil');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response()->json(['success'=>true]);
    }
}
