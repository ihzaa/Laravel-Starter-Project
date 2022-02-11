<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class Permission_SEP extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CreatePermission::create('pembuatan SEP');
        Permission::create(['name' => 'special Pencarian Peserta']);
        Permission::create(['name' => 'special Pembuatan SEP']);
        Permission::create(['name' => 'special Kunjungan Kontrol Inap']);
    }
}
