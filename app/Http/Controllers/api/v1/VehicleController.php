<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\VehicleService;
use Symfony\Component\HttpFoundation\Request;

class VehicleController extends Controller
{
  /** @property VehicleService $vehicleService */
  protected $vehicleService;

  public function __construct(VehicleService $vehicleService)
  {
    $this->vehicleService = $vehicleService;
  }

  public function all(Request $request)
  {
    try {
      $query = $request->get('search');
      if ($query) {
        $data = $this->vehicleService->getWithParams($query);
      } else {
        $data = $this->vehicleService->getVehicles();
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
      $data = $this->vehicleService->getSchema();

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
      $data = $this->vehicleService->getVehicle($request->id);

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
      $data = $this->vehicleService->getVehicle($request->id);

      return response()->json([
        'count' => $data->count,
        'vehicle' => $data
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
      $this->vehicleService->updateVehicleCount($request->id, $count);

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
      $this->vehicleService->incrementCount($request->id);

      return response()->json('Count updated correctly!');
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
      $this->vehicleService->decrementCount($request->id);

      return response()->json('Count updated correctly!');
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
