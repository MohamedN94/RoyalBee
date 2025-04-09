<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Payment;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;


class PaymentController extends Controller
{

    /**
     * PaymentController constructor.
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the countries.
     */
    public function index(): View
    {
        $this->authorize('read_payment');

        return view('dashboard.payments.index');
    }

    public function show(DataTables $dataTables, Request $request)
    {
        $model = Payment::with('paymentAddress')->orderBy('created_at', 'desc');
        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Payment $payment) {
                return $payment->id ?? '-';
            })->editColumn('first_name', function (Payment $payment) {
                return $payment->paymentAddress?->first_name;
            // })->editColumn('last_name', function (Payment $payment) {
            //     return $payment->paymentAddress?->last_name;
            })->editColumn('email', function (Payment $payment) {
                return $payment->paymentAddress?->email;
            })->editColumn('phone', function (Payment $payment) {
                return $payment->paymentAddress?->phone;
            })->editColumn('country', function (Payment $payment) {
                return $payment->paymentAddress?->country;
            // })->editColumn('emirate', function (Payment $payment) {
            //     return $payment->paymentAddress?->emirate;
            // })->editColumn('street_address', function (Payment $payment) {
            //     return $payment->paymentAddress?->street_address;
            // })->editColumn('region', function (Payment $payment) {
            //     return $payment->paymentAddress?->region;
            })->addColumn('products', function (Payment $payment) {
                return \view('dashboard.payments.products',compact('payment'));
            })->editColumn('created_at', function (Payment $payment) {
                return $payment->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (Payment $payment) {
                return view('dashboard.payments.buttons', compact('payment'));
            })
            ->rawColumns(['action'])
            ->startsWithSearch()
            ->make(true);
            
            // ->editColumn('payment_status', function (Payment $payment) {
              //  return \view('dashboard.payments.payment_status',compact('payment'));
            //})->editColumn('payment_method', function (Payment $payment) {
               // return \view('dashboard.payments.payment_method',compact('payment'));
            //})
    }



    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment): View
    {
        $this->authorize('update_payment');
        return view('dashboard.payments.edit', [
            'payment' => $payment,
            'categories' => Category::select(['id', 'name_ar', 'name_en'])->get()
        ]);
    }

//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(PaymentRequest $request, Payment $payment): RedirectResponse
//    {
//
//        $payment->update(Arr::except($request->validated(), 'image'));
//        if ($request->hasFile('image')) {
//            $oldFile = $payment->image;
//            $file = $request->file('image');
//            if ($oldFile != null) unlink(public_path($oldFile));
//            MyHelper::updatePhoto($file, $payment, 'payments');
//        }
//        if ($request->has('photo')) {
//            foreach ($request->file('photo') as $image) {
//                MyHelper::updatePhotos($image, $payment, 'payments', 'photos');
//            }
//
//        }
//        return redirect()->route('dashboard.payments.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);
//    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $this->authorize('delete_payment');

        if (!$payment) {
            return response()->json(['status' => 'error', 'message' => __('dashboard.paymentNotFound')]);
        }
        
        // Delete all products associated with this payment
        $payment->paymentAddress->delete();
        $payment->products()->detach();


        $payment->delete();
        return response()->json(['status' => 'success', 'message' => __('dashboard.deletedSuccessfully')]);
    }

    public function details(Payment $payment) {
        $payment->load('paymentAddress');
        $product = $payment;
        return view('dashboard.payments.details', compact('product'));
    }


}
