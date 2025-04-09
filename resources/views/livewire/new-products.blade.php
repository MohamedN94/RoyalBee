<div class="theme-card creative-card creative-inner" wire:ignore>
    <h5 class="title-border">{{__('new product')}}</h5>
    <div class="slide-1">
        @foreach($products as $product)
            <div>
                <div class="media-banner plrb-0 b-g-white1 border-0">
                    <div class="media-banner-box">
                        <div class="media">
                            <a href="{{route('web.product.show', $product->slug)}}" tabindex="0">
                                <img src="{{asset($product->image)}}" class="product-image" alt="banner">
                            </a>
                            <div class="media-body">
                                <div class="media-contant">
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
                                        <div class="product-detail">
                                            <ul class="rating">
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
                                            <a href="#" tabindex="0">
                                                <p>{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}</p>
                                            </a>
                                            <h6>
                                                {{$product->discount_price}}
                                                @if($product->discount_price)
                                                    <span>{{$product->price}}</span>
                                                @else
                                                    <p>{{$product->price}}</p>
                                                @endif
                                            </h6>
                                        </div>

                                        <div class="cart-info">
                                            <!-- Add to Cart Button -->

                                                <button class="tooltip-top add-cartnoty" wire:click="addToCart({{ $product->id }})"
                                                        data-tippy-content="{{__('Add to cart')}}"
                                                        onclick="openCartToastar()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-shopping-cart">
                                                        <circle cx="9" cy="21" r="1"></circle>
                                                        <circle cx="20" cy="21" r="1"></circle>
                                                        <path
                                                            d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                                    </svg>
                                                </button>

                                            <!-- Add/Remove from Wishlist -->
                                            <form wire:submit.prevent="addToWishlist({{ $product->id }})" method="post">
                                                @csrf
                                                <button @click.prevent="
                                                if ($store.wishlistStore.isInWishlist({{ $product->id }})) {
                                                    $wire.removeFromWishlist({{ $product->id }}).then(() => {
                                                        $store.wishlistStore.updateWishlist({{ $product->id }}, false);
                                                        toastr.success('Removed from Wishlist!');
                                                    });
                                                } else {
                                                    $wire.addToWishlist({{ $product->id }}).then(() => {
                                                        $store.wishlistStore.updateWishlist({{ $product->id }}, true);
                                                        toastr.success('Added to Wishlist!');
                                                    });
                                                }">
                                                    <i :class="$store.wishlistStore.isInWishlist({{ $product->id }}) ? 'fa fa-heart text-danger' : 'fa fa-heart text-muted'"></i>
                                                </button>
                                            </form>

                                            <!-- Quick View Button -->
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                               data-bs-target="#quick-view"
                                               onclick="showProduct(this, {{ $product->id }})" class="tooltip-left"
                                               data-tippy-content="{{__('Quick View')}}">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </div>
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

@push('scripts')
    <!-- Alpine.js Initialization Script -->
    <script src="//unpkg.com/alpinejs"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            // Listen for Livewire event to update wishlist
            Livewire.on('wishlist_updated', productId => {
                if (Alpine.store('wishlistStore')) {
                    Alpine.store('wishlistStore').updateWishlist(productId, false);
                } else {
                    console.error('wishlistStore is not defined');
                    // Optionally reinitialize if needed
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
@endpush
