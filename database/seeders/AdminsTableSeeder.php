<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admins')->delete();
        
        \DB::table('admins')->insert(array (
            0 => 
            array (
                'datum' => '2018-03-08 00:00:00',
                'geslo' => 'leon0909',
                'id' => 1,
                'ime' => 'Leon',
                'level' => 1,
                'podjetje' => 3,
                'priimek' => 'Horvat',
            ),
            1 => 
            array (
                'datum' => '2021-04-13 00:40:00',
                'geslo' => 'audi1234',
                'id' => 3,
                'ime' => 'Nevenka',
                'level' => 2,
                'podjetje' => 3,
                'priimek' => 'Horvat',
            ),
            2 => 
            array (
                'datum' => '2019-08-18 00:00:00',
                'geslo' => 'jogrizek',
                'id' => 7,
                'ime' => 'Janja',
                'level' => 2,
                'podjetje' => 3,
                'priimek' => 'Ogrizek',
            ),
            3 => 
            array (
                'datum' => '2021-04-13 00:00:00',
                'geslo' => 'marija123',
                'id' => 10,
                'ime' => 'Marija',
                'level' => 2,
                'podjetje' => 4,
                'priimek' => 'Vargek',
            ),
            4 => 
            array (
                'datum' => '2021-04-13 00:00:00',
                'geslo' => 'boris123',
                'id' => 11,
                'ime' => 'Boris',
                'level' => 2,
                'podjetje' => 4,
                'priimek' => 'Horvat',
            ),
        ));
        
        
    }
}