<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'group_id' => 1,
            'password' => Hash::make('123456'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')

        ]);

        // for ($i = 1; $i <= 50; $i++) {
        //     DB::table('users')->insert([
        //         'name' => '',
        //         'email' => '',
        //         'group_id' => 1,
        //         'password' => Hash::make('123456'),
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s')

        //     ]);
        // }
    }
}
