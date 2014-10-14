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
            'auth' => '',
            'secret'   => '',
            'app_id'   => '',
        ],
    ],
];
