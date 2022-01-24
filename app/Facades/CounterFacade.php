<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * If we call this Facade, CounterContract will be called and than Counter class will be used finally.
 * @method static int increment(string $key, $tags = null)
 */
class CounterFacade extends Facade
{
  public static function getFacadeAccessor()
  {
    return 'App\Contracts\CounterContract';
  }
}