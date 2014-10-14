<?php

namespace Nam\Realtime\Connectors;

use Nam\Realtime\ConnectorContract;
use Nam\Realtime\Drivers\Pubnub as PubnubDriver;
use Pubnub\Pubnub;

class PubnubConnector implements ConnectorContract
{
    /**
     * @var Pubnub
     */
    private $pubnub;

    public function __construct(Pubnub $pubnub)
    {
        $this->pubnub = $pubnub;
    }

    /**
     * @return \Nam\Realtime\StreamContract
     */
    public function connect(array $config)
    {
        return new PubnubDriver($this->pubnub);
    }
}