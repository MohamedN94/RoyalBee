<?php

namespace App\Http\Controllers\Api\Clients;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Order;
use App\Models\RateDriver;
use App\Transformers\TripsRateTransformer;
use App\Transformers\TripsTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class TripsRateController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        return $this->middleware('auth:clients');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $order = Order::where('id', $request->trip_id)->first();

        $order = fractal($order, new TripsRateTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $order], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $driver = Order::where('id', $request->trip_id)->first();

        RateDriver::create([
            'client_id' => Auth::guard('clients')->user()->id,
            'driver_id' => $driver->driver_id,
            'trip_id' => $request->trip_id,
            'rate' => $request->rate,
            'notes' => $request->notes,
        ]);
        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => ''], 200);
    }
}
