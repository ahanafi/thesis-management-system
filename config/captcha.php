<?php

return [
    'secret' => env('NOCAPTCHA_SECRET_KEY'),
    'sitekey' => env('NOCAPTCHA_SITE_KEY'),
    'options' => [
        'timeout' => 30,
    ],
];
