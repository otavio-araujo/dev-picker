<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'select developer']);
        Permission::create(['name' => 'edit developer']);
        Permission::create(['name' => 'delete developer']);
        Permission::create(['name' => 'view developer']);
        Permission::create(['name' => 'create developer note']);
        Permission::create(['name' => 'edit developer note']);
        Permission::create(['name' => 'delete developer note']);
        Permission::create(['name' => 'view developer note']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'devpicker'])
            ->givePermissionTo(['select developer', 'view developer', 'view developer note']);

        $admin = User::find(1);
        $admin->assignRole('admin');

        $devpicker = User::find(2);
        $devpicker->assignRole('devpicker');
    }
}
