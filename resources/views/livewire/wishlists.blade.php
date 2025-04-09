<section class="wishlist-section section-big-py-space b-g-light">
    <div class="custom-container">
        <div class="row">
            <div class="col-sm-12">
                <table class="table cart-table table-responsive-xs">
                    <thead>
                    <tr class="table-head">
                        <th scope="col">{{__('Image')}}</th>
                        <th scope="col">{{__('Product name')}}</th>
                        <th scope="col">{{__('Price')}}</th>
                        <th scope="col">{{__('availability')}}</th>
                        <th scope="col">{{__('Action')}}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($wishlists as $wishlist)
                        <tr>
                            <td>
                                <a href="javascript:void(0)"><img src="{{asset($wishlist->image)}}"
                                                                  alt="product" class="img-fluid  "></a>
                            </td>
                            <td>
                                <a href="javascript:void(0)">{{app()->getLocale() == 'ar' ? $wishlist->name_ar : $wishlist->name_en}}</a>
                                <div class="mobile-cart-content">
                                    <div class="col-xs-3">
                                        <p>{{__('in stock')}}</p>
                                    </div>
                                    <div class="col-xs-3">
                                        <h2 class="td-color">{{$wishlist->discount_price ?? $wishlist->price }}</h2>
                                    </div>
                                    <div class="col-xs-3">
                                        <h2 class="td-color">
                                            <button style="border: none"
                                                    wire:click="removeFromWishlist('{{ $wishlist->id }}')"
                                                    wire:confirm="{{__('Are you sure you want to delete?')}} "
                                                    @click="$store.wishlistStore.updateWishlist({{ $wishlist->id }}, false)">
                                                <i class="ti-close"></i>
                                            </button>
                                            <a href="javascript:void(0)"
                                               class="cart"><i class="ti-shopping-cart"></i></a></h2>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h2>{{$wishlist->discount_price ?? $wishlist->price }}</h2>
                            </td>
                            <td>
                                <p>{{$wishlist->stock > 0 ? __('in stock') : __('not available')}}</p>
                            </td>

                            <td>
                                <button style="border: none"
                                        wire:click="removeFromWishlist('{{ $wishlist->id }}')"
                                        wire:confirm="{{__('Are you sure you want to delete?')}}"
                                        @click="$store.wishlistStore.updateWishlist({{ $wishlist->id }}, false)">
                                    <i class="ti-close"></i>
                                </button>
                                <form wire:submit.prevent="addToCart({{ $wishlist->id }})" method="post">
                                    @csrf
                                    <button style="border: none" class="cart" onclick="openCartToastar()"
                                            wire:target="addToCart({{ $wishlist->id }})"><i
                                            class="ti-shopping-cart"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row wishlist-buttons">
            <div class="col-12"><a href="{{route('web.home')}}" class="btn btn-normal">{{__('Continue shopping')}}</a>
                {{--                <a href="javascript:void(0)" class="btn btn-normal">check out</a></div>--}}
            </div>
        </div>
    </div>
</section>

