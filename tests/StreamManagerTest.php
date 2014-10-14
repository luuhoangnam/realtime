<?php


use Nam\Realtime\StreamManager;

class StreamManagerTest extends PHPUnit_Framework_TestCase
{
    private $app;

    /**
     * @var StreamManager
     */
    private $manager;

    protected function setUp()
    {
        $streamConfig = [
            'default'            => 'pusher',
            'connections.pusher' => [ 'driver' => 'pusher' ],
            'connections.foo'    => [ 'driver' => 'bar' ],
        ];

        $config = Mockery::mock('StdClass');
        $config->shouldReceive('get')->once()->with('realtime::stream')->andReturn($streamConfig);

        $app = Mockery::mock('\Illuminate\Foundation\Application');
        $app->shouldReceive('make')->once()->with('config')->andReturn($config);

        $this->app = $app;

        $this->manager = new StreamManager($this->app);
    }

    protected function tearDown()
    {
        Mockery::close();
        $this->app = null;
        $this->manager = null;
    }

    public function testDefaultConnectionCanBeResolve()
    {
        // prepare
        $connector = Mockery::mock('StdClass');
        $stream = Mockery::mock('StdClass');
        $connector->shouldReceive('connect')->once()->with([ 'driver' => 'pusher' ])->andReturn($stream);

        // act
        $addResult = $this->manager->addConnector('pusher', function () use ($connector) {
            return $connector;
        });

        $connection = $this->manager->connection('pusher');

        // assert
        $this->assertSame($stream, $connection);
        $this->assertInstanceOf('\Nam\Realtime\StreamManager', $addResult);
    }

    public function testAnotherConnectionCanBeResolve()
    {
        // prepare
        $connector = Mockery::mock('StdClass');
        $stream = Mockery::mock('StdClass');
        $connector->shouldReceive('connect')->once()->with([ 'driver' => 'bar' ])->andReturn($stream);

        // act
        $addResult = $this->manager->addConnector('bar', function () use ($connector) {
            return $connector;
        });

        $connection = $this->manager->connection('foo');

        // assert
        $this->assertSame($stream, $connection);
        $this->assertInstanceOf('\Nam\Realtime\StreamManager', $addResult);
    }

}
