<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PostStaff;
use Faker\Generator as Faker;

$factory->define(PostStaff::class, function (Faker $faker) {
    return [
        'post_id' => $faker->randomElement(\DB::table('posts')->pluck('id')),
        'staff_id' => $faker->randomElement(\DB::table('staffs')->pluck('id')),
        'event' => $faker->numberBetween(1,4),
        'happened_at' => now(),
        'deleted_at' => now()
    ];
});
