<?php

namespace App\Repository;

use App\Repository\Interfaces\VehicleExtensionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection;

class BaseRepository implements VehicleExtensionRepositoryInterface
{
  /**      
   * @var Model      
   */
  protected $model;

  /**      
   * BaseRepository constructor.      
   *      
   * @param Model $model      
   */
  public function __construct(Model $model)
  {
    $this->model = $model;
  }

  /**
   * @param array $attributes
   *
   * @return Model
   */
  public function create(array $attributes): Model
  {
    return $this->model->create($attributes);
  }

  /**
   * @param $id
   * @return Model
   */
  public function find($id): ?Model
  {
    if (null == $model = $this->model->find($id)) {
      throw new ModelNotFoundException("Model not found");
    }

    return $model;
  }

  /**
   * @return Collection
   */
  public function all(): Collection
  {
    return $this->model->all();
  }

  /**
   * @param array $data
   * @param $id
   * @return 
   */
  public function update(Model $model, array $data)
  {
    return $model->update($data);
  }

  /**
   * @param $id
   * @return int
   */
  public function delete($id): int
  {
    return $this->model->destroy($id);
  }

  /**
   * @return int
   */
  public function getCount(): int
  {
    return $this->model->getCount();
  }

  /**
   * @param int $cuantity
   * @return Model
   */
  public function setCount(int $cuantity): Model
  {
    $this->model->update(['count' => $cuantity]);
    return $this->model->fresh();
  }
}
