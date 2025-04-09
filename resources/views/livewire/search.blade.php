<div>
    <div class="collection-product-wrapper">
        <div class="product-top-filter">
            <div class="row">
                <div class="col-xl-12">
                    <div class="filter-main-btn">
                        <span class="filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Filter</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-filter-content">
                        <div class="search-count">
                            <h5> {{__('Showing Products')}}{{ $products->firstItem() }}-{{ $products->lastItem() }}
                                {{__('of')}} {{ $products->total() }} {{__('Result')}}</h5>
                        </div>
                        {{--                        <div class="collection-view">--}}
                        {{--                            <ul>--}}
                        {{--                                <li><i class="fa fa-th grid-layout-view"></i></li>--}}
                        {{--                                <li><i class="fa fa-list-ul list-layout-view"></i></li>--}}
                        {{--                            </ul>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="collection-grid-view">--}}
                        {{--                            <ul>--}}
                        {{--                                <li><img src="{{asset('front/images/category/icon/2.png')}}" alt=""--}}
                        {{--                                         class="product-2-layout-view"></li>--}}
                        {{--                                <li><img src="{{asset('front/images/category/icon/3.png')}}" alt=""--}}
                        {{--                                         class="product-3-layout-view"></li>--}}
                        {{--                                <li><img src="{{asset('front/images/category/icon/4.png')}}" alt=""--}}
                        {{--                                         class="product-4-layout-view"></li>--}}
                        {{--                                <li><img src="{{asset('front/images/category/icon/6.png')}}" alt=""--}}
                        {{--                                         class="product-6-layout-view"></li>--}}
                        {{--                            </ul>--}}
                        {{--                        </div>--}}
                        <div class="product-page-filter">
                            <select wire:model.change="category">
                                <option  value="all">{{__('all')}}</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">
                                        {{app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="product-page-per-view">
                            <select wire:model.change="perPage">
                                <option value="24">24 {{__('Products Per Page')}}</option>
                                <option value="50">50 {{__('Products Per Page')}}</option>
                                <option value="100">100 {{__('Products Per Page')}}</option>
                            </select>
                        </div>
                        <div class="product-page-filter">
                            <select wire:model.change="sortBy">
                                <option value="default">{{__('Default Sorting')}}</option>
                                <option value="price_asc">{{__('Price: Low to High')}}</option>
                                <option value="price_desc">{{__('Price: High to Low')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-wrapper-grid product">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-xl-3 col-md-4 col-6 col-grid-box">
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
                                            $store.wishlistStore.updateWishlist({{ $product->id }}, {{ json_encode($isInWishlist[$product->id]) }});
                                     " class="product-front">
                                    <a href="{{route('web.product.show',$product->slug)}}"><img
                                            src="{{ asset($product->image) }}" class="img-fluid"
                                            alt="{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}"></a>
                                </div>
                                <div class="product-back">
                                    <a href="{{route('web.product.show',$product->slug)}}"><img
                                            src="{{ asset($product->photos()->first()?->photo) }}"
                                            class="img-fluid" alt="product"></a>
                                </div>
                            </div>
                            <div class="product-detail detail-center detail-inverse text-center">
                                <div class="detail-title">
                                    <div class="detail-left">
                                        <div class="rating-star">
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
                                        </div>
                                        <p>{{ $product->name_en }}</p>
                                        <a href="{{route('web.product.show',$product->slug)}}">
                                            <h6 class="price-title">{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}</h6>
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <span class="detail-price text-center">
                                           @if ($product->discount_price)
                                                <span class="discount text-center"
                                                      style="text-decoration: line-through;">
                                            <span style="margin-left: 15px"
                                                  class="price text-center">{{ $product->price }}</span>
                                           </span>
                                                <span style="margin-left: 15px"
                                                      class="text-center">{{ $product->discount_price }}</span>
                                            @else
                                                <span class="text-center">{{ $product->price }}</span>
                                        @endif

                                    </div>
                                </div>
                                <div class="icon-detail" wire:ignore>
                                    <form wire:submit.prevent="addToCart({{ $product->id }})" method="post">
                                        @csrf
                                        <button onclick="openCartToastar()"
                                                ata-bs-toggle="modal" data-bs-target="#addtocart" class="tooltip-top"
                                                data-tippy-content="{{__('Add to cart')}}">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                    <form wire:submit.prevent="addToWishlist({{ $product->id }})" method="post">
                                        @csrf
                                        <button @click.prevent="
                                                    if (typeof $wire !== 'undefined' && Alpine.store('wishlistStore') && $store.wishlistStore.isInWishlist({{ $product->id }})) {
                                                        $wire.removeFromWishlist({{ $product->id }}).then(() => {
                                                            $store.wishlistStore.updateWishlist({{ $product->id }}, false);
                                                            toastr.success('{{__('Removed from Wishlist!')}}');
                                                        });
                                                    } else if (typeof $wire !== 'undefined' && Alpine.store('wishlistStore')) {
                                                        $wire.addToWishlist({{ $product->id }}).then(() => {
                                                            $store.wishlistStore.updateWishlist({{ $product->id }}, true);
                                                            toastr.success('{{__('Added to Wishlist!')}}');
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
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="product-pagination">
            {{ $products->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            if (typeof Livewire !== 'undefined') {
                console.log('Livewire is available.');

                let slider = $(".js-range-slider").ionRangeSlider({
                    type: "double",
                    min: 0,
                    max: 3000,
                    from: @this.get('minPrice'),
                    to: @this.get('maxPrice'),
                    grid: true,
                    prefix: "$", // Add prefix if needed
                    onFinish: function (data) {
                        @this.
                        set('minPrice', data.from);
                        @this.
                        set('maxPrice', data.to);
                    }
                }).data("ionRangeSlider");

                console.log('Slider initialized:', slider); // Check slider initialization

                Livewire.hook('message.processed', (message, component) => {
                    slider.update({
                        from: @this.get('minPrice'),
                        to: @this.get('maxPrice')
                    })
                });
            }
        });
    </script>
    <script src="//unpkg.com/alpinejs"></script>
    {{--    <script>--}}
    {{--        document.addEventListener('alpine:init', () => {--}}
    {{--            Alpine.store('wishlistStore', {--}}
    {{--                products: {},--}}

    {{--                updateWishlist(productId, status) {--}}
    {{--                    this.products[productId] = status;--}}
    {{--                },--}}

    {{--                isInWishlist(productId) {--}}
    {{--                    return this.products[productId] || false;--}}
    {{--                }--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}
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

@endpush
