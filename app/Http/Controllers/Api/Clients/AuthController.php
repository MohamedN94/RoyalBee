<?php

namespace App\Http\Controllers\Api\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Transformers\ClientTransformer;
use App\Transformers\MobileTransformer;
use App\Transformers\OtpTransformer;
use App\Transformers\ProfileTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
    }



    public function login(Request $request): JsonResponse
    {

        if($request->mobile_number == ""){
            return response()->json(['code' => 422, 'status'=>false,"message"=>trans('api.mobile')],422);
        }
        if ($token = Auth::guard('mobiles')->attempt(['mobile_number' => $request->mobile_number, 'password' => $request->password])) {

            $data= [
                //

                'id'=>Auth::guard('mobiles')->user()->id,
                'name'=>Auth::guard('mobiles')->user()->name,
                'mobile_number '=>Auth::guard('mobiles')->user()->mobile_number ,
                'sms_monthly'=>Auth::guard('mobiles')->user()->sms_monthly,
                'daily_sms'=>Auth::guard('mobiles')->user()->daily_sms,
                'token'=>$token,

            ];



            return response()->json(['code' => 200, 'status'=>true, 'message' => __('api.date_fetched_successfully'), 'data'=> $data], 200);

        }



        return response()->json(['code' => 422, 'status'=>false, 'message' => __('api.invalid_otp'), 'item' => ''], 422);
    }

    /**
     * @param Request $request
     * @return JsonResponse
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

}
