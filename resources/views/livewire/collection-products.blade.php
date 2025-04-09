<div class="products-grid">
    @foreach($products as $product)
        <div class="product-item">
            <a class="product-thumbnail" href="{{route('web.product.show',$product->slug)}}">
                <img src="{{asset($product->image)}}"
                     alt="{{app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en}}">
            </a>
            <div class="product-details">
                <div class="product-info">
                    <h3 class="product-title">
                        <a href="{{route('web.product.show',$product->slug)}}">{{app()->getLocale() == 'ar' ? $product->name_ar :
                               $product->nme_en}}</a>
                    </h3>
                    <div class="product-price">
                        @if($product->discount_price != null)
                            <span class="currency-value before">
                                            <span class="value">{{$product->discount_price}}</span><span
                                    class="currency">&nbsp;{{__('AED')}}</span>
                                        </span>
                        @endif
                        <span class="currency-value after">
                                            <span class="value">{{$product->price}}</span><span class="currency">&nbsp;{{__('AED')}}</span>
                                        </span>
                    </div>
                </div>
                <div class="product-actions">
                    <form wire:submit.prevent="addToCart({{$product->id}})" method="post">
                        @csrf
                        <button type="submit" id="add-to-cart" class="button small-button secondary-button addToCart"
                                onclick="openSidebarWithToastar()" wire:loading.attr="disabled"
                                wire:target="addToCart({{ $product->id }})">
                            <span wire:loading.remove wire:target="addToCart({{ $product->id }})">{{__('Order now')}}</span>
                            <span wire:loading wire:target="addToCart({{ $product->id }})">
                                <span class="spinner-border spinner-border-lg" role="status" aria-hidden="true"></span>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
