<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reasons')->insert([
            'reason' => 'Shop closed',
            'del_num'=>2,
            'dis_num'=>0,
            
            
        // ],

        // [
        //     'reason' => 'Shop Closed',
        //     'del_num'=>0,
        //     'dis_num'=>0,
            
            
        // ],

        // [
        //     'reason' => 'Other',
        //     'del_num'=>0,
        //     'dis_num'=>0,
            
            
        ]
    
    
    
    );
    }
}
