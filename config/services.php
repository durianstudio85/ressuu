<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
    'client_id' => '716899161797056',
    'client_secret' => '644324c7b9c63ea2ecacd52511406aab',
    'redirect' => 'https://ressuu.me/auth/facebook/callback',
    ],

    'twitter' => [
    'client_id' => 'Tt0Vq2E0JjTP7m6nSVeIUtLFS',
    'client_secret' => 'CSw417InX8eDhNGlBOLzGy9hdSp7AbJd1CeaM5ay6Y37XuvNjA',
    'redirect' => 'https://ressuu.me/auth/twitter/callback',
    ],


];
