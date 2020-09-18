<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OAuth Server connection details
    |--------------------------------------------------------------------------
    |
    | Here you may specify the client details for the OAuth server
    |
    */

    'oauth' => [
        'server' => [
            'url' => env('OAUTH_SERVER_URL'),
        ],
        'client' => [
            'id' => env('OAUTH_CLIENT_ID'),
            'secret' => env('OAUTH_CLIENT_SECRET'),
        ],
    ],

];
