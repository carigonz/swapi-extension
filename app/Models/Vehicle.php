<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseVehicle;

/**
 * Class Vehicle 
 * 
 * @property string $vehicle_class
 */
class Vehicle extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    "model",
    "count",
    "url"
  ];

  public $timestamps = false;

  public function getCount()
  {
    return $this->count;
  }

  public function getUrl()
  {
    return $this->url;
  }
}
