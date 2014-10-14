<?php

use Nam\Realtime\Drivers\Pubnub;

class PubnubDriverTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Mockery::close();
    }

    public function testPublishProperly()
    {
        // prepare
        $pubnub = $this->getPubnub();
        $pubnub->shouldReceive('publish')
               ->once()
               ->withArgs([ 'foo', [ 'event' => 'bar', 'message' => 'baz' ] ])
               ->andReturn([ 1, "Sent", "14132772747709236" ]);

        $driver = new Pubnub($pubnub);

        // act
        $result = $driver->publish('foo', 'bar', 'baz');

        // assert
        $this->assertTrue($result);
    }

    private function getPubnub()
    {
        return Mockery::mock('Pubnub\Pubnub');
    }
}
