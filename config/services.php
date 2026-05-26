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

    'telegram' => [
        'bot_token' => env('TELEGRAM_BOT_TOKEN'),
        'chat_id' => env('TELEGRAM_CHAT_ID'),
        'bot_token1' => env('TELEGRAM_BOT_TOKEN1'),
        'chat_id1' => env('TELEGRAM_CHAT_ID1'),
        'bot_token2' => env('TELEGRAM_BOT_TOKEN2'),
        'chat_id2' => env('TELEGRAM_CHAT_ID2'),
    ],

    'kuongkea' => [
        'bot_token' => env('KUONGKEA_BOT_TOKEN'),
        'chat_id' => env('KUONGKEA_CHAT_ID'),
    ],

    'facebook' => [
        'verify_token' => env('FB_VERIFY_TOKEN'),
        'page_id' => env('FB_PAGE_ID'),
    ],

];
