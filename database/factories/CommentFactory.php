<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function ($faker) {
    return [
        'content' => $faker->word,
    ];
});
