<?php


namespace Nam\Realtime\Facades;

use Illuminate\Support\Facades\Facade;

class Stream extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'stream.connection';
    }
}