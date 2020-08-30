<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\User\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $randomDate = $faker->dateTime;

    return [
        'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
        'firstName' => $faker->firstName,
        'createdAt' => $randomDate,
        'updatedAt' => clone $randomDate,
        'lastName' => $faker->lastName
    ];
});
