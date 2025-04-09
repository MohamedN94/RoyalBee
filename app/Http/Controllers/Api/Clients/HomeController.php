<?php

namespace App\Http\Controllers\Api\Clients;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\StoreBranch;
use App\Models\StoreOrder;
use App\Transformers\HomeTypesTransformer;
use App\Transformers\ResturantsTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
//        return $this->middleware('auth:clients');
    }


    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {

        $buyProductLists = StoreOrder::select('store_id',DB::raw('count(*) as total'))
            ->groupBy('store_id')
            ->orderBy('total', 'DESC')
            ->get();
        $mostSellingStore = Store::whereIn('id', $buyProductLists->pluck('store_id'))->get();
        $branches = fractal($mostSellingStore, new ResturantsTransformer());


        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => ['data' => $branches]], 200);
    }
}
