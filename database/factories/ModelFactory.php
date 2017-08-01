<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Company::class, function (Faker\Generator $faker) {
	$date_time = $faker->date . ' ' . $faker->time;
    static $password;

    return [
    	'company_account' => $faker->name,
    	'company_name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'activated' => 0,
        'role'       =>1,
        'company_address' => $faker->name,
        'postalcode' => $faker->name,
        'business_licence' => $faker->name,
        'company_introduction' => $faker->name,
        'organization_code' => $faker->name,
        'remember_token' => str_random(10),
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
            
           