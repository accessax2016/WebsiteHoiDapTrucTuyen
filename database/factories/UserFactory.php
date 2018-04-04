<?php

use Faker\Generator as Faker;
use App\Permission;

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

$factory->define(App\User::class, function (Faker $faker) {
	$name = $faker->name;
	$date = $faker->dateTimeThisYear;
    return [
        'name' => $name,
        'name_url' => changeTitle($name),
        'status' => $faker->paragraph,
        'about' => $faker->paragraph,
        'location' => $faker->city,
        'avatar' => 'default_avatar.png',
        'job' => $faker->jobTitle,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'point_reputation' => $faker->numberBetween(100, 1000),
        'remember_token' => str_random(10),
        'created_at' => $date,
        'updated_at' => $date,
    ];
});
