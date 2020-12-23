<?php

namespace App\Models;

use App\Models\BaseVehicle;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Starship 
 * 
 * @property string $MGLT
 * @property string $hyperdrive_rating
 * @property string $starship_class
 */
class Starship extends Model
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
