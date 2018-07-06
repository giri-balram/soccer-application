<?php

use Faker\Generator as Faker;

$factory->define(App\Team::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'logo_url'=>$faker->imageUrl(300, 300, 'city', true, 'Faker')

        
    ];
});


