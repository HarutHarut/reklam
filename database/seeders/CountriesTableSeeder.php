<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('countries')->delete();
        
        \DB::table('countries')->insert(array (
            0 => 
            array (
                'countries_name' => 'Slovenija',
                'country_code' => 386,
                'id' => 1,
            ),
            1 => 
            array (
                'countries_name' => 'Avstrija',
                'country_code' => 43,
                'id' => 2,
            ),
            2 => 
            array (
                'countries_name' => 'Hrvaška',
                'country_code' => 385,
                'id' => 3,
            ),
            3 => 
            array (
                'countries_name' => 'Italija',
                'country_code' => 39,
                'id' => 4,
            ),
            4 => 
            array (
                'countries_name' => 'Madžarska',
                'country_code' => 36,
                'id' => 5,
            ),
            5 => 
            array (
                'countries_name' => 'Nemčija',
                'country_code' => 49,
                'id' => 6,
            ),
            6 => 
            array (
                'countries_name' => 'Srbija',
                'country_code' => 381,
                'id' => 7,
            ),
            7 => 
            array (
                'countries_name' => 'Ostale države',
                'country_code' => 0,
                'id' => 10,
            ),
        ));
        
        
    }
}