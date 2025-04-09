<?php

namespace App\Http\Controllers\Api\Clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Transformers\ProfileTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        if (empty(auth()->guard('mobiles')->user())){
            return response()->json(['code' => 422, 'status'=>false,"message"=>trans('api.not_auth')],422);
        }
        $data= [
            //

            'id'=>Auth::guard('mobiles')->user()->id,
            'name'=>Auth::guard('mobiles')->user()->name,
            'mobile_number '=>Auth::guard('mobiles')->user()->mobile_number ,
            'sms_monthly'=>Auth::guard('mobiles')->user()->sms_monthly,
            'daily_sms'=>Auth::guard('mobiles')->user()->daily_sms,

        ];

        return response()->json(['code' => 200, 'status'=>true, 'message' => __('api.date_fetched_successfully'), 'data'=> $data], 200);
    }

}
