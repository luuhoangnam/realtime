<?php


namespace Nam\Realtime;


interface StreamContract
{
    /**
     * @param string $channel
     * @param string $event
     * @param string $message
     *
     * @return boolean
     */
    public function publish($channel, $event, $message);
}