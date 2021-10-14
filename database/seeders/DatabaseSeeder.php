<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'username' => 'admin',
            'fname'=>'anthony',
            'lname'=>'nguyen',
            'email' => 'hoangcnt48@gmail.com',
            'password' => '$2y$10$j2VtWepcxAi9.LhK8/x8gentVCE/oWUv7iGxiIr3X2FhEAG0AfsCK',
            'address'=>'103-45 fennell ave East',
            'postalcode'=>'L9A1R7',
            'avatar'=>'avatar_default_1628460128.png',
            'admin'=>1,
            'type_id'=>0,
            
        ]);
    }
}
