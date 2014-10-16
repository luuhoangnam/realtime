<?php


use Nam\Realtime\Connectors\PubnubConnector;

class PubnubConnectorTest extends PHPUnit_Framework_TestCase
{
    public function test_connect_successful()
    {
        // prepare
        $config = [
            'public_key'    => 'demo',
            'subscribe_key' => 'demo',
            'secret_key'    => 'demo',
        ];
        $connector = new PubnubConnector;

        // act
        $result = $connector->connect($config);

        // assert
        $this->assertInstanceOf('\Nam\Realtime\Drivers\Pubnub', $result);
    }
}
