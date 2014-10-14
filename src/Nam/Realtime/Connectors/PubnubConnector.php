<?php

namespace Nam\Realtime\Connectors;

use Nam\Realtime\ConnectorContract;
use Nam\Realtime\Drivers\Pubnub as PubnubDriver;
use Pubnub\Pubnub;

class PubnubConnector implements ConnectorContract
{
    /**
     * @return \Nam\Realtime\StreamContract
     */
    public function connect(array $config)
    {
        $public_key = $config['public_key'];
        $subscribe_key = $config['subscribe_key'];
        $secret_key = $config['secret_key'];

        $pubnub = new Pubnub($public_key, $subscribe_key, $secret_key);

        return new PubnubDriver($pubnub);
    }
}