<?php

namespace App\Http\Controllers\Api\Drivers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Provider;
use App\Transformers\ClientTransformer;
use App\Transformers\OtpTransformer;
use App\Transformers\ProfileTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:drivers')->only('logout', 'refresh');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function otp(Request $request): JsonResponse
    {
        $client = Provider::where('mobile_number', $request->mobile)->first();

        $numbers = rand(1000, 9999);

        if (!$client) {
            return response()->json(['code' => 422, 'message' => __('api.not_client'), 'item' => ''], 422);
        }

        $client->update(['otp' => $numbers, 'password' => bcrypt($numbers)]);

        $client = fractal($client, new OtpTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $client], 200);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        if ($token = Auth::guard('drivers')->attempt(['mobile_number' => $request->mobile, 'password' => $request->otp])) {

            $user = fractal($token, new ClientTransformer());

            return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $user], 200);

        }
        return response()->json(['code' => 422, 'message' => __('api.invalid_otp'), 'item' => ''], 422);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $client = Client::where('mobile_number', $request->mobile)->first();

        $numbers = rand(1000, 9999);

        if ($client) {
            return response()->json(['code' => 422, 'message' => __('api.client_already_exist'), 'item' => ''], 422);
        }

        $client = Client::create(['mobile_number' => $request->mobile, 'otp' => $numbers, 'password' => bcrypt($numbers)]);

        $client = fractal($client, new OtpTransformer());

        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'item' => $client], 200);

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

}
