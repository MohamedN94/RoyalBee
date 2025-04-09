<div>
    @if ($products)
        <section class="ratio_asos product section-big-pb-space">
            <div class="custom-container addtocart_count">
                <div class="row">
                    <div class="col pr-0">
                        <div class="product-slide-6 no-arrow" wire:ignore>
                            @forelse ($products as $product)
                                <div x-data x-init="if (!Alpine.store('wishlistStore')) {
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
                                $store.wishlistStore.updateWishlist({{ $product->id }}, {{ json_encode($isInWishlist[$product->id]) }});" class="product-box">
                                    <div class="product-imgbox">
                                        <div class="product-front">
                                            <a href="{{ route('web.product.show', $product->slug) }}">
                                                <img src="{{ asset($product->image) }}" class="img-fluid"
                                                    alt="product">
                                            </a>
                                        </div>

                                        <div class="product-back">
                                            @if ($product->photos()->first() && $product->photos()->first()->photo != null)
                                                <a href="{{ route('web.product.show', $product->slug) }}">
                                                    <img src="{{ asset($product->photos()->first()->photo) }}"
                                                        class="img-fluid" alt="product">
                                                </a>
                                            @else
                                                <a href="{{ route('web.product.show', $product->slug) }}">
                                                    <img src="{{ asset($product->image) }}" class="img-fluid"
                                                        alt="product">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="product-icon">
                                            <!-- For Authenticated Users -->
                                            <form wire:submit.prevent="addToWishlist({{ $product->id }})"
                                                method="post">
                                                @csrf
                                                <button
                                                    @click.prevent="
                                                    if ($store.wishlistStore.isInWishlist({{ $product->id }})) {
                                                        $wire.addToWishlist({{ $product->id }}).then(() => {
                                                            $store.wishlistStore.updateWishlist({{ $product->id }}, false);
                                                            toastr.success('Removed from Wishlist!');
                                                        });
                                                    } else {
                                                        $wire.addToWishlist({{ $product->id }}).then(() => {
                                                            $store.wishlistStore.updateWishlist({{ $product->id }}, true);
                                                            toastr.success('Added to Wishlist!');
                                                        });
                                                    }
                                                ">
                                                    <i
                                                        :class="$store.wishlistStore.isInWishlist({{ $product->id }}) ?
                                                            'fa fa-heart text-danger' : 'fa fa-heart text-muted'"></i>
                                                </button>
                                            </form>

                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view"
                                                onclick="showProduct(this, {{ $product->id }})" class="tooltip-left"
                                                data-tippy-content="Quick View">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </div>

                                        @if ($product->discount_price)
                                            <div class="on-sale4">{{ __('on sale') }}</div>
                                            <div class="new-label1">
                                                {{ round(100 - ($product->discount_price / $product->price) * 100, 1) }}%
                                            </div>
                                        @endif
                                    </div>

                                    <div class="product-detail detail-center1">
                                        <a href="{{ route('web.product.show', $product->slug) }}">
                                            <h6>{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}
                                            </h6>
                                        </a>
                                        <span class="detail-price">
                                            @if ($product->discount_price)
                                                <span class="discount" style="text-decoration: line-through;">
                                                    {{ $product->price }}
                                                </span>
                                                <span>{{ $product->discount_price }}</span>
                                            @else
                                                <span>{{ $product->price }}</span>
                                            @endif
                                        </span>
                                    </div>

                                    <div class="addtocart_btn">
                                        <form wire:submit.prevent="addToCart({{ $product->id }})" method="post">
                                            @csrf
                                            <button class="add-button add_cart tooltip-top"
                                                data-tippy-content="Add to cart">
                                                {{ __('Add to cart') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
@if (isset($product) && $product)

    <script src="//unpkg.com/alpinejs"></script>
    <script>
        document.addEventListener('livewire:load', function() {
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
    <script>
        document.getElementById('add-cart-{{ $product->id }}').addEventListener('click', function(event) {
            // Fire Facebook Pixel's AddToCart event
            fbq('track', 'AddToCart', {
                content_name: '{{ $product->name_ar }}', // Product name in Arabic
                content_ids: ['{{ $product->id }}'], // Unique product ID
                content_type: 'product', // Type of content (product)
                value: '{{ $product->price }}', // Product price
                currency: 'USD' // Set the currency, e.g., USD or another
            });

            // Allow the form to be submitted after tracking event
        });
    </script>
@endif
