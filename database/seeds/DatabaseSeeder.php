<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            TextSeeder::class,
            CollectionSeeder::class,
            CollectionTextSeeder::class,
        ]);
    }
}
