<?php

return [
    'secret_key' => env('RECAPTCHA_SECRET_KEY'),
    'site_key'   => env('RECAPTCHA_SITE_KEY'),

    'is_active' => true,

    'score' => 0.5,

    'options' => [
        'timeout' => 1000.0,
    ]
];