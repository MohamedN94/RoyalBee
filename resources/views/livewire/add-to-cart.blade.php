<div class="addtocart_btn">
    <form wire:submit.prevent="addToCart({{$productId}})" method="post">
        @csrf
        <button class="add-button add_cart tooltip-top"
                data-tippy-content="{{__('Add to cart')}}"
                onclick="openCartToastar()" wire:loading.attr="disabled"
                wire:target="addToCart({{ $productId }})">
            <span wire:loading.remove wire:target="addToCart({{ $productId }})">{{__('Add to cart')}}</span>
            <span wire:loading wire:target="addToCart({{ $productId }})">
                                                <span class="spinner-border spinner-border-lg" role="status"
                                                      aria-hidden="true"></span>
                                                 </span>
        </button>
    </form>
    <div class="qty-box cart_qty">
        <div class="input-group">
            <button type="button" class="btn quantity-left-minus" data-type="minus"
                    onclick="openCart()"
                    data-field="">
                <i class="fa fa-minus" aria-hidden="true"></i>
            </button>
            <input type="text" name="quantity"
                   class="form-control input-number qty-input" disabled
                   value="1">
            <button type="button" class="btn quantity-right-plus" data-type="plus"
                    onclick="openCart()"
                    data-field="">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</div>
