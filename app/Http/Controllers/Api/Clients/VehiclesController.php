<?php

namespace App\Http\Controllers\Api\Clients;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Transformers\VehiclesTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 */
class VehiclesController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        return $this->middleware('auth:clients');
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $types = [
            [
                'id' => 1,
                'name' => __('api.car'),
                'icon' => asset('assets/media/icons/car.png'),
            ], [
                'id' => 2,
                'name' => __('api.scooter'),
                'icon' => asset('assets/media/icons/scooter.png'),
            ],
        ];

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => ['data' => $types]], 200);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function vehicle(Request $request): JsonResponse
    {
        $vehicles = Vehicle::all();

        $google = "https://maps.googleapis.com/maps/api/distancematrix/json?units=km&origins=" . $request->from_lat . "," . $request->from_lng . "&destinations=" . $request->to_lat . "," . $request->to_lng . "&departure_time=now&key=AIzaSyACB51q15ZDksgt1jvtAYHH3XiU5SQZJGU";

        $json = @file_get_contents($google);

        $map = json_decode($json);

        $vehicles = fractal($vehicles, new VehiclesTransformer(['map' => $map]));

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $vehicles], 200);

    }

}
