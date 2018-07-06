<?php

use Faker\Generator as Faker;

$factory->define(App\Player::class, function (Faker $faker) {
    $team_ids = \DB::table('teams')->select('id')->get()->toArray();
    $team_id = (!empty($team_ids) ? $faker->randomElement($team_ids)->id : null);
    return [
    	'team_id' => $team_id,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'image_url' => $faker->imageUrl(300, 300, 'people', true, 'Faker')
    ];
    
});
