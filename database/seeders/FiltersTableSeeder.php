<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FiltersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('filters')->delete();
        
        
        
    }
}