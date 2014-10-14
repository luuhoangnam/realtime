<?php


namespace Nam\Realtime\Drivers;

use Nam\Realtime\StreamContract;
use Pusher as PusherService;

class Pusher implements StreamContract
{
    /**
     * @var \Pusher
     */
    private $pusher;

    public function __construct(PusherService $pusher)
    {
        $this->pusher = $pusher;
    }

    /**
     * @param string $channel
     * @param string $event
     * @param string $message
     *
     * @return boolean
     */
    public function publish($channel, $event, $message)
    {
        return $this->pusher->trigger($channel, $event, $message);
    }
}