<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CommentReply;
use Faker\Generator as Faker;

$factory->define(CommentReply::class, function (Faker $faker) {
    return [
        'comment_id' => $faker->numberBetween(1,10),
        'user_id' => $faker->numberBetween(1,10),
        'is_active' => 1,
        'body' => $faker->paragraphs(1, true),
    ];
});
