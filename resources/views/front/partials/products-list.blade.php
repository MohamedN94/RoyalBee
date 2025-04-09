<div class="row">
    @foreach($products as $product)
        <div class="col-md-2">
            <div style="width: 100%; display: inline-block;">
                <div class="product-box">
                    <div class="product-imgbox">
                        <div class="product-front">
                            <a href="{{route('web.product.show',$product->slug)}}">
                                <img src="{{ asset($product->image) }}" class="img-fluid"
                                     alt="{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}">
                            </a>
                        </div>
                        <div class="product-icon">
                        </div>
                    </div>
                    <div class="product-detail detail-center1">
                        <ul class="rating-star">
                            @for ($i = 1; $i <= 5; $i++)
                                <li>
                                    @if ($product->review >= $i)
                                        <i class="fa fa-star" style="color: #FFD700;"></i>
                                    @elseif ($product->review >= $i - 0.5)
                                        <i class="fa fa-star-half-alt"
                                           style="color: #FFD700;"></i>
                                    @else
                                        <i class="fa fa-star" style="color: #e4e5e9;"></i>
                                    @endif
                                </li>
                            @endfor
                        </ul>
                        <a href="#">
                            <h6>{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}</h6>
                        </a>
                        <span class="detail-price">
                        @if($product->discount_price)
                                <span class="discount" style="text-decoration: line-through;">
                                                      {{ $product->price }}
                                                  </span>
                                <span class="text-center">{{ $product->discount_price }}</span>
                            @else
                                <span class="text-center">{{ $product->price }}</span>
                            @endif
                        </span>
                    </div>
                    <livewire:add-to-cart :productId="$product->id"/>
                </div>
            </div>
        </div>
    @endforeach
</div>
