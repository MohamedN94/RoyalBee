<div>
    <div class="single-product">
        <div class="container-xxl">
            <div class="product-wrapper">
                <div class="product-preview">
                    <div class="product-section preview-wrapper">
                        <!-- Desktop Product Slider -->
                        <div wire:ignore class="product-slider product-slider-desktop">
                            <div class="preview">
                                <ul class="list-unstyled preview-slider preview-slider-desktop">
                                    @foreach($product->photos as $photo)
                                        <li class="preview-item">
                                            <img src="{{ asset($photo->photo) }}" alt="{{ app()->getLocale() == 'ar' ? $product->name_ar :
                                                        $product->name_en}}">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Thumbnails -->
                            <ul class="list-unstyled thumbnails">
                                @foreach($product->photos as $photo)
                                    <li class="thumbnail-item">
                                        <div class="thumbnail-preview">
                                            <img src="{{ asset($photo->photo) }}" alt="{{ app()->getLocale() == 'ar' ? $product->name_ar :
                                                        $product->name_en}}">
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="product-details">
                    <div class="product-section">
                        <h1 class="single-title">{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}</h1>
                    </div>
                    <div class="product-section preview-wrapper">
                        <!-- Mobile Product Slider -->
                        <div wire:ignore class="product-slider product-slider-mobile">
                            <div class="preview">
                                <ul class="list-unstyled preview-slider preview-slider-mobile">
                                    @foreach($product->photos as $photo)
                                        <li class="preview-item">
                                            <img src="{{ asset($photo->photo) }}" alt="Product Image">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Thumbnails -->
                            <ul class="list-unstyled thumbnails">
                                @foreach($product->photos as $photo)
                                    <li class="thumbnail-item">
                                        <div class="thumbnail-preview">
                                            <img src="{{ asset($photo->photo) }}" alt="Thumbnail">
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="product-section price-section">
                        <h3 class="single-price">
                            @if($product->discount_price != null)
                                <span class="before currency-value">
                                    <span class="value">{{ $product->discount_price }}</span>
                                    <span class="currency">&nbsp;{{__('AED')}}</span>
                                </span>
                            @endif
                            <span class="after currency-value">
                                <span class="value">{{ $product->price }}</span>
                                <span class="currency">&nbsp;{{__('AED')}}</span>
                            </span>
                        </h3>
                    </div>
                    <div id="express-checkout-section" class="product-section checkout-section">
                        <div class="checkout">
                            <div class="main">
                                <div class="checkout-form">
                                    <div class="checkout-groups">
                                        <h2 class="checkout-heading">{!! app()->getLocale() == 'ar' ? $product->description_ar :
                                                         $product->description_en!!}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-section add-to-cart-section">
                        <div class="counter-container" style="padding-left: 1%;">
                            @php
                                $cartItem = Cart::content()->where('id', $product->id)->first();
                            @endphp

                            @if($cartItem)
                                <button wire:click="updateTotal('{{ $product->id }}', {{ $cartItem->qty - 1 }})"
                                        onclick="showToastr()"
                                        style="padding: 6px 12px 9px 14px;background: #f0f0f0; font-size: 22px;"
                                        class="counter-btn" id="decrement-btn">-
                                </button>
                                <span style="padding: 0 1rem; font-weight: bold;"
                                      id="product-count">{{ $cartItem->qty }}</span>
                                <button wire:click="updateTotal('{{ $product->id }}', {{ $cartItem->qty + 1 }})"
                                        onclick="showToastr()"
                                        style="padding: 6px 12px 9px 14px;background: #f0f0f0; font-size: 22px;"
                                        class="counter-btn" id="increment-btn">+
                                </button>
                            @else
                                <button wire:click="addToCart" onclick="showToastr()"
                                        style="color: #000000; background: #fec76f;"
                                        class="button small-button secondary-button">
                                    {{__('Click here to order')}}
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
