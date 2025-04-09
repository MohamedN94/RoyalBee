<div>
    <section class="cart-section section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="row">
                <div class="col-sm-12" style="background-color:#ff8200;border-radius: 20px;">
                    <table class="table cart-table table-responsive-xs">
                        <thead>
                        <tr class="table-head">
                            <th scope="col">{{__('Image')}}</th>
                            <th scope="col">{{__('Product name')}}</th>
                            <th scope="col">{{__('Price')}}</th>
                            <th scope="col">{{__('Quantity')}}</th>
                            <th scope="col">{{__('Action')}}</th>
                            <th scope="col">{{__('Total')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($carts as $cart)
                            @php $record = \App\Models\Admin\Product::whereId($cart->id)->first(); @endphp
                            <tr>
                                <td>
                                    <a href="javascript:void(0)"><img src="{{asset($record->image)}}"
                                                                      alt="cart" class=" "></a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)">{{app()->getLocale() == 'ar' ? $record->name_ar : $record->name_en }}</a>
                                </td>
                                <td>
                                    <h2>{{$record->price}}</h2>
                                </td>
                                <td>
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <input wire:model="{{ $cart->id }}" value="{{$cart->qty}}"
                                                   class="input-number form-control" id="myNumberInput"
                                                   wire:input.debounce.500ms="updateTotal('{{ $cart->rowId }}', $event.target.value)"
                                                   type="number" step="1" min="1"/>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button wire:click="removeFromCart('{{ $cart->rowId }}')"
                                            wire:confirm="{{__('Are you sure you want to delete?')}}" style=" padding-top: 5px; border: none; border-radius: 6px;  background-color: #ffcb6c;">
                                        <i class="ti-close"></i>
                                    </button>
                                </td>
                                <td>
                                    <h2 class="td-color">{{$record->price * $cart->qty}}</h2>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <table class="table cart-table table-responsive-md">
                        <tfoot>
                        <tr>
                            <td>{{__('Total price')}} :</td>
                            <td>
                                <h2>{{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</h2>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row cart-buttons">
                <div class="col-12"><a href="{{route('web.home')}}" class="btn btn-normal">{{__('Continue shopping')}}</a> <a
                        href="{{route('web.checkout.index')}}" class="btn btn-normal ms-3" id="check">{{__('Checkout')}}</a></div>
            </div>
        </div>
    </section>
    <script>
  document.getElementById('check').addEventListener('click', function(event) {
    // Fire the Facebook Pixel 'InitiateCheckout' event
    fbq('track', 'InitiateCheckout', {
        content_ids: '{{ $record->id }}',  
        content_type: 'product',
        value: '{{ $record->price }}',  
        currency: 'AED',
        num_items: 1
    });

    // Let the modal still open by not preventing the default behavior
    // You don't need to prevent the default behavior because the modal uses Bootstrap's data attributes
  });
</script>

</div>
