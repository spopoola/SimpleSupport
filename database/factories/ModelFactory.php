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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'mobile' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'org_id' => factory(App\Organisation::class)->create()->id,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Organisation::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Simple Support',
        'email' => 'support@simplesupport.com',
        'telephone' => $faker->phoneNumber,
        'contact_person' => $faker->name,
    ];
});

$factory->define(App\TicketStatus::class, function (Faker\Generator $faker) {

    return [
        'name' => 'Open',
        'color' => '#FF0000'
    ];
});

$factory->define(App\TicketPriority::class, function (Faker\Generator $faker) {

    return [
        'name' => 'Low',
        'color' => '#FF0000'
    ];
});

$factory->define(App\Ticket::class, function (Faker\Generator $faker) {

    return [
        'ticket_number' => uniqid(),
        'subject' => $faker->text(60),
        'content' => $faker->text,
        'priority_id' => factory(App\TicketPriority::class)->create()->id,
        'status_id' => factory(App\TicketStatus::class)->create()->id,
    ];
});



