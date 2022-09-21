<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaidItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('paid_items')->delete();
        
        \DB::table('paid_items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'price' => '4.95',
                'title' => 'Premium Stiki 1 mesec',
                'user_tip' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'price' => '14.95',
                'title' => 'Premium Stiki 3 mesece',
                'user_tip' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'price' => '49.95',
                'title' => 'Premium Stiki 1 leto',
                'user_tip' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'price' => '11.95',
                'title' => 'Premium Stiki PLUS 1 mesec',
                'user_tip' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'price' => '35.95',
                'title' => 'Premium Stiki PLUS 3 mesece',
                'user_tip' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'price' => '119.95',
                'title' => 'Premium Stiki PLUS 1 leto',
                'user_tip' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'price' => '19.95',
                'title' => 'Maxi 1 mesec',
                'user_tip' => 2,
            ),
            7 => 
            array (
                'id' => 8,
                'price' => '59.95',
                'title' => 'Maxi 3 mesece',
                'user_tip' => 2,
            ),
            8 => 
            array (
                'id' => 9,
                'price' => '199.95',
                'title' => 'Maxi 1 leto',
                'user_tip' => 2,
            ),
            9 => 
            array (
                'id' => 10,
                'price' => '39.95',
                'title' => 'Profi 1 mesec',
                'user_tip' => 2,
            ),
            10 => 
            array (
                'id' => 11,
                'price' => '119.95',
                'title' => 'Profi 3 mesece',
                'user_tip' => 2,
            ),
            11 => 
            array (
                'id' => 12,
                'price' => '299.95',
                'title' => 'Profi 1 leto',
                'user_tip' => 2,
            ),
            12 => 
            array (
                'id' => 13,
                'price' => '2.99',
                'title' => 'Izpostavljen oglas',
                'user_tip' => 0,
            ),
            13 => 
            array (
                'id' => 14,
                'price' => '4.99',
                'title' => 'Oglasi Stiki',
                'user_tip' => 1,
            ),
        ));
        
        
    }
}