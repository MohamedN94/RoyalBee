<?php

namespace App\Http\Controllers\Api\Drivers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Transformers\ProfileTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 */
class ProfileController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        return $this->middleware('auth:drivers');
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $driver = auth()->guard('drivers')->user();

        $driver = fractal($driver, new ProfileTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $driver], 200);
    }

    /**
     * @param ProfileRequest $request
     * @return JsonResponse
     */
    public function store(ProfileRequest $request): JsonResponse
    {
        $driver = auth()->guard('drivers')->user();

        $driver->update([
            'mobile' => $request->mobile,
            'email' => $request->email,
        ]);

        $driver = fractal($driver, new ProfileTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $driver], 200);
    }

    public function uploadImage(Request $request)
    {
        $driver = auth()->guard('drivers')->user();

        $driver->update([
            'image' => $request->image,
        ]);

        $driver = fractal($driver, new ProfileTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $driver], 200);
    }
}
