<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'role' => 'Super Admin',
            'status' => 'Aktif',
            'password' => bcrypt('posberkah'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'username' => 'Owner',
            'email' => 'owner@gmail.com',
            'role' => 'Owner',
            'status' => 'Aktif',
            'password' => bcrypt('posberkah'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
