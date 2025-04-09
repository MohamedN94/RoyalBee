<?php

namespace App\Http\Controllers\Api\Clients;

use App\Helper\TripManager;
use App\Http\Controllers\Controller;
use App\Models\MainCard;
use App\Models\StoreOrder;
use App\Models\StoreOrderDetail;
use App\Transformers\CategoryTypesTransformer;
use App\Transformers\StoreOrdersDetailTransformer;
use App\Transformers\StoreOrdersTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreOrdersController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        return $this->middleware('auth:clients');
    }

    public function index(Request $request)
    {

        $orders = StoreOrder::where('client_id', Auth::guard('clients')->user()->id)->get();

        $orders = fractal($orders, new StoreOrdersTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $orders], 200);

    }
    public function show(Request $request)
    {

        $orders = StoreOrderDetail::where('order_id', $request->order_id)->get();

        $orders = fractal($orders, new StoreOrdersDetailTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $orders], 200);

    }






    public function store(Request $request)
    {

        if (Auth::guard('clients')->user()->status ) {
            return response()->json(['code' => 200,'status'=>false, 'message' => __('api.not_auth'), 'item' => ''], 200);
        }
        $cards = MainCard::where('client_id', Auth::guard('clients')->user()->id)->first();

        if (!$cards || $cards->detalies->count() == 0) {
            return response()->json(['code' => 200,'status'=>false, 'message' => __('api.cart_empty'), 'item' => []], 200);
        }

//        $trip_manager = new TripManager;
//        $trip_data = $trip_manager->calculate_trip_distance_time($request->lat, $request->lng,
//        optional($cards->branch)->lat, optional($cards->branch)->lng,  11);


        $cards->delivery_price = '10';
        $cards->order_total_after = $cards->order_total_price +  $cards->delivery_price;
        $cards->save();

        $order = StoreOrder::create([
            'client_id' => $cards->client_id,
            'store_id' => $cards->store_id,
            'note' =>  $request->note,
            'branch_id' => $cards->branch_id ?? 0,
            'to_lat' =>  $request->lat,
            'to_lng' => $request->lng,
            'to_address' => $request->address,
            'payment_method' => $request->payment_method,
            'price' => $cards->order_total_price,
            'price_after_discount' => $cards->order_total_price,
            'delivery_price' =>  $cards->delivery_price
        ]);

//        $track = new StoreOrderTracking;
//        $track->order_id = $order->id;
//        $track->status = 'pending';
//        $track->save();

        if ($cards->detalies->count()) {
            foreach ($cards->detalies as $detail) {
                $details = $order->details()->create([
                    'order_id' => $order->id,
                    'product_id' => $detail->item_id,
                    'price' => $detail->total_price,
                    'qty' => $detail->qty,
                ]);
                if ($detail->extra->count()) {
                    foreach ($detail->extra as $extra) {
                        $details->extra()->create([
                            'order_detail_id' => $details->id,
                            'addition_id' => $extra->addition_id,
                            'price' => $extra->price
                        ]);

                    }
                }
            }
        }

        $cards->detalies()->forcedelete();

        $cards->forcedelete();

        $orders = fractal($order, new StoreOrdersTransformer());
//
//        try {
//            $order->store->provider->notify(new NewStoreOrder($order));
//        }
//        catch(\Exception $t){}

        return response()->json(['code' => 200, 'message' =>'Data Fetched Successfully', 'item' => $orders], 200);
    }



}
