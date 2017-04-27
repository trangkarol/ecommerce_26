<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(SuggestProductsTableSeeder::class);
        $this->call(OrderDetailsTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
        $this->call(CommentTableSeeder::class);
    }
}
