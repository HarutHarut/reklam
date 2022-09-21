<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AdminsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(CustomersCategoriesTableSeeder::class);
        $this->call(CustomersTrgovinasTableSeeder::class);
        $this->call(FiltersTableSeeder::class);
        $this->call(FiltersOptionsTableSeeder::class);
        $this->call(FilterMaliOglasisTableSeeder::class);
        $this->call(ListingImagesTableSeeder::class);
        $this->call(ListingSavesTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(PaidItemsTableSeeder::class);
        $this->call(RegijesTableSeeder::class);
        $this->call(SlikePrelomsTableSeeder::class);
        $this->call(StoritevToOrdersTableSeeder::class);
        $this->call(TelBlacklistsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ZlorabasTableSeeder::class);
        $this->call(KategorijesTableSeeder::class);
        $this->call(MaliOglasisTableSeeder::class);
        $this->call(MaliOglasiKontaktsTableSeeder::class);
    }
}
