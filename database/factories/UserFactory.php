<?php
/**
 * Created by PhpStorm.
 * User: muzlu
 * Date: 18.06.2019
 * Time: 15:06
 */


$factory->define(App\User::class, function (Faker\Generator $faker) {

    return [
        'first_name'        => $faker->firstName,
        'last_name'         => $faker->lastName,
        'email'             => $faker->email,
        'password'          => \Illuminate\Support\Facades\Hash::make("pass"),
        'city'              => $faker->city,
        'status'            => rand(1,0)

    ];
});
