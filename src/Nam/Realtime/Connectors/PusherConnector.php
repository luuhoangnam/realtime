<?php


namespace Nam\Realtime\Connectors;


use Nam\Realtime\ConnectorContract;
use Nam\Realtime\Drivers\Pusher;

class PusherConnector implements ConnectorContract
{
    /**
     * @var \Pusher
     */
    private $pusher;

    public function __construct(\Pusher $pusher)
    {
        $this->pusher = $pusher;
    }

    /**
     *
     * @param array $config
     *
     * @return \Nam\Realtime\StreamContract
     */
    public function connect(array $config)
    {
        return new Pusher($this->pusher);
    }
}