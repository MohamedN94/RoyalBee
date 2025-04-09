<?php

namespace App\Http\Controllers\Api\Clients;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Order;
use App\Models\RateDriver;
use App\Transformers\TripsTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class TripsController extends Controller
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
        $orders = Order::where('client_id', Auth::guard('clients')->user()->id)
            ->orderBy('id', 'DESC')->paginate(10);

        $order = fractal($orders, new TripsTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $order], 200);

    }

    public function show(Request $request)
    {
        $drivers = Driver::where('status', 'available')->selectRaw("*,
                         ( 6371000 * acos( cos( radians(?) ) *
                           cos( radians( latitude ) )
                           * cos( radians( longitude ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( latitude ) ) )
                         ) AS distance", [$request->lat, $request->lng, $request->lat])
            ->where('active', '=', 1)
            ->having("distance", "<", 400)
            ->orderBy("distance", 'asc')
            ->offset(0)
            ->limit(1)
            ->get();

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $order], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $order = Order::create([
            'client_id' => Auth::guard('clients')->user()->id,
            'driver_id' => 5,
            'car_id' => 3,
            'vehicle_id' => $request->vehicle_id,
            'vehicle_type_id' => $request->vehicle_type_id,
            'from_lat' => $request->from_lat,
            'from_lng' => $request->from_lng,
            'to_lat' => $request->to_lat,
            'to_lng' => $request->to_lng,
            'from_address' => $request->from_address,
            'to_address' => $request->to_address,
            'price' => $request->price,
            'price_after_discount' => $request->price,
            'payment_method' => $request->payment_method,
            'status' => 'accepted',
        ]);

        $order = fractal($order, new TripsTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $order], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function cancel(Request $request): JsonResponse
    {
        Order::where('id', $request->id)->update(['status' => 'canceled', 'reason' => $request->reason]);

        $order = Order::where('id', $request->id)->first();

        $order = fractal($order, new TripsTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $order], 200);


    }
}
