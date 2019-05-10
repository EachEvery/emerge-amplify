<?php

use Illuminate\Database\Seeder;
use App\Repositories\CollectionRepository as Collections;
use App\Repositories\TextRepository as Texts;

class CollectionTextSeeder extends Seeder
{
    public function __construct(Collections $collections, Texts $texts)
    {
        $this->collections = $collections;
        $this->texts = $texts;
    }

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->collections->all()->each(function ($collection) {
            $this->texts->random(15)->each(function ($text) use ($collection) {
                $collection->texts()->save($text);
            });
        });
    }
}
