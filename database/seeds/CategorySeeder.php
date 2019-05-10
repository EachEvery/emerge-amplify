<?php

use Illuminate\Database\Seeder;
use App\Repositories\CategoryRepository as Categories;
use App\Fixtures\CategoryFixture as Fixture;

class CategorySeeder extends Seeder
{
    public function __construct(Fixture $fixture, Categories $categories)
    {
        $this->fixture = $fixture;
        $this->categories = $categories;
    }

    /**
     * Run the database seeds.
     */
    public function run()
    {
        collect($this->fixture->get())->map(function ($item) {
            $item = (object) $item;

            return $this->categories->create([
                'name' => $item->display_name,
                'color' => $item->accent_color,
                'color_light' => color_opacity($item->accent_color, 0.2),
            ]);
        });
    }
}
