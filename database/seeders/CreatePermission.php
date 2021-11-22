<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;

class createPermission
{
    public static function createPermission($guard, $permission)
    {
        $actions = ['view', 'create', 'update', 'delete', 'restore'];
        foreach ($actions as $action)
            Permission::create(['guard_name' => $guard, 'name' => $action . ' ' . $permission]);
    }
}
