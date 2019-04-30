<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(App\User::class, function (Faker $faker)
{
    return [
        'name'              => 'Demo Admin',
        'email'             => 'demo@admin.com',
        'email_verified_at' => now(),
        'user_type'         => 'admin',
        'password'          => '$2y$10$OgDMNtRJvoh.w6EydyW8/uK/0thyaplaob.KFzsDDUIybc6psDGV6', // secret
        'remember_token'    => Str::random(10)
    ];
});
