<?php


use Nam\Realtime\Drivers\Pusher;

class PusherDriverTest extends PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testPublishProperly()
    {
        // prepare
        $pusher = $this->getPusher();
        $pusher->shouldReceive('trigger')
               ->once()
               ->withArgs([ 'foo', 'bar', 'baz' ])
               ->andReturn(true);
        $driver = new Pusher($pusher);

        // act
        $result = $driver->publish('foo', 'bar', 'baz');

        // assert
        $this->assertTrue($result);
    }

    /**
     * @return \Mockery\MockInterface
     */
    private function getPusher()
    {
        return Mockery::mock('\Pusher');
    }
}
