<?php

namespace App\Http\Controllers\Api\Clients;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Card;
use App\Models\MainCard;
use App\Models\StoreAddition;
use App\Models\StoreItem;
use App\Models\Setting;
use App\Models\StoreBranch;
use App\Models\Address;
use App\Models\PromoCode;

use App\Transformers\CardTransformer;
use Illuminate\Http\Request;
use App\Helper\TripManager;

use TanslationHelper;

class ShoppingCartController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        return $this->middleware('auth:clients');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {

        $active_shopping_cart = MainCard::where('client_id', auth()->guard('clients')->user()->id)->first();
        if ($active_shopping_cart === NULL) {

            return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => NULL], 200);

        }
        if ($request->has('promo_code')) {
            $promo_code = PromoCode::whereDate('expired_date', '>=', date('Y-m-d'))->where('promo_code', $request->promo_code)
            ->first();
            if ($promo_code === NULL) {
                return response()->json(['code' => 422, 'status' => false, 'message' => 'كود الخصم غير موجود'], 422);
            }
            $store = $promo_code->stores->where('id', $active_shopping_cart->store_id)->first();
            if ($store === NULL) {
                return response()->json(['code' => 422, 'status' => false, 'message' => 'كود الخصم غير موجود'], 422);
            }
            $active_shopping_cart->promo_code_id = $promo_code->id;
            $active_shopping_cart->promo_code_discount = 0;
            if ($promo_code->discount_type == 'percentage') {
                $active_shopping_cart->promo_code_discount = $active_shopping_cart->order_total_price * $promo_code->discount / 100;
            }
            else {
                $active_shopping_cart->promo_code_discount = $promo_code->discount;
            }
            if ($active_shopping_cart->order_total_price <= $active_shopping_cart->promo_code_discount) {$active_shopping_cart->promo_code_discount = $active_shopping_cart->order_total_price;}
            $active_shopping_cart->save();
        }
        else {
            $active_shopping_cart->promo_code_id = NULL;
            $active_shopping_cart->promo_code_discount = 0;
            $active_shopping_cart->save();
        }
        $active_shopping_cart = MainCard::where('client_id', auth()->guard('clients')->user()->id)->first();
        $shopping_cart_details = fractal($active_shopping_cart, new CardTransformer());



        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $shopping_cart_details], 200);


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $setting = Setting::first();

        $active_shopping_cart = MainCard::where('client_id', auth()->guard('clients')->user()->id)->first();

        if (!$request->has('store_id')) {
            return response()->json(['code' => 422, 'message' =>'Choose Item Store', 'item' => []], 422);
        }

        $shopping_cart = MainCard::where('client_id', auth()->guard('clients')->user()->id)
        ->where('store_id', $request->store_id)->first();

        if($active_shopping_cart !== NULL && $active_shopping_cart->store_id != $request->store_id)
        {
            return response()->json(['code' => 422, 'message' =>'You Have Another Shopping Cart', 'item' => []], 422);
        }

//        if (!$request->has('branch_id')) {
//            return response()->json(['code' => 422, 'message' =>'Choose Branch', 'item' => []], 422);
//        }


        $branch = StoreBranch::where('id', 0);
//        if ($branch === NULL) {
//            return response()->json(['code' => 422, 'message' =>'Choose Branch', 'item' => []], 422);
//        }

        if(!$request->has('item_id')) {
            return response()->json(['code' => 422, 'message' => TanslationHelper::translate('Please Choose Item'), 'item' => []], 422);
        }

//
//        if ($item->store_id != $request->store_id || $item === NULL) {
//            return response()->json(['code' => 422, 'message' => TanslationHelper::translate('This Item Not Found In Store'), 'item' => []], 422);
//        }
//        if ($item->published != 1) {
//            return response()->json(['code' => 422, 'message' => TanslationHelper::translate('This Item Not Avilable Right Now'), 'item' => []], 422);
//        }


