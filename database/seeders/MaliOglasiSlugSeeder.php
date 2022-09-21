<?php

namespace Database\Seeders;

use App\Models\MaliOglasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MaliOglasiSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maliOglasis = MaliOglasi::get();

        foreach ($maliOglasis as $item){

                $slug = Str::slug($item->naslov, '-');

                $i = 1;
                $slugTemp = $slug;
                while (MaliOglasi::where('slug', $slug)->exists()) {

                    $slug = $slugTemp . "-" . $i;
                    $i++;
                }
                $item->slug = $slug;
                $item->save();

        }
    }
}
