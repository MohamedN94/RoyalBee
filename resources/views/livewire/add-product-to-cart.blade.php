<div id="selectSize" class="pro-group addeffect-section product-description border-product">
    {{--    <h6 class="product-title">quantity</h6> --}}
    {{--    <div class="qty-box"> --}}
    {{--        <div class="input-group"> --}}
    {{--            <button class="qty-minus">-</button> --}}
    {{--            <input class="qty-adj form-control" min="1" type="number" name="quantity" wire:model="quantity" --}}
    {{--                   disabled/> --}}
    {{--            <button class="qty-plus">+</button> --}}
    {{--        </div> --}}
    {{--    </div> --}}

    <div class="product-buttons" style="display: flex; align-items: center;flex-wrap: wrap">
        <form style="padding-left: 5px;" wire:submit.prevent="addToCart({{ $productId }})" method="post">
            @csrf
            <a href="javascript:void(0)" wire:click="addToCart({{ $productId }})" id="cartEffect"
                onclick="openCartToastar()" class="btn cart-btn btn-normal tooltip-top"
                data-tippy-content="{{ __('Add to cart') }}">
                <i class="fa fa-shopping-cart"></i> <span class="small"> {{ __('Add to cart') }} </span>
            </a>
        </form>


    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#order-now" style="margin-left: 5px"
        class="btn cart-btn btn-normal tooltip-top" data-tippy-content="{{ __('Order now') }}" id="orders">
        <i class="fa fa-shopping-basket"></i> <span class="small"> {{ __('Order now') }} </span>
    </a>

        <form wire:submit.prevent="addToWishlist({{ $productId }})" method="post" x-data x-init="if (!Alpine.store('wishlistStore')) {
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
        $store.wishlistStore.updateWishlist({{ $productId }}, {{ json_encode($isInWishlist) }});">
            @csrf
            <a href="javascript:void(0)" data-tippy-content="{{ __('Add to wishlist') }}" id="withlistEffect"
                @click.prevent="
                    if (typeof $wire !== 'undefined' && Alpine.store('wishlistStore') &&
                    $store.wishlistStore.isInWishlist({{ $productId }})) {
                    $wire.removeFromWishlist({{ $productId }}).then(() => {
                    $store.wishlistStore.updateWishlist({{ $productId }}, false);
                    toastr.success('Removed from Wishlist!');
                        fbq('track', 'RemoveFromWishlist', {
                           content_name: '{{ $product->name_en }}',
                           content_ids: ['{{ $product->id }}'],
                           content_type: 'product',
                           value: '{{ $product->price }}',
                           currency: 'AED'
                        });
                        ttq.track('AddToCart', {
                            content_id: '{{ $product->id }}',
                            content_type: 'product',
                            value: {{ $product->price }},
                            currency: 'AED'
                        });

                    });
                    } else if (typeof $wire !== 'undefined' && Alpine.store('wishlistStore')) {
                    $wire.addToWishlist({{ $productId }}).then(() => {
                    $store.wishlistStore.updateWishlist({{ $productId }}, true);
                    toastr.success('Added to Wishlist!');
                    fbq('track', 'AddToWishlist', {
                       content_name: '{{ $product->name_en }}',
                       content_ids: ['{{ $product->id }}'],
                       content_type: 'product',
                       value: '{{ $product->price }}',
                       currency: 'AED'
                    });

                    });
                    } else {
                    console.error('wishlistStore or $wire is not defined');
                    }
                    "
                class="btn btn-normal add-to-wish tooltip-top m-2">

                <i
                    :class="$store.wishlistStore.isInWishlist({{ $productId }}) ? 'fa fa-heart text-danger ' :
                        'fa fa-heart text-white'"></i>

            </a>
        </form>

    </div>
</div>

@if (auth()->check())
    <script src="//unpkg.com/alpinejs"></script>
    {{-- <script> --}}
    {{--    document.addEventListener('alpine:init', () => { --}}
    {{--        if (!Alpine.store('wishlistStore')) { --}}
    {{--            Alpine.store('wishlistStore', { --}}
    {{--                products: {}, --}}

    {{--                updateWishlist(productId, status) { --}}
    {{--                    this.products[productId] = status; --}}
    {{--                }, --}}

    {{--                isInWishlist(productId) { --}}
    {{--                    return this.products[productId] || false; --}}
    {{--                } --}}
    {{--            }); --}}
    {{--        } --}}
    {{--    }); --}}
    {{-- </script> --}}
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
@endif
