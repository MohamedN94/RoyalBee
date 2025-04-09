<div class="row">
    <div class="col-12 product">
        <div class="product-slide-6 product-m no-arrow" wire:ignore>
            @foreach($relatedProducts as $relatedProduct)
                <div>
                    <div class="product-box">
                        <div class="product-imgbox">
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
                                $store.wishlistStore.updateWishlist({{ $relatedProduct->id }}, {{ json_encode($isInWishlist[$relatedProduct->id]) }});
                         " class="product-front">
                                <a href="{{route('web.product.show',$relatedProduct->slug)}}">
                                    <img src="{{asset($relatedProduct->image)}}" class="img-fluid"
                                         alt="product">
                                </a>
                            </div>
                            <div class="product-back">
                                <a href="{{route('web.product.show',$relatedProduct->slug)}}">
                                    <img src="{{ asset($relatedProduct->photos()->first()?->photo) }}"
                                         class="img-fluid"
                                         alt="product">
                                </a>
                            </div>
                            <div class="product-icon icon-inline">
                                <form wire:submit.prevent="addToCart({{ $relatedProduct->id }})" method="post">
                                    @csrf
                                    <button wire:target="addToCart({{ $relatedProduct->id }})"
                                            onclick="openCartToastar()"
                                            ata-bs-toggle="modal" data-bs-target="#addtocart" class="tooltip-top"
                                            data-tippy-content="{{__('Add to cart')}}">
                                        <i data-feather="shopping-cart"></i>
                                    </button>
                                </form>
                                <form wire:submit.prevent="addToWishlist({{ $relatedProduct->id }})" method="post">
                                    @csrf
                                    <button @click.prevent="
                                        if (typeof $wire !== 'undefined' && Alpine.store('wishlistStore') && $store.wishlistStore.isInWishlist({{ $relatedProduct->id }})) {
                                            $wire.removeFromWishlist({{ $relatedProduct->id }}).then(() => {
                                                $store.wishlistStore.updateWishlist({{ $relatedProduct->id }}, false);
                                                toastr.success('Removed from Wishlist!');
                                            });
                                        } else if (typeof $wire !== 'undefined' && Alpine.store('wishlistStore')) {
                                            $wire.addToWishlist({{ $relatedProduct->id }}).then(() => {
                                                $store.wishlistStore.updateWishlist({{ $relatedProduct->id }}, true);
                                                toastr.success('Added to Wishlist!');
                                            });
                                        } else {
                                            console.error('wishlistStore or $wire is not defined');
                                        }
                                    ">
                                        <i :class="$store.wishlistStore.isInWishlist({{ $relatedProduct->id }}) ? 'fa fa-heart text-danger' : 'fa fa-heart text-muted'"></i>
                                    </button>
                                </form>
                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                   data-bs-target="#quick-view"
                                   onclick="showProduct(this, {{ $relatedProduct->id }})" class="tooltip-left"
                                   data-tippy-content="{{__('Quick View')}}">
                                    <i data-feather="eye"></i>
                                </a>
                            </div>

                        </div>
                        <div class="product-detail detail-inline ">
                            <div class="detail-title">
                                <div class="detail-left">
                                    <div class="rating-star">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <li>
                                                @if ($relatedProduct->review >= $i)
                                                    <i class="fa fa-star" style="color: #FFD700;"></i>
                                                @elseif ($relatedProduct->review >= $i - 0.5)
                                                    <i class="fa fa-star-half-alt"
                                                       style="color: #FFD700;"></i>
                                                @else
                                                    <i class="fa fa-star" style="color: #e4e5e9;"></i>
                                                @endif
                                            </li>
                                        @endfor
                                    </div>
                                    <a href="{{route('web.product.show',$relatedProduct->slug)}}">
                                        <h6 class="price-title">
                                            {{app()->getLocale() == 'ar' ? $relatedProduct->name_ar : $relatedProduct->name_en}}
                                        </h6>
                                    </a>
                                </div>
                                <div class="detail-right">
                                    <div class="check-price">
                                        @if($relatedProduct->discount_price)
                                            {{$relatedProduct->price}}
                                        @endif
                                    </div>
                                    <div class="price">
                                        <div class="price">
                                            @if($relatedProduct->discount_price)
                                                {{$relatedProduct->discount_price}}
                                            @else
                                                {{$relatedProduct->price}}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
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