//        if($request->has('address_id')) {
//            $address = Address::where('id', $request->address_id)->where('client_id', auth()->guard('clients')->user()->id)->first();
//            if ($address === NULL) {
//                return response()->json(['code' => 422, 'message' => TanslationHelper::translate('Please Choose Valid Address'), 'item' => []], 422);
//            }
//            $trip_manager = new TripManager;
//            $trip_data = $trip_manager->calculate_trip_distance_time($address->lat, $address->lng,
//            $branch->lat, $branch->lng,  11);
//            $delivery_price = $trip_data['price'];
//        }
//        else {
//            $delivery_price = 0;
//        }



        $item = StoreItem::where('id', $request->item_id)->first();


        if($shopping_cart === NULL)
        {
            $shopping_cart = MainCard::create([
                'store_id' => $request->store_id,
                'branch_id'=>$request->branch_id,
                'client_id' => auth()->guard('clients')->user()->id,
                'delivery_price' => null
            ]);
        }
        else {
            $shopping_cart->update([
                'branch_id'=>$request->branch_id,
                'delivery_price' => null
            ]);

        }


        $detalies = Card::where('card_id', $shopping_cart->id)->where('item_id', $request->item_id)
        ->first();
        if($detalies === NULL)
        {
            $detalies = $shopping_cart->detalies()->create([
                'item_id' => $request->item_id,
                'qty' => $request->qty,
                'note' => $request->note,
                'total_price' => ($item->price - ($item->price * $item->discount / 100)) * $request->qty,
            ]);
        }
        else
        {
            $detalies->update([
                'qty' => $request->qty,
                'note' => $request->note,
                'total_price' => ($item->price - ($item->price * $item->discount / 100)) * $request->qty,
            ]);
        }

        if($request->qty < 1)
        {
            $detalies->delete();
        }


        if ($request->has('extra_id') && $request->qty > 0) {
            foreach ($request->extra_id as $items) {
                $store_addition = StoreAddition::where('id', $items)->first();
                $de = $detalies->extra()->create([
                    'addition_id' => $store_addition->id,
                    'price' => $store_addition->price
                ]);
                $detalies->update([
                    'total_price' => ($item->price + $de->price) * ($detalies->qty ),
                ]);
            }
        }


        $shopping_cart->update([
            'order_total_price' => $shopping_cart->detalies()->sum('total_price'),
            'order_total_after' => $shopping_cart->detalies()->sum('total_price')
        ]);

        $main_cards = Card::where('card_id', $shopping_cart->id)
            ->whereHas('card', function ($q) {
            $q->where('client_id', auth()->guard('clients')->user()->id);
        })->get();



        if ($shopping_cart->promo_code_id > 0) {
            $promo_code = PromoCode::whereDate('expired_date', '>=', date('Y-m-d'))->where('id', $shopping_cart->promo_code_id)
            ->first();
            if ($promo_code === NULL) {
                $active_shopping_cart->promo_code_id = NULL;
                $active_shopping_cart->promo_code_discount = 0;
            }
            else {
                $store = $promo_code->stores->where('id', $shopping_cart->store_id)->first();
                if ($store !== NULL) {
                    $active_shopping_cart->promo_code_id = NULL;
                    $active_shopping_cart->promo_code_discount = 0;
                }
                $shopping_cart->promo_code_id = $promo_code->id;
                $shopping_cart->promo_code_discount = 0;
                if ($promo_code->discount_type == 'percentage') {
                    $shopping_cart->promo_code_discount = $shopping_cart->order_total_price * $promo_code->discount / 100;
                }
                else {
                    $shopping_cart->promo_code_discount = $promo_code->discount;
                }
                if ($shopping_cart->order_total_price <= $shopping_cart->promo_code_discount) {$shopping_cart->promo_code_discount = $shopping_cart->order_total_price;}
                $shopping_cart->save();
            }
        }



        $shopping_cart_details = fractal($shopping_cart, new CardTransformer());
        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $shopping_cart_details], 200);


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $active_shopping_cart = MainCard::where('client_id', auth()->guard('clients')->user()->id)->first();

        $card = Card::where('card_id', $active_shopping_cart->id)->where('item_id', $request->item_id)->first();

        if ($card === NULL) {
            return response()->json(['code' => 442, 'message' => TanslationHelper::translate('This Item Not Found In Cart'), 'item' => []]);
        }

        $qty = $card->qty + 1;

        if ($card) {
            $card->update([
                'qty' => $qty,
                'total_price' => ($card->item->price ) * $qty,
            ]);

            $card->card->update([
                'order_total_price' => $card->card->detalies()->sum('total_price'),
                'order_total_after' => $card->card->detalies()->sum('total_price')
            ]);

        }
        $active_shopping_cart = MainCard::where('client_id', auth()->guard('clients')->user()->id)->first();
        $shopping_cart_details = fractal($active_shopping_cart, new CardTransformer());

        return response()->json(['code' => 200, 'message' => \App\Helper\TanslationHelper::translate('Data Fetched Successfully'),
            'item' => $shopping_cart_details
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sub(Request $request)
    {
        $active_shopping_cart = MainCard::where('client_id', auth()->guard('clients')->user()->id)->first();

        $card = Card::where('card_id', $active_shopping_cart->id)->where('item_id', $request->item_id)->first();

        if ($card === NULL) {
            return response()->json(['code' => 442, 'message' => TanslationHelper::translate('This Item Not Found In Cart'), 'item' => []]);
        }

        $qty = $card->qty - 1;

        if ($qty <= 0) {
            return response()->json(['code' => 442, 'message' => TanslationHelper::translate('Qty Should be 1 at least'), 'item' => []]);
        }

        if ($card) {
            $card->update(['qty' => $qty,
                'total_price' => ($card->item->price ) * $qty,
            ]);
            $card->card->update([
                'order_total_price' => $card->card->detalies()->sum('total_price'),
                'order_total_after' => $card->card->detalies()->sum('total_price')
            ]);
        }
        $active_shopping_cart = MainCard::where('client_id', auth()->guard('clients')->user()->id)->first();
        $shopping_cart_details = fractal($active_shopping_cart, new CardTransformer());

        return response()->json(['code' => 200, 'message' => \App\Helper\TanslationHelper::translate('Data Fetched Successfully'),
            'item' => $shopping_cart_details
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $active_shopping_cart = MainCard::where('client_id', auth()->guard('clients')->user()->id)->first();
        if($active_shopping_cart === NULL)
        {
            return response()->json(['code' => 422, 'message' =>'You Have No Shopping Cart', 'item' => []], 422);
        }

        $card = Card::where('item_id', $request->item_id)
        ->where('card_id', $active_shopping_cart->id)->first();
        if($card === NULL)
        {
            return response()->json(['code' => 422, 'message' =>'This Item Not Found', 'item' => []], 422);
        }
        $card->delete();


        $active_shopping_cart->update([
            'order_total_price' => $active_shopping_cart->detalies()->sum('total_price'),
            'order_total_after' => $active_shopping_cart->detalies()->sum('total_price')
        ]);
        if (count($active_shopping_cart->detalies) <= 0) {
            $active_shopping_cart->delete();
        }

        $active_shopping_cart = MainCard::where('client_id', auth()->guard('clients')->user()->id)->first();
        $shopping_cart_details = fractal($active_shopping_cart, new CardTransformer());
        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $shopping_cart_details], 200);

    }
}
