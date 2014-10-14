<?php


namespace Nam\Realtime;


use Illuminate\Support\ServiceProvider;
use Nam\Realtime\Connectors\PubnubConnector;

class RealtimeServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->package('nam/realtime');

        $this->registerManager();
    }

    private function registerManager()
    {
        $this->app->bindShared('stream', function ($app) {
            // Once we have an instance of the queue manager, we will register the various
            // resolvers for the queue connectors. These connectors are responsible for
            // creating the classes that accept queue configs and instantiate queues.
            $manager = new StreamManager($app);

            $this->registerConnectors($manager);

            return $manager;
        });

        $this->app->bindShared('stream.connection', function ($app) {
            return $app['stream']->connection();
        });
    }

    private function registerConnectors($manager)
    {
        foreach ([ 'Pusher', 'Pubnub' ] as $connector) {
            $this->{"register{$connector}Connector"}($manager);
        }
    }

    private function registerPubnubConnector(StreamManager $manager)
    {
        $app = $this->app;

        $manager->addConnector('pubnub', function () use ($app) {
            return new PubnubConnector;
        });
    }

    private function registerPusherConnector(StreamManager $manager)
    {
        $app = $this->app;

        $manager->addConnector('pubnub', function () use ($app) {
            return new PusherConnector;
        });
    }
}
