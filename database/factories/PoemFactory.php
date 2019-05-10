<?php

use Faker\Generator as Faker;
use function GuzzleHttp\json_encode;
use App\Models\Collection;
use App\Models\Poem;
use App\Models\Text;

$factory->define(Poem::class, function (Faker $faker) {
    $text = Text::inRandomOrder()->first();
    $collection = Collection::inRandomOrder()->first();

    return [
        'title' => $faker->word,
        'email' => $faker->email,
        'json' => json_encode([]),
        'author' => $faker->name,
        'phone' => $faker->phoneNumber,
        'text_id' => $text->id,
        'collection_id' => $collection->id,
    ];
});
