<?php

namespace Database\Seeders;

use App\Models\CustomersTrgovina;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanySlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = CustomersTrgovina::get();

        foreach ($companies as $item){

            $slug = Str::slug($item->tocen_naziv, '-');

            $i = 1;
            $slugTemp = $slug;
            while (CustomersTrgovina::where('slug', $slug)->exists()) {
                $slug = $slugTemp . "-" . $i;
                $i++;
            }
            $item->slug = $slug;
            $item->save();

        }
    }
}
