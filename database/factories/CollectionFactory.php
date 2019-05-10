<?php

use Faker\Generator as Faker;
use App\Models\Collection;
use App\Fixtures\CollectionFixture;

$factory->define(Collection::class, function (Faker $faker) {
    $fixture = resolve(CollectionFixture::class);

    return $fixture->get()[$faker->numberBetween(1, 10)];
});
