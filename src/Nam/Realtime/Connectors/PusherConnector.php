<?php


namespace Nam\Realtime\Connectors;


use Nam\Realtime\ConnectorContract;
use Nam\Realtime\Drivers\Pusher;

class PusherConnector implements ConnectorContract
{
    /**
     *
     * @param array $config
     *
     * @return \Nam\Realtime\StreamContract
     */
    public function connect(array $config)
    {
        $auth_key = $config['auth_key'];
        $secret = $config['secret'];
        $app_id = $config['app_id'];

        $pusher = new \Pusher($auth_key, $secret, $app_id);

        return new Pusher($pusher);
    }
}