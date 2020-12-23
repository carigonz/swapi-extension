<?php

namespace App\Repository;

use App\Models\Starship;
use Illuminate\Database\Eloquent\Model;

class StarshipRepository extends BaseRepository
{

  /**
   * StarshipRepository constructor.
   *
   * @param Starship $model
   */
  public function __construct(Starship $model)
  {
    parent::__construct($model);
  }

  /**
   * @param array $params
   * @param bool $distinct
   * @return Starship|int
   */
  public function search($params = [], $distinct = true)
  {
    $query = $this->model
      ->select('starships.*');

    if ($distinct) {
      $query->distinct('starships.id');
    }

    if (isset($params['url']) && $params['url']) {
      $query->where('url', $params['url']);
    }

    return $query->orderBy('starships.id', 'asc');
  }
}
