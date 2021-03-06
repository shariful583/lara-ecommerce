<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name('male'),
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'password' => bcrypt('123456'),
        'email_verified_at' => Carbon::now()
    ];
});
