<?php

namespace Nam\Realtime;

/**
 * Class StreamManager
 *
 * @method publish( $channel, $event, $message )
 *
 * @package Nam\Realtime
 */
class StreamManager
{
    private $app;
    private $connections;
    private $connectors;
    private $config;

    /**
     * Create a new stream manager instance.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    public function __construct(\Illuminate\Foundation\Application $app)
    {
        $this->app = $app;
        $this->config = $this->getStreamConfig();
    }

    public function connection($name = null)
    {
        $name = $name ?: $this->getDefaultDriver();

        if ( ! isset( $this->connections[$name] )) {
            $this->connections[$name] = $this->resolve($name);
        }

        return $this->connections[$name];
    }

    public function getDefaultDriver()
    {
        return $this->config['default'];
    }

    private function resolve($name)
    {
        $config = $this->getConnectionConfig($name);

        return $this->getConnector($config['driver'])->connect($config);
    }

    protected function getConnector($driver)
    {
        if (isset( $this->connectors[$driver] )) {
            return call_user_func($this->connectors[$driver]);
        }

        throw new \InvalidArgumentException("No connector for [$driver]");
    }

    private function getConnectionConfig($name)
    {
        return $this->config['connections'][$name];
    }

    private function getStreamConfig()
    {
        return $this->app->make('config')->get('realtime::stream');
    }

    public function addConnector($driver, \Closure $resolver)
    {
        $this->connectors[$driver] = $resolver;

        return $this;
    }

    /**
     * Dynamically pass calls to the default connection.
     *
     * @param  string $method
     * @param  array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $callable = [ $this->connection(), $method ];

        return call_user_func_array($callable, $parameters);
    }

}