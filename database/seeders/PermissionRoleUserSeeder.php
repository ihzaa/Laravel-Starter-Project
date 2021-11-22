<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionRoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role3 = Role::create(['guard_name' => 'admin', 'name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        $user = \App\Models\User::factory()->create([
            'name' => 'SuperAdmin',
            'username' => 'superadmin',
            'email' => 'superadmin@example.com',
        ]);
        $user->assignRole($role3);

        // create permissions
        CreatePermission::createPermission('admin', 'users');

        // create roles and assign existing permissions
        CreateRole::createRole('admin', 'admin', ['create users', 'update users', 'delete users', 'view users', 'restore users']);

        CreatePermission::createPermission('admin', 'permissions');

        // In login method check the loged-in user Role
    }
}
