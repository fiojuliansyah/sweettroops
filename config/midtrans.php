<?php

return [
    'server_key'    => env('MIDTRANS_SERVER_KEY'),
    'client_key'    => env('MIDTRANS_CLIENT_KEY'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized'  => true,
    'is_3ds'        => true,
    'base_url'      => env('MIDTRANS_BASE_URL', 'https://app.sandbox.midtrans.com/snap/snap.js'),
];

