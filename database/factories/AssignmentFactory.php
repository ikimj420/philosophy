<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Assignment;
use Faker\Generator as Faker;

$factory->define(Assignment::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'body' => $faker->text,
        'date' => $faker->word,
        'isDone' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
