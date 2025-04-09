<div>
    <section class="ratio_asos product section-big-pb-space">
        <div class="custom-container addtocart_count">
            <div class="row">
                <div class="col pr-0">
                    <div class="product-slide-6 no-arrow" wire:ignore>
                        @foreach ($products as $product)
                            <div x-data x-init="
                                if (!Alpine.store('wishlistStore')) {
                                    console.log('wishlistStore is not defined, initializing now.');
                                    Alpine.store('wishlistStore', {
                                        products: {},
                                        updateWishlist(productId, status) {
                                            this.products[productId] = status;
                                        },
                                        isInWishlist(productId) {
                                            return this.products[productId] || false;
                                        }
                                    });
                                }
                                $store.wishlistStore.updateWishlist({{ $product->id }}, {{ json_encode($isInWishlist[$product->id]) }});
                            " class="product-box">
                                <div class="product-imgbox">
                                    <div class="product-front">
                                        <a href="{{route('web.product.show',$product->slug)}}">
                                            <img src="{{ asset($product->image) }}" class="img-fluid" alt="product">
                                        </a>
                                    </div>

                                    <div class="product-back">
@if($product->photos()->first() && $product->photos()->first()->photo != null)
    <a href="{{ route('web.product.show', $product->slug) }}">
        <img src="{{ asset($product->photos()->first()->photo) }}" class="img-fluid" alt="product">
    </a>
@else
    <a href="{{ route('web.product.show', $product->slug) }}">
        <img src="{{ asset($product->image) }}" class="img-fluid" alt="product">
    </a>
@endif
                                    </div>
                                    <div class="product-icon">
                                            <form wire:submit.prevent="addToWishlist({{ $product->id }})" method="post">
                                                @csrf
                                                <button @click.prevent="
                                        if (typeof $wire !== 'undefined' && Alpine.store('wishlistStore') && $store.wishlistStore.isInWishlist({{ $product->id }})) {
                                            $wire.removeFromWishlist({{ $product->id }}).then(() => {
                                                $store.wishlistStore.updateWishlist({{ $product->id }}, false);
                                                toastr.success('Removed from Wishlist!');
                                            });
                                        } else if (typeof $wire !== 'undefined' && Alpine.store('wishlistStore')) {
                                            $wire.addToWishlist({{ $product->id }}).then(() => {
                                                $store.wishlistStore.updateWishlist({{ $product->id }}, true);
                                                toastr.success('Added to Wishlist!');
                                            });
                                        } else {
                                            console.error('wishlistStore or $wire is not defined');
                                        }
                                        ">
                                                    <i :class="$store.wishlistStore.isInWishlist({{ $product->id }}) ? 'fa fa-heart text-danger' : 'fa fa-heart text-muted'"></i>
                                                </button>
                                            </form>


                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                           data-bs-target="#quick-view"
                                           onclick="showProduct(this, {{ $product->id }})" class="tooltip-left"
                                           data-tippy-content="Quick View">
                                            <i data-feather="eye"></i>
                                        </a>
                                    </div>
                                    @if ($product->discount_price != null)
                                        <div class="on-sale4">
                                          {{__('on sale')}}
                                        </div>
                                        <div class="new-label1">
                                            {{ round(100 - ($product->discount_price / $product->price) * 100, 1) }}%
                                        </div>
                                    @endif
                                </div>
                                <div class="product-detail detail-center1">
                                    <ul class="rating-star">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <li>
                                                @if ($product->review >= $i)
                                                    <i class="fa fa-star" style="color: #FFD700;"></i>
                                                @elseif ($product->review >= $i - 0.5)
                                                    <i class="fa fa-star-half-alt" style="color: #FFD700;"></i>
                                                @else
                                                    <i class="fa fa-star" style="color: #e4e5e9;"></i>
                                                @endif
                                            </li>
                                        @endfor
                                    </ul>

                                    <a href="{{route('web.product.show',$product->slug)}}">
                                        <h6>{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}</h6>
                                    </a>
                                    <span class="detail-price">
                                        @if ($product->discount_price)
                                                                    <span class="discount" style="text-decoration: line-through;">
                                                {{ $product->price }}
                                            </span>
                                            <span class="text-center">{{ $product->discount_price }}</span>
                                        @else
                                            <span class="text-center">{{ $product->price }}</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="addtocart_btn">
                                    <form wire:submit.prevent="addToCart({{ $product->id }})" method="post">
                                        @csrf
                                        <button class="add-button add_cart tooltip-top"
                                                data-tippy-content="{{__('Add to cart')}}" onclick="openCartToastar()"
                                                wire:loading.attr="disabled"
                                                wire:target="addToCart({{ $product->id }})">
                                            <span wire:loading.remove
                                                  wire:target="addToCart({{ $product->id }})">{{__('Add to cart')}}</span>
                                                                    <span wire:loading wire:target="addToCart({{ $product->id }})">
                                                <span class="spinner-border spinner-border-lg" role="status"
                                                      aria-hidden="true"></span>
                                            </span>
                                        </button>
                                    </form>
                                    <div class="qty-box cart_qty">
                                        <div class="input-group">
                                            <button type="button" class="btn quantity-left-minus" data-type="minus"
                                                    onclick="openCart()" data-field="">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                            <input type="text" name="quantity"
                                                   class="form-control input-number qty-input" disabled value="1">
                                            <button type="button" class="btn quantity-right-plus" data-type="plus"
                                                    onclick="openCart()" data-field="">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="//unpkg.com/alpinejs"></script>
{{--<script>--}}
{{--    document.addEventListener('alpine:init', () => {--}}
{{--        Alpine.store('wishlistStore', {--}}
{{--            products: {},--}}

{{--            updateWishlist(productId, status) {--}}
{{--                this.products[productId] = status;--}}
{{--            },--}}

{{--            isInWishlist(productId) {--}}
{{--                return this.products[productId] || false;--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('wishlist_updated', productId => {
            if (Alpine.store('wishlistStore')) {
                Alpine.store('wishlistStore').updateWishlist(productId, false);
            } else {
                console.error('wishlistStore is not defined');
                // Optionally initialize here if needed
                Alpine.store('wishlistStore', {
                    products: {},
                    updateWishlist(productId, status) {
                        this.products[productId] = status;
                    },
                    isInWishlist(productId) {
                        return this.products[productId] || false;
                    }
                });
                Alpine.store('wishlistStore').updateWishlist(productId, false);
            }
        });
    });
</script>
