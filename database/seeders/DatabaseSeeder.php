<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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
        $this->call(RoleSeeder::class);
        User::factory(2)->create();
        Category::factory(10)->create();
        Product::factory(30)->create();
        // \App\Models\User::factory(10)->create();
    }
}
