<?php

namespace App\Services;

class SearchResult
{
  /**
   * Scout builder does not contain all of the methods as eloquent does,
   * so we are having search query first and than we can proceed with other queries as usual.
   */
  public static function search(string $model, string $result)
  {
    $ids = $model::search($result)->withTrashed()->get()->pluck('id');
    $models = $model::whereIn('id', $ids);

    return $models;
  }
}