<?php

return [
    'default'     => 'pubnub',
    'connections' => [
        'pubnub' => [
            'driver'        => 'pubnub',
            'public_key'    => '',
            'subscribe_key' => '',
            'secret_key'    => '',
        ],
        'pusher' => [
            'driver'   => 'pusher',
            'auth_key' => '',
            'secret'   => '',
            'app_id'   => '',
        ],
    ],
];
