<?php

namespace Database\Seeders;

use App\Models\Antrian\WebServiceAntreanUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class WebServiceAntrianUserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WebServiceAntreanUser::create([
            'username' => 'bpjs_ws_client',
            'password' => Hash::make('yRQYnWzskCZU'),
        ]);
    }
}
