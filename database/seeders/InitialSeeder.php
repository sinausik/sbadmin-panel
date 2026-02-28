<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class InitialSeeder extends Seeder
{
    public function run()
    {
        // MENUS
        Menu::create([
            'name' => 'Master Data',
            'route' => 'menus.index',
            'icon' => 'fas fa-fw fa-cog',
            'permission_name' => null,
            'parent_id' => null,
            'order' => 1,
        ]);

        Menu::create([
            'name' => 'Menus',
            'route' => 'menus.index',
            'icon' => null,
            'permission_name' => 'menus.view',
            'parent_id' => 1,
            'order' => 2,
        ]);

        Menu::create([
            'name' => 'Roles',
            'route' => 'roles.index',
            'icon' => null,
            'permission_name' => 'roles.view',
            'parent_id' => 1,
            'order' => 3,
        ]);

        Menu::create(attributes: [
            'name' => 'Permissions',
            'route' => 'permissions.index',
            'icon' => null,
            'permission_name' => 'permissions.view',
            'parent_id' => 1,
            'order' => 4,
        ]);

        Menu::create(attributes: [
            'name' => 'Users',
            'route' => 'users.index',
            'icon' => null,
            'permission_name' => 'users.view',
            'parent_id' => 1,
            'order' => 5,
        ]);

        // PERMISSIONS
        $permissions = [
            'menus.view',
            'users.view',
            'roles.view',
            'permissions.view',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name'=>$perm]);
        }

        // ROLES
        $superadmin = Role::firstOrCreate(['name'=>'superadmin']);
        $administrator = Role::firstOrCreate(['name'=>'administrator']);
        $reviewer = Role::firstOrCreate(['name'=>'reviewer']);

        // ASSIGN PERMISSION
        $superadmin->givePermissionTo(Permission::all());

        // USER
        $user = User::firstOrCreate([
            'email' => 'mail@sbadminpanel.test'
        ],[
            'name' => 'Rahmad',
            'password' => Hash::make('password'),
        ]);

        // ASSIGN ROLE
        $user->assignRole('superadmin');
    }
}
