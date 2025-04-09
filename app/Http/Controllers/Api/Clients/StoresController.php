<?php

namespace App\Http\Controllers\Api\Clients;

use App\Http\Controllers\Controller;
use App\Models\CategoryType;
use App\Models\Offer;
use App\Models\Store;
use App\Models\StoreBranch;
use App\Models\Category;
use App\Models\StoreItem;
use App\Transformers\CategoryTypes;
use App\Transformers\CategoryTypesTransformer;
use App\Transformers\ItemsTransformer;
use App\Transformers\OffersTransformer;
use App\Transformers\ResturantsTransformer;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 */
class StoresController extends Controller
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
    public function categories(Request $request): JsonResponse
    {
        if($request-> category_id ==0){
            $categories = Category::all();
        }else{
            $categories = Category::where('id',$request-> category_id)->first();
        }
        $categories = fractal($categories, new CategoryTypesTransformer());
        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $categories], 200);
    }

    public function StoreCategories(Request $request): JsonResponse
    {

        if (!$request->has('store_id')) {
            return response()->json(['code' => 200, 'states'=>false, 'message' =>'Choose Store', 'item' => []], 200);
        }



        $all_items = StoreItem::where('store_id', $request->store_id)
            ->get();

        $all_items = fractal($all_items, new ItemsTransformer());



        if($request-> category_id ==0){
            $categories = Category::whereHas('items', function ($q) use ($request) {
                $q->where('store_id', $request->store_id);
            }) ->get();

        }else{
            $categories = Category::whereHas('items', function ($q) use ($request) {
                $q->where('store_id', $request->store_id);
            })->where('id',$request-> category_id)->first();
        }
        $categories = fractal($categories, new CategoryTypesTransformer());
        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'all_items'=>$all_items, 'item' => $categories ], 200);
    }




    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function nearestStores(Request $request): JsonResponse
    {
        $branches = Store::orderBy("id", 'asc')
            ->limit(20)
            ->get();

        $branches = fractal($branches, new ResturantsTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $branches], 200);

    }
    public function home_restaurant(): JsonResponse
    {
        $branches = StoreBranch::whereHas('stores')
            ->orderBy("distance", 'asc')
            ->groupBy('id')
            ->offset(0)
            ->limit(2)
            ->get();

        $branches = fractal($branches, new ResturantsTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $branches], 200);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function allNearestStores(Request $request): JsonResponse
    {
        $branches = StoreBranch::whereHas('stores', function ($q) use ($request) {
            $q->where('store_type', $request->type)
                ->where('status', 'available');
            if ($request->type == 'restaurant') {
                $q->where('store_category_id', $request->store_category_id);
            }
        })
            ->groupBy('id')
            ->offset(0)
            ->limit(2)
            ->paginate(10);

        $branches = fractal($branches, new ResturantsTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $branches], 200);

    }



    public function offers(): JsonResponse
    {

        $date=Carbon::now();

        $offers = Offer::where('start_date','<=', $date)->where('end_date','>=', $date)
            ->inRandomOrder()
            ->get();


        $offers = fractal($offers, new OffersTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $offers], 200);
    }

    public function singleOffer(Request $request): JsonResponse
    {

        $date=Carbon::now();

        $offers = Offer::where('id',$request->offer_id)->where('start_date','<=', $date)->where('end_date','>=', $date)
            ->first();


        $offers = fractal($offers, new OffersTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $offers], 200);
    }





}
