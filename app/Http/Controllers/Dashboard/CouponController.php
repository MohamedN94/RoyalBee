<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

class CouponController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the countries.
     */
    public function index(): View
    {
        $this->authorize('read_page');

        return view('dashboard.coupons.index');
    }

    public function show(DataTables $dataTables, Request $request)
    {
        $model = Coupon::orderBy('created_at', 'desc');
        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Coupon $Coupon) {
                return $Coupon->id ?? '-';
            })->editColumn('code', function (Coupon $Coupon) {
                return $Coupon->code ;
            })->editColumn('discount', function (Coupon $Coupon) {
                return $Coupon->discount ;
            })->editColumn('type', function (Coupon $Coupon) {
                return $Coupon->type ;
            })->editColumn('expiry_date', function (Coupon $Coupon) {
                return $Coupon->expiry_date ;
            })->editColumn('created_at', function (Coupon $Coupon) {
                return $Coupon->created_at->format('d-m-Y h:i A') ?? '-';
            })
            ->addColumn('action', function (Coupon $Coupon) {
                return view('dashboard.coupons.buttons', compact('Coupon'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Display a listing of the resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'discount' => 'required|numeric',
            'type' => 'required|in:fixed,percentage',
            'expiry_date' => 'nullable|date',
        ]);

        Coupon::create($request->all());

        return redirect()->route('dashboard.coupons.index')->with(['status' => 'success', 'message' => __('dashboard.addedSuccessfully')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create_page');

        return view('dashboard.coupons.create');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon): View
    {
        $this->authorize('update_page');
        return view('dashboard.coupons.edit', [
            'Coupon' => $coupon,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon): RedirectResponse
    {

        $request->validate([
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'discount' => 'required|numeric',
            'type' => 'required|in:fixed,percentage',
            'expiry_date' => 'nullable|date',
        ]);

        $coupon = Coupon::findOrFail($coupon->id);
        $coupon->update($request->all());


        return redirect()->route('dashboard.coupons.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $this->authorize('delete_page');
        if (!$coupon) {
            return response()->json(['status' => 'error', 'message' => __('dashboard.productNotFound')]);
        }
        $coupon->delete();
        return response()->json(['status' => 'success', 'message' => __('dashboard.deletedSuccessfully')]);
    }

}
