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
        $key = $config['key'];
        $secret = $config['secret'];
        $app_id = $config['app_id'];

        $pusher = new \Pusher($key, $secret, $app_id);

        return new Pusher($pusher);
    }
}