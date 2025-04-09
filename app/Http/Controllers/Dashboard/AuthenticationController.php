<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Car;
use App\Models\Client;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Provider;
use App\Models\Store;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class AuthenticationController
 * @package App\Http\Controllers\Dashboard
 */
class AuthenticationController extends Controller
{
    /**
     * AuthenticationController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'show');
        $this->middleware('auth')->only('logout', 'show');
    }

    /**
     * Handel The Request For Return Home Page
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.login');
    }

    /**
     * @param $str
     * @return View
     */
    public function show(): View
    {
//        $users_count = Client::count();

//        $active_users_count = Client::where('status', 'active')->count();

//        $active_drivers_count = Provider::where('type', 'driver')->where('status', 'available')->count();

//        $drivers_count = Driver::count();
//
//        $cars_count = Car::count();
//
//        $vehicle_count = Vehicle::count();
//
//        $trips_count = Order::count();
//
//        $orders_count = Order::count();
//
//        $restaurants_count = Store::where('store_type', 'restaurant')->count();
//
//        $pharmacies_count = Store::where('store_type', 'pharmacy')->count();
//
//        $super_market_count = Store::where('store_type','!=', 'restaurant')->count();
//
//        $electronic_count = Store::where('store_type', 'electronic_store')->count();
//
//        $clients = Client::orderBy('id', 'desc')->get()->take(5);
//
//        $low_clients = Client::orderBy('id', 'desc')->get()->take(5);
//
//        $best_stores = Store::orderBy('id', 'desc')->get()->take(5);
//
//        $best_clients = Client::orderBy('id', 'desc')->get()->take(5);
//
//        $low_rated_store = Store::orderBy('id', 'desc')->get()->take(5);
//
//        $drivers = Provider::where('type', 'driver')->orderBy('id', 'desc')->get()->take(5);

        return view('dashboard.index');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->only(['email', 'password'], ['type' => 'admin']))) {
            return redirect()->intended(route('dashboard.index'));
        }

        return redirect()->back()->withErrors(['credentials' => 'Invalid email or password!']);
    }


    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('dashboard.auth.index');
    }
}
