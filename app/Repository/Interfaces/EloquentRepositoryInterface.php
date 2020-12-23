<?php

namespace App\Repository\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{
  /**
   * @param array $attributes
   * @return Model
   */
  public function create(array $attributes): Model;

  /**
   * @param $id
   * @return Model
   */
  public function find($id): ?Model;

  /**
   * @return Collecion
   */
  public function all(): Collection;

  /**
   * @param array $data
   * @param Model $model
   * @return Model
   */
  public function update(Model $model, array $data);

  /**
   * @param $id
   */
  public function delete($id): int;
}
