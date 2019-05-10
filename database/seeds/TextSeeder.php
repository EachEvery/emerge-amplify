<?php

use Illuminate\Database\Seeder;
use App\Fixtures\TextFixture as Fixture;
use App\Repositories\TextRepository as Texts;
use App\Repositories\CategoryRepository as Cats;

class TextSeeder extends Seeder
{
    public function __construct(Fixture $fixture, Texts $texts, Cats $cats)
    {
        $this->fixture = $fixture;
        $this->texts = $texts;
        $this->cats = $cats;
    }

    public function run()
    {
        collect($this->fixture->get())->each(function ($data) {
            $category_id = $this->cats->findBySlug($data['category'])->id;

            unset($data['category']);
            $data['category_id'] = $category_id;

            // Skip duplicates
            if (0 === $this->texts->withTitle($data['title'])->count()) {
                return $this->texts->create($data);
            }
        });
    }
}
