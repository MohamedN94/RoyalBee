<div class="product-buttons">
    <form class="btn cart-btn btn-normal"
          wire:submit.prevent="addToCart(document.getElementById('product-id').value)" method="post">
        @csrf
        <i class="fa fa-shopping-cart"></i>
        <button  class="btn cart-btn btn-normal tooltip-top" data-tippy-content="{{__('Add to cart')}}"
               onclick="openCartToastar()"
            wire:loading.attr="disabled"
                 wire:target="addToCart(document.getElementById('product-id').value)">
            <span wire:loading.remove
                  wire:target="addToCart(document.getElementById('product-id').value)">{{__('Add to cart')}}</span>
            <span wire:loading
                  wire:target="addToCart(document.getElementById('product-id').value)">
                            <span class="spinner-border spinner-border-lg" role="status" aria-hidden="true"></span>
                        </span>
        </button>
    </form>
    <a href="#" class="btn btn-normal tooltip-top" id="more-details-btn"
       data-tippy-content="view detail">
       {{__('view details')}}
    </a>
</div>
