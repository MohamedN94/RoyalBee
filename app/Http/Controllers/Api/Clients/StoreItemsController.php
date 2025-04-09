<?php

namespace App\Http\Controllers\Api\Clients;

use App\Http\Controllers\Controller;
use App\Models\StoreAddition;
use App\Models\StoreItem;
use App\Transformers\ExtraIteamTransformer;
use App\Transformers\ItemsTransformer;
use App\Transformers\StoreAdditionTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreItemsController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        return $this->middleware('auth:clients');


    }

    public function items(Request $request):JsonResponse
    {

        $items = StoreItem::where('store_id', $request->store_id)
            ->where('category_id', $request->category_id)
            ->paginate(10);

        $items = fractal($items, new ItemsTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $items], 200);
    }
    public function singleItems(Request $request):JsonResponse
    {



        $items = StoreItem::find( $request->item_id) ;




        $items = fractal($items, new ItemsTransformer());


        $items_extrat = StoreAddition::where('item_id', $request->item_id)
            ->get();

        if(empty($items_extrat)){
            $items_extrat=null;
        }else{
            $items_extrat = fractal($items_extrat, new ExtraIteamTransformer());

        }






        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $items,'extra'=>$items_extrat], 200);
    }








    public function extras(Request $request):JsonResponse
    {
        $items = StoreAddition::where('store_id', $request->store_id)
            ->where('item_id', $request->item_id)
            ->get();

        $items = fractal($items, new StoreAdditionTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $items], 200);

    }
}
