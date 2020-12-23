<?php

namespace App\Repository;

use App\Models\Vehicle;

class VehicleRepository extends BaseRepository
{

  /**
   * VehicleRepository constructor.
   * @param Vehicle $model
   */
  public function __construct(Vehicle $model)
  {
    parent::__construct($model);
  }

  /**
   * @param array $params
   * @param bool $distinct
   * @return Vehicle|int
   */
  public function search($params = [], $distinct = true)
  {
    $query = $this->model
      ->select('vehicles.*');

    if ($distinct) {
      $query->distinct('vehicles.id');
    }

    if (isset($params['url']) && $params['url']) {
      $query->where('url', $params['url']);
    }

    return $query->orderBy('vehicles.id', 'asc');
  }
}
