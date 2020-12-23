<?php

namespace App\Services;

use App\Models\Starship;
use App\Repository\StarshipRepository;
use Exception;
use GuzzleHttp\Client;

class StarshipService
{
  /** @property StarshipRepository $starshipRepository */
  protected $starshipRepository;

  protected $baseURL = 'http://swapi.dev/api/starships';

  protected $options = ['content-type' =>  'Application/json'];

  public function __construct(StarshipRepository $starshipRepository)
  {
    $this->starshipRepository = $starshipRepository;
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
  public function getStarships()
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
      'description' => 'The number of Starships available.'
    ];
    return $schema;
  }

  public function getStarship($id)
  {
    $url = $this->baseURL . '/' . $id;
    $starship = $this->fetch($url, $this->options);
    $this->formatStarshipData($starship);
    return $starship;
  }

  public function updateStarshipCount($id, $data)
  {
    $resourse = $this->getStarship($id);
    /** @var Starship $starship */
    $starship = $this->getStarshipModel($resourse);
    $this->starshipRepository->update($starship, ['count' => $data]);
  }

  public function incrementCount($id)
  {
    $resourse = $this->getStarship($id);
    /** @var Starship $starship */
    $starship = $this->getStarshipModel($resourse);
    $this->starshipRepository->update($starship, ['count' => $starship->count + 1]);
  }

  public function decrementCount($id)
  {
    $resourse = $this->getStarship($id);
    /** @var Starship $starship */
    $starship = $this->getStarshipModel($resourse);
    $this->starshipRepository->update($starship, ['count' => $starship->count - 1]);
  }

  private function formatStarshipData(&$starship)
  {
    $record = $this->getStarshipModel($starship);

    if (empty($record)) {
      $this->starshipRepository->create(['model' => json_encode($starship), 'count' => '1', 'url' => $starship->url]);
      $starship->count = 0;
    } else {
      $starship->count = $record->count;
    }
  }

  private function formatData($data)
  {
    collect($data->results)->map(function ($starship) {
      $this->formatStarshipData($starship);
    });
    return $data;
  }
  /** 
   * @return Starship
   */
  public function getStarshipModel($starship)
  {
    $params = ['url' => $starship->url];
    $asd = $this->starshipRepository->search($params)->first();
    return $asd;
  }
}
