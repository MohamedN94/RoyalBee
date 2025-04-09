<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\OrderRequest;
use App\Models\Admin\Payment;
use App\Models\Admin\Product;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    use SEOToolsTrait;

    function index()
    {
        //        if (auth()->check() && auth()->user()->type == 'user') {
        $carts = Cart::content();
        if ($carts->count()) {
            return view('front.checkout', compact('carts'));
        } else {
            return redirect(route('web.cart.index'));
        }
        //        } else {
        //            return redirect(route('web.login.form'));
        //        }
    }

    public function checkoutProcess(CheckoutRequest $request)
    {

        $data = $request->validated();
        //        \DB::beginTransaction();
        //        try {
        if ($request->payment_method == 1) {
            $subtotal = str_replace(',', '', Cart::subtotal());

            // Check if the subtotal is less than 500
            if ($subtotal < 500) {
                $subtotal += 25; // Add 25 to the subtotal
            }

            $payment = Payment::create([
                'user_id' => auth()->check() ? auth()->user()->id : null,
                'payment_method' => 1,
                'amount' => $subtotal,
                'transaction_id' => \Str::uuid(),
            ]);
        }

        $products = [];
        $carts = Cart::content();
        foreach ($carts as $cart) {
            $products[$cart->id] = [
                'quantity' => $cart->qty,
                'amount' => $cart->price,
            ];
        }
        $payment->paymentAddress()->create($data);
        $payment->products()->attach($products);
        Cart::destroy();

        return response()->json([
            'success' => true,
            'url' => url(route('web.checkout.success', $payment->transaction_id))
        ]);
        //            \DB::commit();
        //        } catch (Exception $e) {
        //            \DB::rollBack();
        //            throw $e;
        //        }
    }

    public function checkoutSuccess($transactionId)
    {
        $payment = Payment::whereTransactionId($transactionId)->first();
        return view('front.order_success', compact('payment'));
    }

    /**
     * @throws Exception
     */
    public function placeOrder(OrderRequest $request, $productSlug)
    {

        $data = $request->validated();
        $product = Product::where('slug', $productSlug)->first();

        DB::beginTransaction();
        try {

            $subtotal = $request->quantity * $product->final_price;

            $shippingFee = $subtotal < 500 ? 25 : 0;

            $totalAmount = $subtotal + $shippingFee;

            $payment = Payment::create([
                'user_id' => auth()->check() ? auth()->user()->id : null,
                'payment_method' => 1,
                'type' => 2,
                'amount' => $totalAmount,
                'transaction_id' => \Str::uuid(),
            ]);

            $payment->paymentAddress()->create($data);
            $payment->products()->attach($product->id, [
                'quantity' => $request->quantity,
                'amount' => $product->final_price,
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return response()->json([
            'success' => true,
            'url' => url(route('web.checkout.success', $payment->transaction_id))
        ]);
    }
}
