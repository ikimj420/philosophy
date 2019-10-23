<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Exercise;
use Faker\Generator as Faker;

$factory->define(Exercise::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'category_id' => $faker->word,
        'title' => $faker->word,
        'ingredients' => $faker->text,
        'make' => $faker->text,
        'fromMin' => $faker->randomDigitNotNull,
        'video' => $faker->word,
        'pics' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
