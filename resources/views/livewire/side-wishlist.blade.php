<div class="cart_media">
    <ul class="cart_product">
        @forelse($wishlists as $wishlist)
            <li>
                <div class="media">
                    <a href="#">
                        <img alt="megastore1" class="me-3"
                             src="{{asset($wishlist->image)}}">
                    </a>
                    <div class="media-body">
                        <a href="#">
                            <h4>{{app()->getLocale() == 'ar' ? $wishlist->name_ar : $wishlist->name_en}}</h4>
                        </a>
                        <h6>
                            {{$wishlist->discount_price}}
                            <span
                                style="{{$wishlist->discount_price ? 'text-decoration: line-through' : "text-decoration:none"}}">{{$wishlist->price}}</span>
                        </h6>

                        <div class="addit-box">
                            <div class="pro-add">
                                <button style="border: none"
                                        wire:click="removeFromWishlist('{{ $wishlist->id }}')"
                                        wire:confirm="{{__('Are you sure you want to delete?')}}"
                                        @click="$store.wishlistStore.updateWishlist({{ $wishlist->id }}, false)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <span> {{__('Wishlist is empty')}}</span>
        @endforelse
    </ul>
    <ul class="cart_total">
        <li>
            <div class="buttons">
                <a href="{{route('web.wishlist.index')}}" class="btn btn-solid btn-block btn-md">{{__('View wishlist')}}</a>
            </div>
        </li>
    </ul>
</div>
<script src="//unpkg.com/alpinejs"></script>
