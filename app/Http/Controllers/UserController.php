<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function data()
    {
        return DataTables::of(User::query())
            ->addColumn('role', function($user){
                return $user->getRoleNames()->implode(', ');
            })
            ->addColumn('action', function($row){
                return '
                    <a href="'.route('users.edit',$row->id).'" class="btn btn-warning btn-sm">Edit</a>
                    <button data-id="'.$row->id.'" class="btn btn-danger btn-sm btn-delete">Delete</button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $roles = Role::pluck('name','name');
        return view('users.form', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success','Berhasil');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name','name');
        $selected = $user->getRoleNames()->toArray();

        return view('users.form', compact('user','roles','selected'));
    }

    public function update(Request $request, User $user)
    {
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
        ];

        if($request->password){
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success','Berhasil');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success'=>true]);
    }
}
