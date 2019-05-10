<?php

use Illuminate\Database\Seeder;
use App\Fixtures\CollectionFixture as Fixture;
use App\Repositories\CollectionRepository as Collections;

class CollectionSeeder extends Seeder
{
    public function __construct(Fixture $fixture, Collections $collections)
    {
        $this->fixture = $fixture;
        $this->collections = $collections;
    }

    public function run()
    {
        collect($this->fixture->get())->each(function ($data) {
            $this->collections->create($data);
        });
    }
}
