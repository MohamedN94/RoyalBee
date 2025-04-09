<?php

namespace App\Http\Controllers\Api\Drivers;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\DriverLocation;
use App\Models\Provider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DriversTrickingController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $driver = DriverLocation::create([
            'driver_id' => $request->driver_id,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);

        Driver::where('id', $request->driver_id)->update([
            'last_lat' => $request->lat,
            'last_lng' => $request->lng,
        ]);

        return response()->json(['code' => 200, 'message' => __('dashboard.addedSuccessfully'), 'item' => ''], 200);
    }
}
