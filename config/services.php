<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    // 'firebase' => [
    //     'apiKey' => env('FIREBASE_API_KEY'),
    //     'authDomain' => env('FIREBASE_AUTH_DOMAIN'),
    //     'databaseURL' => env('FIREBASE_DATABASE_URL'),
    //     'projectId' => env('FIREBASE_PROJECT_ID'),
    //     'storageBucket' => env('FIREBASE_STORAGE_BUCKET'),
    //     'messagingSenderId' => env('FIREBASE_MESSAGING_SENDER_ID'),
    //     'appId' => env('FIREBASE_APP_ID'),
    //     'measurementId' => env('FIREBASE_MEASUREMENT_ID'),
    // ],

    'firebase' => [
        'api_key' => env('FIREBASE_API_KEY'),
        'auth_domain' => env('FIREBASE_AUTH_DOMAIN'),
        'database_url' => env('FIREBASE_DATABASE_URL'),
        'project_id' => env('FIREBASE_PROJECT_ID'),
        'storage_bucket' => env('FIREBASE_STORAGE_BUCKET'),
        'messaging_sender_id' => env('FIREBASE_MESSAGING_SENDER_ID'),
        'app_id' => env('FIREBASE_APP_ID'),
        'measurement_id' => env('FIREBASE_MEASUREMENT_ID'),
    ],
    // 'firebase' => [ 
    //     'api_key' => 'AIzaSyBp3KnLn0QdFhKIA7S8zf-lfFDeJNHJnVM',
    //     'auth_domain' => 'tk-nirartha.firebaseapp.com',
    //     'database_url' => 'https://tk-nirartha-default-rtdb.asia-southeast1.firebasedatabase.app',
    //     'project_id' => 'tk-nirartha',
    //     'storage_bucket' => 'tk-nirartha.appspot.com',
    //     'messaging_sender_id' => '893394044292',
    //     'app_id' => '1:893394044292:web:c5c8f7dd54d9ad3228c9d1',
    //     'measurement_id' => 'G-ZTTXZ0DF0B',
    // ],

];
