<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\StarshipService;
use Symfony\Component\HttpFoundation\Request;

class StarshipController extends Controller
{
  /** @property StarshipService $starshipService */
  protected $starshipService;

  public function __construct(StarshipService $starshipService)
  {
    $this->starshipService = $starshipService;
  }

  public function all(Request $request)
  {
    try {
      $query = $request->get('search');
      if ($query) {
        $data = $this->starshipService->getWithParams($query);
      } else {
        $data = $this->starshipService->getStarships();
      }
      return response()->json($data);
    } catch (\Throwable $th) {
      logger($th->getMessage());
      logger($th->getTraceAsString());
      return response()->json([
        'message' => 'Unexpected Error!',
        'details' => $th->getMessage()
      ], 500);
    }
  }

  public function schema()
  {
    try {
      $data = $this->starshipService->getSchema();

      return response()->json($data);
    } catch (\Throwable $th) {
      logger($th->getMessage());
      logger($th->getTraceAsString());
      return response()->json([
        'message' => 'Unexpected Error!',
        'details' => $th->getMessage()
      ], 500);
    }
  }

  public function get(Request $request)
  {
    try {
      $data = $this->starshipService->getStarship($request->id);

      return response()->json($data);
    } catch (\Throwable $th) {
      logger($th->getMessage());
      logger($th->getTraceAsString());
      return response()->json([
        'message' => 'Unexpected Error!',
        'details' => $th->getMessage()
      ], 500);
    }
  }

  public function getCount(Request $request)
  {
    try {
      $data = $this->starshipService->getStarship($request->id);

      return response()->json([
        'count' => $data->count,
        'starship' => $data
      ]);
    } catch (\Throwable $th) {
      logger($th->getMessage());
      logger($th->getTraceAsString());
      return response()->json([
        'message' => 'Unexpected Error!',
        'details' => $th->getMessage()
      ], 500);
    }
  }

  public function setCount(Request $request)
  {
    $count = $request->get('count');

    if (!$count) {
      return response()->json([
        'message' => 'Bad Request',
        'details' => "Parameter 'Count' is required"
      ], 404);
    }
    try {
      $this->starshipService->updateStarshipCount($request->id, $count);

      return response()->json(['message' => 'Count updated correctly!']);
    } catch (\Throwable $th) {
      logger($th->getMessage());
      logger($th->getTraceAsString());
      return response()->json([
        'message' => 'Unexpected Error!',
        'details' => $th->getMessage()
      ], 500);
    }
  }

  public function increment(Request $request)
  {
    try {
      $this->starshipService->incrementCount($request->id);

      return response()->json(['message' => 'Count updated correctly!']);
    } catch (\Throwable $th) {
      logger($th->getMessage());
      logger($th->getTraceAsString());
      return response()->json([
        'message' => 'Unexpected Error!',
        'details' => $th->getMessage()
      ], 500);
    }
  }

  public function decrement(Request $request)
  {
    try {
      $this->starshipService->decrementCount($request->id);

      return response()->json(['message' => 'Count updated correctly!']);
    } catch (\Throwable $th) {
      logger($th->getMessage());
      logger($th->getTraceAsString());
      return response()->json([
        'message' => 'Unexpected Error!',
        'details' => $th->getMessage()
      ], 500);
    }
  }
}
