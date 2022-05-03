<?php

namespace Vladi\Landing\Facades;

use Illuminate\Support\Facades\Facade;

class JsonRpcClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'jsonrpcClient';
    }
}
