<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraphs(10, true),
        'created_at' => now(),
        'updated_at' => now(),
        'post_id' => $faker->randomElement(\DB::table('posts')->pluck('id')),
        'person_id' => $faker->randomElement(\DB::table('users')->pluck('id')),
        'person_type' => 'user',
    ];
});
