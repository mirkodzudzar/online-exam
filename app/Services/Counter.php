<?php

namespace App\Services;

use App\Contracts\CounterContract;
use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Contracts\Session\Session;

class Counter implements CounterContract
{
  private $timeout;
  private $cache;
  private $session;
  private $supports_tags;

  // Cache and Session are injected dependencies.
  public function __construct(Cache $cache, Session $session, int $timeout)
  {
    $this->timeout = $timeout;
    $this->cache = $cache;
    $this->session = $session;
    $this->supports_tags = method_exists($cache, 'tags');
  }

  public function increment(string $key, array $tags = null): int
  {
    // Id of current user session.
    $session_id = $this->session->getId();
    $counter_key = "{$key}-counter";
    $users_key = "{$key}-users";

    $cache = $this->supports_tags && null !== $tags 
            ? $this->cache->tags($tags) : $this->cache;

    // Get all users from cache for this profesison, by unique key.
    $users = $cache->get($users_key, []);
    // Array to store new users.
    $users_update = [];
    $difference = 0;
    $now = now();

    foreach ($users as $session => $last_visit) {
      // If time is equal or more then one minute.
      if ($now->diffInMinutes($last_visit) >= $this->timeout) {
        // Decrease counter for each user.
        $difference--;
      } else {
        // User will stay saved in this array.
        $users_update[$session] = $last_visit;
      }
    }

    // Check if current user is not in array or if last visit time is equal or more then one minute.
    if(!array_key_exists($session_id, $users) 
       || $now->diffInMinutes($users[$session_id]) >= $this->timeout) 
    {
      $difference++;
    }

    // Set current user value.
    $users_update[$session_id] = $now;
    // Save all current users into cache.
    $cache->forever($users_key, $users_update);
    // If cache does not have counter value, save it forever.
    if (!$cache->has($counter_key)) {
      $cache->forever($counter_key, 1);
    } else {
      // If cache already have counter set, save new difference value.
      $cache->increment($counter_key, $difference);
    }

    // Getting value of counter from cache.
    $counter = $cache->get($counter_key);

    return $counter;
  }
}