<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permission list
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.store']);
        Permission::create(['name' => 'users.show']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.update']);
        Permission::create(['name' => 'users.destroy']);

        Permission::create(['name' => 'invoices.index']);
        Permission::create(['name' => 'invoices.create']);
        Permission::create(['name' => 'invoices.store']);
        Permission::create(['name' => 'invoices.show']);
        Permission::create(['name' => 'invoices.edit']);
        Permission::create(['name' => 'invoices.update']);
        Permission::create(['name' => 'invoices.destroy']);
        Permission::create(['name' => 'invoices.search']);

        //Super
        $super = Role::create(['name' => 'Super']);

        $super->givePermissionTo([
            'users.index',
            'users.create',
            'users.store',
            'users.show',
            'users.edit',
            'users.update',
            'users.destroy',

            'invoices.index',
            'invoices.create',
            'invoices.store',
            'invoices.show',
            'invoices.edit',
            'invoices.update',
            'invoices.destroy',
            'invoices.search'
        ]);

        //Admin
        $admin = Role::create(['name' => 'Admin']);

        $admin->givePermissionTo([
            'users.index',
            'users.create',
            'users.store',
            'users.show',
            'users.edit',
            'users.update',
            'users.destroy',

            'invoices.index',
            'invoices.create',
            'invoices.store',
            'invoices.show',
            'invoices.edit',
            'invoices.update',
            'invoices.search'
        ]);

        //User
        $user = Role::create(['name' => 'User']);

        $user->givePermissionTo([
            'users.show',
            'users.edit',
            'users.update',

            'invoices.index',
            'invoices.show',
            'invoices.search'
        ]);
    }
}
