<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Admin\Page;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;
use App\Models\Site\Seo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class AuthController extends Controller
{

    public function loginForm()
    {
        return view('front.login');
    }

    public function signUpForm()
    {
        return view('front.signup');
    }

    public function Login(LoginRequest $request)
    {
        $data = $request->only('email', 'password');

        if (\auth()->guard('web')->attempt(['email' => $data['email'], 'password' => $data['password'],'type' => 'user'])) {
            session()->flash('success', __('مرحبا بك ,, تم تسجيل دخولك بنجاح'));

            $intendedUrl = session()->pull('url.intended', url('/'));
            //dd($intendedUrl);

            return response()->json([
                'success' => true,
                'url' => $intendedUrl
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => __('The provided credentials do not match our records.'),
                'code' => 400
            ], 400);
        }

    }





    
    public function signup(RegisterRequest $request)
    {

        $user = User::create($request->validated());
        $user->name = $user->first_name . ' ' . $user->last_name;
        $user->type = 'user';
        $user->save();
        \auth('web')->loginUsingId($user->id);
        $intendedUrl = session()->pull('url.intended', url('/'));
        session()->flash('registered_successfully', __('Your account has been registered successfully'));
        return response()->json([
            'success' => true,
            'url' => $intendedUrl
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('web.home'));
    }

}
