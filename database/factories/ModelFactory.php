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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Agenda::class, function (Faker\Generator $faker) {
   return [
//       'cliente_id' => factory(App\Cliente::class)->create()->id,
       'filial_id' => factory(App\Filial::class)->create()->id,
       'data' => $faker->date(),
       'periodo' => 'Semestral',
       'inicio' => $faker->time(),
       'pecas' => $faker->numerify()
   ];
});

$factory->define(App\Filial::class, function (Faker\Generator $faker) {
    return [
        'uf_id' => App\Uf::all()->random(1)->id,
        'nome' => $faker->name
    ];
});

$factory->define(App\Cargo::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name
    ];
});

//$factory->define(App\Vendedor::class, function (Faker\Generator $faker) {
//    return [
//        'cargo_id' => factory(App\Cargo::class)->create()->id,
//        'nome' => $faker->name,
//        'password' => $faker->password()
//    ];
//});
