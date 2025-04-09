<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        Select an option
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a href="{{route('web.product.show',$product->slug)}}" class="dropdown-item"
            title="Edit Language">
             <i class="la la-eye"></i>&nbsp; {{ __('dashboard.view') }}
         </a>

        <a data-url="{{ route('dashboard.products.toggleTrending', ['id' => $product->id]) }}" style="cursor: pointer;"
           data-item-id="{{ $product->id }}" class="dropdown-item trend-button">
            <i class="fa {{ $product->trending_product ? 'fa-minus' : 'fa-plus' }} option-icon"></i>
            &nbsp; <span
                class="trend-text">{{ $product->trending_product ? 'Remove from Trending' : 'Add to Trending' }}</span>
        </a>
        <a data-url="{{ route('dashboard.products.toggleBestSeller', ['id' => $product->id]) }}" style="cursor: pointer;"
           data-item-id="{{ $product->id }}" class="dropdown-item seller-button">
            <i class="fa {{ $product->best_seller ? 'fa-minus' : 'fa-plus' }} option-icon"></i>
            &nbsp; <span
                class="seller-text">{{ $product->best_seller ? 'Remove from Best seller' : 'Add to Best seller' }}</span>
        </a>

        <a data-url="{{ route('dashboard.products.visible', ['id' => $product->id]) }}" style="cursor: pointer;"
            data-item-id="{{ $product->id }}" class="dropdown-item seller-button">
             <i class="fa {{ $product->is_visible ? 'fa-minus' : 'fa-plus' }} option-icon"></i>
             &nbsp; <span
                 class="seller-text">{{ $product->is_visible ? 'Hide' : 'Show' }}</span>
         </a>
 
        <a href="{{ route('dashboard.products.edit', ['product' => $product->id]) }}" class="dropdown-item"
           title="Edit Language">
            <i class="la la-edit"></i>&nbsp; {{ __('dashboard.edit') }}
        </a>
        <a data-url="{{ route('dashboard.products.destroy', ['product' => $product->id]) }}" style="cursor: pointer;"
           data-item-id="{{ $product->id }}" class="dropdown-item delete-button" data-toggle="modal"
           data-target="#delete_modal">
            <i class="la la-trash"></i>&nbsp; Delete
        </a>
    </div>
</div>


<script src="{{ asset('assets/js/delete-item.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/toggle.js') }}" type="text/javascript"></script>
