<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    $user_id = random_int(1, 30);
    return [
        'title' => $faker->title,
        'user_id' => $user_id
    ];
});
