@extends('front.layouts.app')
@section('content')
    <!-- thank-you section start -->
    <section class="section-big-py-space light-layout">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="success-text"><i class="fa fa-check-circle" aria-hidden="true"></i>
                        <h2>thank you</h2>
                        <p>Payment is successfully processsed and your order is on the way</p>
                        <p>Transaction ID:{{$payment->transaction_id}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->


    <!-- order-detail section start -->
    <section class="section-big-py-space mt--5 b-g-light">
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-order">
                        <h3>Your Order Details</h3>
                        @foreach($payment->products as $product)
                            <div class="row product-order-detail">
                                <div class="col-3">
                                    <img src="{{ asset($product->image) }}" alt="product-image" class="img-fluid">
                                </div>
                                <div class="col-3 order_detail">
                                    <div>
                                        <h4>Product Name</h4>
                                        <h5>{{ $product->name_en }}</h5>
                                    </div>
                                </div>
                                <div class="col-3 order_detail">
                                    <div>
                                        <h4>Quantity</h4>
                                        <h5>{{ $product->pivot->quantity }}</h5>
                                    </div>
                                </div>
                                <div class="col-3 order_detail">
                                    <div>
                                        <h4>Price</h4>
                                        <h5>{{ $product->pivot->amount }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                
                        @php
                            $subtotal = $payment->amount; // Subtotal from the payment object
                            $shippingFee = $subtotal < 500 ? 25 : 0; // Apply 25 AED shipping if subtotal < 500
                            $finalTotal = $subtotal + $shippingFee; // Final total including shipping
                        @endphp
                
                        <div class="total-sec">
                            <ul>
                                <li>Subtotal <span>{{ number_format($subtotal, 2) }} AED</span></li>
                                @if($shippingFee > 0)
                                    <li>Shipping <span>{{ number_format($shippingFee, 2) }} AED</span></li>
                                @endif
                            </ul>
                        </div>
                
                        <div class="final-total">
                            <h3>Total <span>{{ number_format($finalTotal, 2) }} AED</span></h3>
                        </div>
                    </div>
                </div>
                                <div class="col-lg-6">
                    <div class="row order-success-sec">
                        <div class="col-sm-6">
                            <h4>summery</h4>
                            <ul class="order-detail">
                                <li>order ID: {{$payment->id}}</li>
                                <li>Order Date: {{\Carbon\Carbon::parse($payment->created_at)->format('F j, Y')}}</li>
                                <li>Order Total: {{$payment->amount}}</li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <h4>shipping address</h4>
                            <ul class="order-detail">
                                <li>{{$payment->paymentAddress?->first_name . ' ' .$payment->paymentAddress?->last_name }}</li>
                                <li>{{$payment->paymentAddress?->street_address}}</li>
                                <li>{{$payment->paymentAddress?->country . ' ' .$payment->paymentAddress?->city }}</li>
                                <li>Contact No. {{$payment->paymentAddress?->phone}}</li>
                            </ul>
                        </div>
                        <div class="col-sm-12 payment-mode">
                            <h4>payment method</h4>
                            <p>
                                @if($payment->payment_method == 1)
                                    Cache on delivery
                                @endif
                            </p>
                        </div>
                        <!--<div class="col-md-12">-->
                        <!--    <div class="delivery-sec">-->
                        <!--        <h3>expected date of delivery</h3>-->
                        <!--        <h2>october 22, 2024</h2></div>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->
<!-- Facebook Pixel Base Code -->
<script>
    fbq('track', 'Purchase', {
    value: '{{$payment->amount}}',        // Replace with the value of the purchase
    currency: 'AED'      // Replace with the currency (e.g., USD, EUR)
    });
    ttq.track('CompletePayment', {
        order_id: '{{$payment->id}}', // Unique order ID
        value: '{{$payment->amount}}',
        currency: 'AED'
    });

</script>

@endsection
