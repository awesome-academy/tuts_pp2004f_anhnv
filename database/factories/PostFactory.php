<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'slug' => uniqid(),
        'image_thumb' => $faker->imageUrl,
        'excerpt' => $faker->sentences(2, true),
        'content' => $faker->paragraphs(10, true),
    ];
});
