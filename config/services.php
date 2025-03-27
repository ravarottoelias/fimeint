<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
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

    'mercadopago' => [
        'key' => env('MERCADOPAGO_PUBLIC_KEY'),
        'token' => env('MERCADOPAGO_ACCESS_TOKEN'),
        'api_url' => 'https://api.mercadopago.com/v1'
    ],

    'paypal' => [
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'secret' => env('PAYPAL_CLIENT_SECRET'),
        'settings' => [
            'mode' => env('PAYPAL_MODE', 'sandbox'),
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'ERROR',
        ]
        ],
    'ms_cert_validation' => [
        'api_url' => env('MS_CERT_VALIDATION_API_URL', 'localhost:8089'),
        'user_email' => env('MS_CERT_VALIDATION_USER_EMAIL', 'user@email.com'),
        'user_password' => env('MS_CERT_VALIDATION_USER_PASSWORD', 'password'),
        'app_cert_validation_url' => env('APP_CERT_VALIDATION_URL', 'app-cert.example.com'),
    ]

];
