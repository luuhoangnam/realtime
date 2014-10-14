<?php


namespace Nam\Realtime;


interface ConnectorContract
{
    /**
     *
     * @param array $config
     *
     * @return \Nam\Realtime\StreamContract
     */
    public function connect(array $config);
}