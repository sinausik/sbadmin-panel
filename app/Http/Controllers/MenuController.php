<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;

class MenuController extends Controller
{
    public function index()
    {
        return view('menus.index');
    }

    public function data()
    {
        $menus = Menu::with('parent')->select('menus.*');

        return DataTables::of($menus)
            ->addColumn('parent', fn($row) => $row->parent?->name ?? '-')
            ->addColumn('action', function ($row) {
                return '
                    <a href="'.route('menus.edit',$row->id).'" class="btn btn-sm btn-warning">Edit</a>
                    <button data-id="'.$row->id.'" class="btn btn-sm btn-danger btn-delete">Delete</button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $parents = Menu::whereNull('parent_id')->pluck('name','id');
        $permissions = Permission::pluck('name','name');

        return view('menus.create', compact('parents','permissions'));
    }

    public function store(Request $request)
    {
        Menu::create($request->all());
        return redirect()->route('menus.index')->with('success','Berhasil');
    }

    public function edit(Menu $menu)
    {
        $parents = Menu::whereNull('parent_id')->where('id','!=',$menu->id)->pluck('name','id');
        $permissions = Permission::pluck('name','name');

        return view('menus.edit', compact('menu','parents','permissions'));
    }

    public function update(Request $request, Menu $menu)
    {
        $menu->update($request->all());
        return redirect()->route('menus.index')->with('success','Berhasil');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return response()->json(['success'=>true]);
    }
}
