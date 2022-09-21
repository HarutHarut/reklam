<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListingSavesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('listing_saves')->delete();
        
        
        
    }
}