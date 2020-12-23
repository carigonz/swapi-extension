<?php

namespace App\Services;

use App\Models\Vehicle;
use App\Repository\VehicleRepository;
use GuzzleHttp\Client;
use Exception;

class VehicleService
{
  /** @property VehicleRepository $vehicleRepository */
  protected $vehicleRepository;

  protected $baseURL = 'http://swapi.dev/api/vehicles';

  protected $options = ['content-type' =>  'Application/json'];

  public function __construct(VehicleRepository $vehicleRepository)
  {
    $this->vehicleRepository = $vehicleRepository;
  }

  /** 
   * @param array $params
   * @return object
   */
  public function getWithParams($params)
  {
    $url = $this->baseURL . '/?search=' . $params;
    $data = $this->fetch($url, $this->options);

    $this->formatData($data);
    return $data;
  }

  /** 
   * @param string $url
   * @param array $options
   * @return object
   */
  private function fetch($url, $options)
  {
    try {
      $client = new Client();
      $res = $client->get($url, $options);
    } catch (\Throwable $th) {
      throw new Exception('Model id not fount');
    }
    return json_decode($res->getBody());
  }

  /** 
   * @param string $url
   * @param array $options
   * @return string
   */
  public function getVehicles()
  {
    $data = $this->fetch($this->baseURL, $this->options);

    $data = $this->formatData($data);
    return $data;
  }

  public function getSchema()
  {
    $url = $this->baseURL . '/schema';
    $schema = $this->fetch($url, $this->options);
    array_push($schema->required, 'count');
    $schema->properties->count = (object) [
      'type' => 'string',
      'description' => 'The number of Vehicles available.'
    ];
    return $schema;
  }

  public function getVehicle($id)
  {
    $url = $this->baseURL . '/' . $id;
    $vehicle = $this->fetch($url, $this->options);
    $this->formatVehicleData($vehicle);
    return $vehicle;
  }

  public function updateVehicleCount($id, $data)
  {
    $resourse = $this->getVehicle($id);
    /** @var Vehicle $vehicle */
    $vehicle = $this->getVehicleModel($resourse);
    $this->vehicleRepository->update($vehicle, ['count' => $data]);
  }

  public function incrementCount($id)
  {
    $resourse = $this->getVehicle($id);
    /** @var Vehicle $vehicle */
    $vehicle = $this->getVehicleModel($resourse);
    $this->vehicleRepository->update($vehicle, ['count' => $vehicle->count + 1]);
  }

  public function decrementCount($id)
  {
    $resourse = $this->getVehicle($id);
    /** @var Vehicle $vehicle */
    $vehicle = $this->getVehicleModel($resourse);
    $this->vehicleRepository->update($vehicle, ['count' => $vehicle->count - 1]);
  }

  private function formatVehicleData(&$vehicle)
  {
    $record = $this->getVehicleModel($vehicle);

    if (empty($record)) {
      $this->vehicleRepository->create(['model' => json_encode($vehicle), 'count' => '1', 'url' => $vehicle->url]);
      $vehicle->count = 0;
    } else {
      $vehicle->count = $record->count;
    }
  }

  private function formatData($data)
  {
    collect($data->results)->map(function ($vehicle) {
      $this->formatVehicleData($vehicle);
    });
    return $data;
  }
  /** 
   * @return Vehicle
   */
  public function getVehicleModel($vehicle)
  {
    $params = ['url' => $vehicle->url];
    $asd = $this->vehicleRepository->search($params)->first();
    return $asd;
  }
}
