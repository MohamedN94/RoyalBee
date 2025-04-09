@extends('front.layouts.app')
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-main ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-contain">
                        <div>
                            <h2>{{__('Checkout')}}</h2>
                            <ul>
                                <li><a href="{{ route('web.home') }}">{{__('Home')}}</a></li>
                                <li><i class="fa fa-angle-double-right"></i></li>
                                <li><a href="javascript:void(0)">{{__('Checkout')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->

    <!-- section start -->
    <section class="section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="checkout-page contact-page">
                <div class="checkout-form">
                    <form action="{{ route('web.checkout.process') }}" method="POST" id="addForm">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-title">
                                    <h3>{{ __('dashboard.billing_details') }}</h3>
                                </div>
                                <div class="theme-form">
                                    <div class="row check-out ">

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>{{ __('First Name') }}</label>
                                            <input type="text" name="first_name" placeholder="{{ __('First Name') }}"
                                                value="{{ old('first_name', auth()->check() ? auth()->user()->first_name : '') }}">
                                            <label id="checkout_first_name" class="error_sms" style="display: none"></label>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>{{ __('Last Name') }}</label>
                                            <input type="text" name="last_name" placeholder="{{ __('Last Name') }}"
                                                value="{{ old('last_name', auth()->check() ? auth()->user()->last_name : '') }}">
                                            <label id="checkout_last_name" class="error_sms" style="display: none"></label>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="field-label">{{ __('Phone Number') }}</label>
                                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="{{ __('Phone Number') }}">
                                            <label id="checkout_phone" class="error_sms" style="display: none"></label>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="field-label">{{ __('Email') }}</label>
                                            <input type="text" name="email"
                                                value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}"
                                                placeholder="{{ __('Email') }}">
                                            <label id="checkout_email" class="error_sms" style="display: none"></label>
                                        </div>
                                         <div class="form-group col-md-12 col-sm-12 col-xs-12"> 
                                        {{--  <label class="field-label">Country</label> --}}
                                        {{--  <select> --}}
                                        {{--  <option>India</option> --}}
                                        {{--  <option>South Africa</option> --}}
                                        {{--  <option>United State</option> --}}
                                        {{--  <option>Australia</option> --}}
                                        {{--  </select> --}}
                                        {{--  </div> --}}


                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label class="field-label">{{ __('dashboard.Country') }}</label>
                                            <br><br>
                                            <input type="text" name="country" value="{{ old('country') }}"
                                                placeholder="{{ __('dashboard.Country') }}">
                                            <label id="checkout_country" class="error_sms"
                                                style="display: none"></label>
                                        </div>

                                        <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                            <label class="field-label">{{ __('dashboard.emirate') }}</label>
                                            <br><br>
                                            <input type="text" name="emirate" value="{{ old('emirate') }}"
                                                placeholder="{{ __('dashboard.emirate') }}">
                                            <label id="checkout_emirate" class="error_sms" style="display: none"></label>
                                        </div>

                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label class="field-label">{{ __('Street Address') }}</label>
                                            <br><br>
                                            <input type="text" name="street_address" value="{{ old('street_address') }}"
                                                placeholder="{{ __('Street Address') }}">
                                            <label id="checkout_street_address" class="error_sms"
                                                style="display: none"></label>
                                        </div>

                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label class="field-label">{{ __('dashboard.region') }}</label>
                                            <br><br>
                                            <input type="text" name="region" value="{{ old('region') }}"
                                                placeholder="{{ __('dashboard.region') }}">
                                            <label id="checkout_region" class="error_sms" style="display: none"></label>
                                        </div>

                                        {{-- <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                            <label class="field-label">Postal Code</label>
                                            <input type="text" name="postal_code" value="{{ old('postal_code') }}"
                                                placeholder="Enter postal code">
                                            <label id="checkout_postal_code" class="error_sms" style="display: none"></label>
                                        </div> --}}
                                        {{--                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> --}}
                                        {{--                                                <input type="checkbox" name="shipping-option" id="account-option"> --}}
                                        {{--                                                &ensp; --}}
                                        {{--                                                <label for="account-option">Create An Account?</label> --}}
                                        {{--                                            </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12">
                            <div class="checkout-details theme-form  section-big-mt-space">
                                <div class="order-box">
                                    <div class="title-box">
                                        <div>{{ __('dashboard.product') }} <span>{{ __('dashboard.total') }}</span></div>
                                    </div>
                                    <ul class="qty">
                                        @php
                                            $content_ids = [];
                                            $content_names = [];
                                            $values = [];
                                            $quantities = [];
                                        @endphp

                                        @foreach ($carts as $cart)
                                            @php
                                                $record = \App\Models\Admin\Product::whereId($cart->id)->first();
                                                $content_ids[] = $record->id; // Add product ID to array
                                                $content_names[] = $record->name_en; // Add product name to array
                                                $values[] = $cart->price * $cart->qty; // Total value for each product
                                                $quantities[] = $cart->qty; // Add quantity to array
                                            @endphp
                                            <li>{{ $record->name_en }} × {{ $cart->qty }}
                                                <span>{{ $cart->price }}</span>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <script>
                                        fbq('track', 'InitiateCheckout', {
                                            content_ids: @json($content_ids), // Pass all product IDs
                                            content_names: @json($content_names), // Pass all product names
                                            content_type: 'product',
                                            value: {{ array_sum($values) }}, // Total value for all items
                                            currency: 'AED',
                                            num_items: {{ array_sum($quantities) }} // Total quantity of all items
                                        });
                                        ttq.track('InitiateCheckout', {
                                            value: {{ array_sum($values) }},
                                            currency: 'AED'
                                        });
                                    </script>
@php
$subtotal = str_replace(',', '', \Gloudemans\Shoppingcart\Facades\Cart::subtotal());
$delivery = ($subtotal < 500) ? 25 : 0; // Delivery fee if subtotal is less than 500
$total = $subtotal + $delivery; // Total includes subtotal and delivery fee
@endphp
                            
<ul class="sub-total">
    <li>{{ __('dashboard.subtotal') }} 
        <span class="count">{{ number_format($subtotal, 2) . ' ' }} درهم</span>
    </li>
</ul>
<ul class="sub-total">
    <li>{{ __('shipping') }} 
        <span class="count">{{ number_format($delivery, 2) . ' ' }} درهم</span>
    </li>
</ul>
<ul class="total">
    <li>{{ __('dashboard.total') }} 
        <span class="count">{{ number_format($total, 2) . ' ' }} درهم</span>
    </li>
</ul>
                            </div>
                                <div class="payment-box">
                                    <div class="upper-box">
                                        <div class="payment-options">
                                            <ul>
                                                {{--                                                    <li> --}}
                                                {{--                                                        <div class="radio-option"> --}}
                                                {{--                                                            <input type="radio" name="payment-group" id="payment-1" --}}
                                                {{--                                                                   checked="checked"> --}}
                                                {{--                                                            <label for="payment-1">Check Payments<span --}}
                                                {{--                                                                    class="small-text">Please send a check to Store --}}
                                                {{--                                  Name, Store Street, Store Town, Store State / County, Store Postcode.</span></label> --}}
                                                {{--                                                        </div> --}}
                                                {{--                                                    </li> --}}
                                                <li>
                                                    <div class="radio-option">
                                                        <input type="radio" name="payment_method" value="1"
                                                            id="payment-2" checked="checked">
                                                        <label for="payment-2">{{ __('dashboard.cash_on_delivery') }}<span
                                                                class="small-text">Please send a check to
                                                                Store Name, Store Street, Store Town, Store State /
                                                                County, Store
                                                                Postcode.</span></label>
                                                    </div>
                                                </li>
                                                {{--                                                    <li> --}}
                                                {{--                                                        <div class="radio-option paypal"> --}}
                                                {{--                                                            <input type="radio" name="payment-group" id="payment-3"> --}}
                                                {{--                                                            <label for="payment-3">PayPal</label> --}}
                                                {{--                                                        </div> --}}
                                                {{--                                                    </li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <buttone type="submit" id="checkout_button" class="btn-normal btn">{{ __('dashboard.place_order') }}
                                        </buttone>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
        </div>
    </section>
    <!-- section end -->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            var inputs = [
                'first_name',
                'last_name',
                'phone',
                'email',
                'region',
                'emirate',
                'street_address',
                'country',
                'payment_method',
            ];


            $('#checkout_button').click(function(e) {

                e.preventDefault();
                var url = $('#addForm').attr('action');
                var form_data = $('#addForm').get(0);

                $('.error_sms').hide();

                $('#checkout_button').attr('disabled', 'disabled');
                $('#checkout_button').text('').append(
                    '<span class="spinner-border spinner-border-lg" role="status" aria-hidden="true"></span>'
                );

                for (var i = 0; i < inputs.length; i++) {
                    $('.input_' + inputs[i] + '').css('border', '');
                }

                $.ajax({
                    url: url,
                    type: 'post',
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: new FormData(form_data),
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $("#sucsess-modal").modal("show");
                        var url = data.url;
                        if (url) {
                            setTimeout(function() {
                                window.location = url;
                            }, 3000); // 3000 milliseconds = 8 seconds
                        }
                    },
                    error: function(data) {
                        var error = data.responseJSON.errors;
                        $('#checkout_button').removeAttr('disabled');
                        $('#checkout_button').text('').append('{{ __('Place order') }}');

                        for (var i = 0; i < inputs.length; i++) {
                            if (error.hasOwnProperty(inputs[i])) {
                                $('#checkout_' + inputs[i] + '').text('').append(
                                    '<i class="error_fontawai fa fa-exclamation-circle" style="float:right;padding: 5px"></i>' +
                                    error[inputs[i]] + '');
                                $('#checkout_' + inputs[i] + '').show();
                                $('.input_' + inputs[i] + '').css('border', '1px solid red')
                                    .css('margin-bottom', 0);

                            }
                        }
                    }
                });
            });
        });
    </script>
@endpush
