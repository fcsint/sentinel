<?php

namespace Cartalyst\Sentinel\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Suspension extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sentinel.suspensions';
    }
}
