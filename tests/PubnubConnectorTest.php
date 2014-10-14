<?php

use Nam\Realtime\Connectors\PubnubConnector;

class PubnubConnectorTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Mockery::close();
    }

    public function testSuccessfulConnect()
    {
        // prepare
        $pubnub = Mockery::mock('\Pubnub\Pubnub');
        $connector = new PubnubConnector($pubnub);

        // act
        $connection = $connector->connect([ ]);

        // assert
        $this->assertInstanceOf('\Nam\Realtime\Drivers\Pubnub', $connection);
    }
}
