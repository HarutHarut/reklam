<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomersCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('customers_categories')->delete();

        \DB::table('customers_categories')->insert(array (
            /*0 =>
            array (
                'cc_name' => 'Nerazvrščeno',
                'cc_num_shops' => 0,
                'cc_order' => 999,
                'id' => 0,
            ),*/
            1 =>
            array (
                'cc_name' => 'Avtomobilizem',
                'cc_num_shops' => 21,
                'cc_order' => 10,
                'id' => 1,
            ),
            2 =>
            array (
                'cc_name' => 'Pnevmatike in platišča',
                'cc_num_shops' => 13,
                'cc_order' => 20,
                'id' => 2,
            ),
            3 =>
            array (
                'cc_name' => 'Deli in oprema za vozila',
                'cc_num_shops' => 35,
                'cc_order' => 30,
                'id' => 3,
            ),
            4 =>
            array (
                'cc_name' => 'Nepremičnine',
                'cc_num_shops' => 47,
                'cc_order' => 40,
                'id' => 4,
            ),
            5 =>
            array (
                'cc_name' => 'Računalništvo',
                'cc_num_shops' => 32,
                'cc_order' => 50,
                'id' => 5,
            ),
            6 =>
            array (
                'cc_name' => 'Telefonija',
                'cc_num_shops' => 10,
                'cc_order' => 60,
                'id' => 6,
            ),
            7 =>
            array (
                'cc_name' => 'Glasbila',
                'cc_num_shops' => 6,
                'cc_order' => 70,
                'id' => 7,
            ),
            8 =>
            array (
                'cc_name' => 'Ostala tehnika',
                'cc_num_shops' => 25,
                'cc_order' => 80,
                'id' => 8,
            ),
            9 =>
            array (
                'cc_name' => 'Pohištvo',
                'cc_num_shops' => 24,
                'cc_order' => 90,
                'id' => 9,
            ),
            10 =>
            array (
                'cc_name' => 'Oblačila in obutev',
                'cc_num_shops' => 12,
                'cc_order' => 100,
                'id' => 10,
            ),
            11 =>
            array (
                'cc_name' => 'Male živali',
                'cc_num_shops' => 7,
                'cc_order' => 110,
                'id' => 11,
            ),
            12 =>
            array (
                'cc_name' => 'Lepota in zdravje',
                'cc_num_shops' => 37,
                'cc_order' => 120,
                'id' => 12,
            ),
            13 =>
            array (
                'cc_name' => 'Erotika',
                'cc_num_shops' => 6,
                'cc_order' => 130,
                'id' => 13,
            ),
            14 =>
            array (
                'cc_name' => 'Vse za dom',
                'cc_num_shops' => 53,
                'cc_order' => 140,
                'id' => 14,
            ),
            15 =>
            array (
                'cc_name' => 'Gradbeni material',
                'cc_num_shops' => 69,
                'cc_order' => 150,
                'id' => 15,
            ),
            16 =>
            array (
                'cc_name' => 'Stavbno pohištvo',
                'cc_num_shops' => 27,
                'cc_order' => 160,
                'id' => 16,
            ),
            17 =>
            array (
                'cc_name' => 'Ogrevanje in klimatizacija 	',
                'cc_num_shops' => 45,
                'cc_order' => 170,
                'id' => 17,
            ),
            18 =>
            array (
                'cc_name' => 'Poslovna oprema',
                'cc_num_shops' => 24,
                'cc_order' => 180,
                'id' => 18,
            ),
            19 =>
            array (
                'cc_name' => 'Kmetijstvo in gozdarstvo',
                'cc_num_shops' => 225,
                'cc_order' => 190,
                'id' => 19,
            ),
            20 =>
            array (
                'cc_name' => 'Stroji in orodja',
                'cc_num_shops' => 52,
                'cc_order' => 200,
                'id' => 20,
            ),
            21 =>
            array (
                'cc_name' => 'Šport',
                'cc_num_shops' => 16,
                'cc_order' => 210,
                'id' => 21,
            ),
            22 =>
            array (
                'cc_name' => 'Navtika',
                'cc_num_shops' => 5,
                'cc_order' => 220,
                'id' => 22,
            ),
            23 =>
            array (
                'cc_name' => 'Ostale storitve',
                'cc_num_shops' => 601,
                'cc_order' => 300,
                'id' => 23,
            ),
            24 =>
            array (
                'cc_name' => 'Zasebni stiki',
                'cc_num_shops' => 22,
                'cc_order' => 290,
                'id' => 24,
            ),
            25 =>
            array (
                'cc_name' => 'Gradbene storitve',
                'cc_num_shops' => 160,
                'cc_order' => 240,
                'id' => 25,
            ),
            26 =>
            array (
                'cc_name' => 'Turizem',
                'cc_num_shops' => 15,
                'cc_order' => 230,
                'id' => 26,
            ),
            27 =>
            array (
                'cc_name' => 'Prevozništvo',
                'cc_num_shops' => 56,
                'cc_order' => 250,
                'id' => 27,
            ),
            28 =>
            array (
                'cc_name' => 'Vedeževanje',
                'cc_num_shops' => 25,
                'cc_order' => 260,
                'id' => 28,
            ),
            29 =>
            array (
                'cc_name' => 'Spletne trgovine',
                'cc_num_shops' => 65,
                'cc_order' => 280,
                'id' => 29,
            ),
            30 =>
            array (
                'cc_name' => 'Inštrukcije in učenje',
                'cc_num_shops' => 0,
                'cc_order' => 265,
                'id' => 30,
            ),
            31 =>
            array (
                'cc_name' => 'Poslovne storitve',
                'cc_num_shops' => 0,
                'cc_order' => 245,
                'id' => 31,
            ),
        ));


    }
}
