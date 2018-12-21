<?php

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

$factory->define(App\JournalEntry::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomDigit,
        'email_history' => $faker->unique()->randomDigit,
        'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true)
    ];
});

$factory->define(App\JournalEntry::class, 'with_user' ,function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create(),
        'email_history' => $faker->unique()->randomDigit,
        'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true)
    ];
});
