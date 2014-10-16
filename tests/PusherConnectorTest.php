<?php

use Nam\Realtime\Connectors\PusherConnector;

class PusherConnectorTest extends PHPUnit_Framework_TestCase
{
    public function test_connect_successful()
    {
        // prepare
        $config = [
            'key'    => 'demo',
            'secret' => 'demo',
            'app_id' => 'demo',
        ];
        $connector = new PusherConnector;

        // act
        $result = $connector->connect($config);

        // assert
        $this->assertInstanceOf('\Nam\Realtime\Drivers\Pusher', $result);
    }

}
