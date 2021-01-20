<?php

use Faker\Generator as Faker;
use Maxtc\LaravelNewsletterSubscription\NewsletterSubscription;

$factory->define(NewsletterSubscription::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
    ];
});
