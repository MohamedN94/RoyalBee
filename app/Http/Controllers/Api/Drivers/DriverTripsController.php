<?php

namespace App\Http\Controllers\Api\Drivers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Transformers\TripsTransformer;
use Illuminate\Http\Request;

/**
 *
 */
class DriverTripsController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        return $this->middleware('auth:drivers');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(Request $request)
    {
        $order = Order::where('id', $request->id)->update(['status', $request->status]);

        $order = fractal($order, new TripsTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $order], 200);
    }
}
