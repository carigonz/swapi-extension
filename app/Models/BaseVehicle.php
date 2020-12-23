<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseVehicle 
 * 
 * @property string $cargo_capacity
 * @property string $consumables
 * @property string $cost_in_credits
 * @property string $crew
 * @property string $length
 * @property string $manufacturer
 * @property string $max_atmosphering_speed
 * @property string $model
 * @property string $name
 * @property string $passengers
 * @property string $pilots
 * @property string $films
 * @property string $url
 * @property datetime $created
 * @property datetime $edited
 */
class BaseVehicle extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    "title",
    "description",
    "cargo_capacity",
    "consumables",
    "cost_in_credits",
    "crew",
    "length",
    "manufacturer",
    "max_atmosphering_speed",
    "model",
    "name",
    "passengers",
    "pilots",
    "films",
    "url",
    "count"
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    "created" => 'datetime',
    "edited" => 'datetime',
  ];
}
