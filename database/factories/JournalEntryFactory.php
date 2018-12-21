<?php

use Faker\Generator as Faker;
use App\User;

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
        'email_history_id' => $faker->unique()->randomDigit,
        'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true)
    ];
});
