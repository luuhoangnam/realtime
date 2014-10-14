<?php


namespace Nam\Realtime\Drivers;

use Nam\Realtime\StreamContract;
use Pubnub\Pubnub as PubnubService;

class Pubnub implements StreamContract
{
    /**
     * @var PubnubService
     */
    private $pubnub;

    public function __construct(PubnubService $pubnub)
    {
        $this->pubnub = $pubnub;
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
        $message = $this->encapsuleMessage($event, $message);

        $result = $this->pubnub->publish($channel, $message);

        if ($result[0]) {
            return true;
        }

        return false;
    }

    /**
     * @param string $event
     * @param string $message
     */
    private function encapsuleMessage($event, $message)
    {
        return [
            'event'   => $event,
            'message' => $message
        ];
    }
}