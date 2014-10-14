<?php


use Nam\Realtime\Connectors\PusherConnector;

class PusherConnectorTest extends PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testSuccessfulConnect()
    {
        // prepare
        $pusher = Mockery::mock('\Pusher');
        $connector = new PusherConnector($pusher);

        // act
        $connection = $connector->connect([ ]);

        // assert
        $this->assertInstanceOf('\Nam\Realtime\Drivers\Pusher', $connection);
    }
}
