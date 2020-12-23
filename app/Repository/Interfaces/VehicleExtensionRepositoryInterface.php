<?php

namespace App\Repository\Interfaces;

use Illuminate\Database\Eloquent\Model;
use App\Repository\Interfaces\EloquentRepositoryInterface;

interface VehicleExtensionRepositoryInterface extends EloquentRepositoryInterface
{
  /**
   * @return int
   */
  public function getCount(): int;
  /**
   * @param int $cuantity
   * @return Model
   */
  public function setCount(int $cuantity): Model;
}
