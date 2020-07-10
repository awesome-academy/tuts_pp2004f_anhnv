<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'image_avatar' => $faker->imageUrl(),
        'phone' => $faker->e164PhoneNumber,
        'address_line_1' => $faker->address,
        'address_line_2' => ( rand(1, 100) > 90 ) ? $faker->address : NULL,
        'city' => $faker->city,
        'country' => $faker->country,
        'person_id' => $faker->randomElement(\DB::table('users')->pluck('id')),
        'person_type' => 'user',
    ];
});
