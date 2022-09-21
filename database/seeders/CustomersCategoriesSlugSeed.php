<?php

namespace Database\Seeders;

use App\Models\CustomersCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CustomersCategoriesSlugSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = CustomersCategory::get();

        foreach ($categories as $item){

            $slug = Str::slug($item->cc_name, '-');

            $i = 1;
            $slugTemp = $slug;
            while (CustomersCategory::where('slug', $slug)->exists()) {
                $slug = $slugTemp . "-" . $i;
                $i++;
            }
            $item->slug = $slug;
            $item->save();

        }
    }
}
