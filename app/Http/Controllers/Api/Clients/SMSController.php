<?php

namespace App\Http\Controllers\Api\Clients;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Card;
use App\Models\Client;
use App\Models\MainCard;
use App\Models\Sms;
use App\Models\SmsMobile;
use App\Models\StoreAddition;
use App\Models\StoreItem;
use App\Models\Setting;
use App\Models\StoreBranch;
use App\Models\Address;
use App\Models\PromoCode;

use App\Models\StoreSlider;
use App\Transformers\CardTransformer;
use App\Transformers\CompleteCampaigns;
use App\Transformers\GroupTransformer;
use App\Transformers\SMSDtataTransformer;
use App\Transformers\SMSTransformer;
use App\Transformers\StoreSliderTransformer;
use Illuminate\Http\Request;
use App\Helper\TripManager;

use TanslationHelper;

class SMSController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
//        return $this->middleware('auth:mobiles');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function Slider(Request $request)
    {
        if (empty(auth()->guard('mobiles')->user())){
            return response()->json(['code' => 422, 'status'=>false,"message"=>trans('api.not_auth')],422);
        }
        $slider=StoreSlider::all();
        $slider = fractal($slider, new StoreSliderTransformer())->toArray()['data'];
        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'data' => $slider], 200);
    }
    public function smsGroup(Request $request)
    {
        if (empty(auth()->guard('mobiles')->user())){
            return response()->json(['code' => 422, 'status'=>false,"message"=>trans('api.not_auth')],422);
        }
        $sms = SmsMobile::where('user_id', auth()->guard('mobiles')->user()->user_id)
            ->where('mobile', auth()->guard('mobiles')->user()->mobile_number)
            ->whereNull('done')->get();
        $sms= fractal($sms, new SMSTransformer())->toArray()['data'];
        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'data' => $sms], 200);
    }
    public function CompleteCampaigns(Request $request)
    {
        if (empty(auth()->guard('mobiles')->user())){
            return response()->json(['code' => 422, 'status'=>false,"message"=>trans('api.not_auth')],422);
        }


        $sms = SmsMobile::where('user_id', auth()->guard('mobiles')->user()->user_id)
            ->where('mobile', auth()->guard('mobiles')->user()->mobile_number)
            ->where('done',1)->get();
        $sms= fractal($sms, new CompleteCampaigns())->toArray()['data'];
        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'data' => $sms], 200);
    }


    public function sendSms (Request $request)
    {
        if (empty(auth()->guard('mobiles')->user())){
            return response()->json(['code' => 422, 'status'=>false,"message"=>trans('api.not_auth')],422);
        }
        $sms = SmsMobile::where('id',$request->id)
            ->where('user_id', auth()->guard('mobiles')->user()->user_id)
            ->where('mobile', auth()->guard('mobiles')->user()->mobile_number)
            ->first();


        if($sms->done==1){

            return response()->json(['code' => 200, 'status'=>false,"message"=>trans('api.sms_send')],200);

        }

        $arr= json_decode($sms->send_list) ;
        $data= [
            'id'=>$sms->id,
            'group'=>Request()->header('Accept-language') == 'ar' ? $sms->smsData->region->name_ar ?? '-' : $sms->smsData->region->name_en ?? '-',
            'sms'=>$sms->smsData->sms ?? '-',
            'recipients'=>$arr,
            'created_at'=>$sms->created_at ?? '-',
        ];



        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'data' => $data], 200);
    }
    public function SingleGroup (Request $request)
    {
        if (empty(auth()->guard('mobiles')->user())){
            return response()->json(['code' => 422, 'status'=>false,"message"=>trans('api.not_auth')],422);
        }

        $sms = SmsMobile::where('id',$request->id)
            ->where('user_id', auth()->guard('mobiles')->user()->user_id)
            ->where('mobile', auth()->guard('mobiles')->user()->mobile_number)
            ->first();
        if($sms->done==1){

            return response()->json(['code' => 200, 'status'=>false,"message"=>trans('api.sms_send')],200);

        }

        $arr= json_decode($sms->send_list) ;
        $data= [
            'id'=>$sms->id,
            'group'=>Request()->header('Accept-language') == 'ar' ? $sms->smsData->region->name_ar ?? '-' : $sms->smsData->region->name_en ?? '-',
            'sms'=>$sms->smsData->sms ?? '-',
            'recipients'=>count($arr),
            'created_at'=>$sms->created_at ?? '-',
        ];
        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'data' => $data], 200);
    }
    public function SmsSentSuccessfully (Request $request)
    {
        if (empty(auth()->guard('mobiles')->user())){
            return response()->json(['code' => 422, 'status'=>false,"message"=>trans('api.not_auth')],422);
        }

        $sms = SmsMobile::where('id',$request->id)
            ->where('user_id', auth()->guard('mobiles')->user()->user_id)
            ->where('mobile', auth()->guard('mobiles')->user()->mobile_number)
            ->first();


        $sms->update([
            'done'=>1,
        ]);

        $arr= json_decode($sms->send_list) ;
        $data= [
            'id'=>$sms->id,
            'group'=>Request()->header('Accept-language') == 'ar' ? $sms->smsData->region->name_ar ?? '-' : $sms->smsData->region->name_en ?? '-',
            'sms'=>$sms->smsData->sms ?? '-',
            'recipients'=>count($arr),
            'created_at'=>$sms->created_at ?? '-',
        ];
        return response()->json(['code' => 200, 'message' => __('api.date_fetched_successfully'), 'data' => $data], 200);
    }






}
