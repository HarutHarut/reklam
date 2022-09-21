<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'created_at' => '2022-06-06 09:19:23',
                'email' => 'luk.mesec@gmail.com',
                'email_verified_at' => '2022-06-06 09:19:36',
                'id' => 1,
                'name' => 'Luka Mesec',
                'password' => '$2y$10$raD6/.kX/JF/HpWMyjOfnO0PiPPaVKJ0t1AxOwsjcQwlCyhEDnTae',
                'profile_photo_path' => NULL,
                'remember_token' => NULL,
                'updated_at' => '2022-06-06 09:19:36',
            ),
        ));


    }
}
