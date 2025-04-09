
    @auth
        <form wire:submit.prevent="addToWishlist({{ $productId }})" method="post">
            @csrf
            <button onclick="showToastr()" class="add-to-wish tooltip-left"
                    wire:target="addToWishlist({{ $productId }})"
                    data-tippy-content="{{__('Add to Wishlist')}}">
                <i class="fa fa-heart {{ $isInWishlist ? 'text-danger' : 'text-muted' }}"></i>
            </button>
        </form>
    @else
        <button onclick="openWishlist()" class="add-to-wish tooltip-left"
                data-tippy-content="Add to Wishlist">
            <i class="fa fa-heart {{ $isInWishlist ? 'text-danger' : 'text-muted' }}"></i>
        </button>
    @endauth

<script>
    function showToastr() {
        toastr.success('{{__('Your Wishlist has been updated successfully')}}');
    }
</script>
