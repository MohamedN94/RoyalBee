<div id="cart_side" class="add_to_cart right {{$showSide ? 'open-side' : ''}} ">
    <a href="javascript:void(0)" class="overlay" onclick="closeCart()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>{{__('my cart')}}</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeCart()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <div class="cart_media">
            <ul class="cart_product">
                @forelse($carts as $cart)
                    @php $product = \App\Models\Admin\Product::whereId($cart->id)->first(); @endphp
                    <li>
                        <div class="media">
                            <a href="#">
                                <img alt="megastore1" class="me-3"
                                     src="{{asset($product->image)}}">
                            </a>
                            <div class="media-body">
                                <a href="#">
                                    <h4>{{app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en}}</h4>
                                </a>
                                <h6>
                                    {{$product->discount_price !=null ? $product->discount_price : $product->price}}

                                </h6>
                                <div class="addit-box">
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <button class="counter"
                                                    wire:click="updateTotal('{{$cart->rowId}}', {{$cart->qty - 1}})">-
                                            </button>
                                            <span class="form-control">{{$cart->qty}}</span>
                                            <button class="counter"
                                                    wire:click="updateTotal('{{$cart->rowId}}', {{$cart->qty + 1}})">+
                                            </button>
                                        </div>
                                    </div>
                                    <div class="pro-add">
                                        <button type="button" style="border: none"
                                                wire:click="removeFromCart('{{$cart->rowId}}')"
                                                wire:confirm="{{__('Are you sure you want to delete?')}}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @empty
                    <span>{{__('Cart is empty')}}</span>
                @endforelse
            </ul>
            <ul class="cart_total">
                <li>
                    {{__('subtotal')}} : <span>{{Cart::subtotal()}} {{__('AED')}}</span>
                </li>
                <li>
                    {{__('Shipping')}} <span>{{__('free')}}</span>
                </li>
                <li>
                    {{__('taxes')}} <span>$0.00</span>
                </li>
                <li>
                    <div class="total">
                        {{__('total')}}<span>{{Cart::subtotal()}}</span>
                    </div>
                </li>
                <li>
                    <div class="buttons">
                        <a href="{{route('web.cart.index')}}" class="btn btn-solid btn-sm">{{__('view cart')}}</a>
                        <a href="{{route('web.checkout.index')}}" class="btn btn-solid btn-sm ">{{__('checkout')}}</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
