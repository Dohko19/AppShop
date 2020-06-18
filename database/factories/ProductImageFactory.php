<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\ProductImage;
use Faker\Generator as Faker;

$factory->define(ProductImage::class, function (Faker $faker) {
    return [
        'image' => 'https://picsum.photos/250/250/?random',
        'product_id' => $faker->numberBetween(1, 100),

    ];
});
