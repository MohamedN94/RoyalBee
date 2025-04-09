@extends('front.layouts.app')
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-main ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-contain">
                        <div>
                            <h2>{{ __('product') }}</h2>
                            <ul>
                                <li><a href="{{ route('web.home') }}">{{ __('Home') }}</a></li>
                                <li><i class="fa fa-angle-double-right"></i></li>
                                <li><a href="javascript:void(0)"></a>{{ __('product') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->

    <!-- section start -->
    <section class="section-big-pt-space b-g-light">
        <div class="collection-wrapper">
            <div class="custom-container">
                <div class="row">
                    <div class="col-lg-9 col-sm-12 col-xs-12">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xl-12">
                                    {{--                                    <div class="filter-main-btn mb-2"><span class="filter-btn"><i class="fa fa-filter" --}}
                                    {{--                                                                                                  aria-hidden="true"></i> {{__('filter')}}</span> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-slick">

                                    @if ($product->photos->count() != 0)
                                        @php
                                            $photos = $product->photos->concat([(object) ['photo' => $product->image]]);
                                        @endphp
                                        <div>
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name_en }}"
                                                class="img-fluid image_zoom_cls-0">
                                        </div>

                                        @foreach ($product->photos as $photo)
                                            <div>
                                                <img src="{{ asset($photo->photo) }}" alt="{{ $product->name_en }}"
                                                    class="img-fluid  image_zoom_cls-0">
                                            </div>
                                        @endforeach
                                    @else
                                        <div>
                                            <img src="{{ asset($product->image) }}"
                                                alt="{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}"
                                                class="img-fluid  image_zoom_cls-0">
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-12 p-0">
                                        <div class="slider-nav">
                                            @php
                                                $photos = $product->photos->concat([
                                                    (object) ['photo' => $product->image],
                                                ]);
                                            @endphp
                                            <div>
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name_en }}"
                                                    class="img-fluid">
                                            </div>

                                            @foreach ($product->photos as $photo)
                                                <div><img src="{{ asset($photo->photo) }}"
                                                        alt="{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}"
                                                        class="img-fluid"></div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 rtl-text">
                                <div class="product-right">
                                    <div class="pro-group">
                                        <h2>{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}</h2>
                                        <ul class="pro-price">

                                            @if ($product->discount_price)
                                                @if ($product->sale_start_date && $product->sale_end_date)
                                                    @if (now() >= $product->sale_start_date && now() <= $product->sale_end_date)
                                                        <li>{{ $product->discount_price }} AED</li>
                                                        <li><span> {{ $product->price }}</span></li>

                                                        <li> {{ $product->discount_price - $product->price }}
                                                            {{ __('AED') }}
                                                        </li>
                                                    @else
                                                        {{ $product->price }} {{ __('AED') }}
                                                    @endif
                                                @else
                                                    <li>{{ $product->discount_price }} AED</li>
                                                    <li><span> {{ $product->price }}</span></li>
                                                    <li> {{ $product->discount_price - $product->price }}
                                                        {{ __('AED') }}</li>
                                                @endif
                                            @else
                                                {{ $product->price }} {{ __('AED') }}
                                            @endif
                                        </ul>
                                        <div class="revieu-box">
                                            <ul>
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
                                            <a href="#"><span>({{ $product->reviews()->count() }}
                                                    {{ __('reviews') }})</span></a>
                                        </div>
                                        <ul class="best-seller">
                                            @if ($product->best_seller == 1)
                                                <li>
                                                    <svg viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg">
                                                        <g>
                                                            <path
                                                                d="m102.427 43.155-2.337-2.336a3.808 3.808 0 0 1 -.826-4.149l1.263-3.053a3.808 3.808 0 0 0 -2.063-4.975l-3.036-1.256a3.807 3.807 0 0 1 -2.352-3.519v-3.286a3.808 3.808 0 0 0 -3.809-3.808h-3.3a3.81 3.81 0 0 1 -3.518-2.35l-1.269-3.052a3.808 3.808 0 0 0 -4.98-2.059l-3.032 1.258a3.807 3.807 0 0 1 -4.152-.825l-2.323-2.323a3.809 3.809 0 0 0 -5.386 0l-2.336 2.336a3.808 3.808 0 0 1 -4.149.826l-3.053-1.263a3.809 3.809 0 0 0 -4.975 2.063l-1.257 3.036a3.808 3.808 0 0 1 -3.519 2.353h-3.285a3.808 3.808 0 0 0 -3.809 3.808v3.3a3.808 3.808 0 0 1 -2.349 3.519l-3.053 1.266a3.809 3.809 0 0 0 -2.059 4.976l1.259 3.035a3.81 3.81 0 0 1 -.825 4.152l-2.324 2.323a3.809 3.809 0 0 0 0 5.386l2.337 2.337a3.807 3.807 0 0 1 .826 4.149l-1.263 3.056a3.808 3.808 0 0 0 2.063 4.975l3.036 1.256a3.807 3.807 0 0 1 2.352 3.519v3.286a3.808 3.808 0 0 0 3.809 3.808h3.3a3.809 3.809 0 0 1 3.518 2.35l1.265 3.052a3.808 3.808 0 0 0 4.984 2.059l3.035-1.259a3.811 3.811 0 0 1 4.152.825l2.323 2.324a3.809 3.809 0 0 0 5.386 0l2.336-2.336a3.81 3.81 0 0 1 4.149-.827l3.053 1.264a3.809 3.809 0 0 0 4.975-2.063l1.257-3.037a3.809 3.809 0 0 1 3.519-2.352h3.285a3.808 3.808 0 0 0 3.809-3.808v-3.3a3.808 3.808 0 0 1 2.349-3.518l3.053-1.266a3.809 3.809 0 0 0 2.059-4.976l-1.259-3.036a3.809 3.809 0 0 1 .825-4.151l2.324-2.324a3.809 3.809 0 0 0 -.003-5.39z"
                                                                fill="#f9cc4e" />
                                                            <circle cx="64" cy="45.848" fill="#4ec4b5"
                                                                r="29.146" />
                                                            <path
                                                                d="m59.795 41.643 4.205-12.614 4.205 12.614h12.615l-8.41 8.41 4.205 12.615-12.615-8.41-12.615 8.41 4.205-12.615-8.41-8.41z"
                                                                fill="#f9cc4e" />
                                                            <path
                                                                d="m87.579 74.924h-1.6a3.809 3.809 0 0 0 -3.519 2.352l-1.257 3.037a3.809 3.809 0 0 1 -4.975 2.063l-3.053-1.264a3.81 3.81 0 0 0 -4.149.827l-2.336 2.336a3.809 3.809 0 0 1 -5.386 0l-2.323-2.324a3.811 3.811 0 0 0 -4.152-.825l-3.029 1.259a3.808 3.808 0 0 1 -4.977-2.059l-1.265-3.052a3.809 3.809 0 0 0 -3.518-2.35h-1.618l-17.417 35.386 17.255-5.872 5.872 17.256 17.868-36.304 17.868 36.3 5.872-17.256 17.26 5.876z"
                                                                fill="#f95050" />
                                                        </g>
                                                    </svg>
                                                    {{ __('best seller') }}
                                                </li>
                                            @endif
                                            {{-- <li>
                                                    <svg enable-background="new 0 0 497 497" viewBox="0 0 497 497"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <g>
                                                            <path
                                                                d="m329.63 405.42-.38.43c-10.048 19.522-48.375 35.567-80.775 35.607-24.881 0-53.654-9.372-71.486-20.681-5.583-3.54-2.393-10.869-6.766-15.297l19.149-5.13c3.76-1.22 6.46-4.54 6.87-8.47l8.574-59.02 82.641-2.72 12.241 28.06.837 8.668-1.844 9.951 3.456 6.744.673 6.967c.41 3.93 3.11 7.25 6.87 8.47z"
                                                                fill="#f2d1a5"/>
                                                            <path
                                                                d="m420.39 497h-343.78c-6.21 0-7.159-6.156-6.089-12.266l2.53-14.57c3.82-21.96 16.463-37.323 37.683-44.153l27.702-8.561 28.754-8.035c18.34 18.57 48.615 27.957 81.285 27.957 32.4-.04 61.709-8.478 80.259-26.809l.38-.43 31.486 5.256 26.39 8.5c21.22 6.83 36.9 24.87 40.72 46.83l2.53 14.57c1.07 6.111-3.64 11.711-9.85 11.711z"
                                                                fill="#7e8b96"/>
                                                            <g>
                                                                <path
                                                                    d="m384.055 215c-2.94 43.71-18.85 104.74-24.92 130.96-.68 2.94-2.33 5.45-4.56 7.22-2.23 1.78-5.05 2.82-8.06 2.82-6.88 0-12.55-5.37-12.94-12.23 0 0-5.58-84.28-7.63-128.77z"
                                                                    fill="#dc4955"/>
                                                            </g>
                                                            <path
                                                                d="m141 271c-27.062 0-49-21.938-49-49 0-11.046 8.954-20 20-20h8.989l240.468-6.287 8.293 6.287h15.25c11.046 0 20 8.954 20 20 0 27.062-21.938 49-49 49z"
                                                                fill="#f2bb88"/>
                                                            <path
                                                                d="m360.6 415.39-.06.09c-49.3 66.23-174.56 66.38-223.76.56l-.43-.63 18.171-1.91 12.669-8.02c18.34 18.57 48.41 29.8 81.08 29.8h.15c32.4-.04 62.28-11.1 80.83-29.43l.38-.43z"
                                                                fill="#a9a4d3"/>
                                                            <path
                                                                d="m147.8 418.394v10.136l-32.89 10.59c-15.6 5.02-27.05 18.18-29.86 34.34l-3.59 23.54h-4.85c-6.21 0-10.92-5.6-9.85-11.71l2.53-14.57c3.82-21.96 19.5-40 40.72-46.83l26.34-8.48z"
                                                                fill="#64727a"/>
                                                            <path
                                                                d="m182.19 417.45-34.39 11.08c-3.99-3.86-7.68-8.02-11.02-12.49l-.43-.63 30.84-9.93c1.828 1.848 10.344.351 12.353 2.02 2.928 2.433-.561 7.928 2.647 9.95z"
                                                                fill="#938dc8"/>
                                                            <path
                                                                d="m299.7 358.2-2.71-28.06-79.861 2.255.001-.005-16.48.47-2.98 26.56-.763 6.8 2.039 12.83-3.989 4.55-.778 6.93c-.41 3.93-3.11 7.25-6.87 8.47l-20.12 6.48c4.37 4.43 9.41 8.44 15 11.97l10.02-3.22c9.79-3.17 16.79-11.79 17.88-21.97l2.058-17.506c.392-3.33 3.888-5.367 6.958-4.02 11.414 5.008 21.565 7.765 28.393 7.765 11.322.001 31.852-7.509 52.202-20.299z"
                                                                fill="#f2bb88"/>
                                                            <path
                                                                d="m134.539 164.427s-.849 18.411-.849 33.002c0 38.745 9.42 76.067 25.701 105.572 20.332 36.847 72.609 61.499 88.109 61.499s68.394-24.653 89.275-61.499c14.137-24.946 23.338-55.482 25.843-87.741.458-5.894-9.799-20.073-9.799-26.058l10.491-24.775c0-38.422-36.205-111.427-114.81-111.427s-113.961 73.005-113.961 111.427z"
                                                                fill="#f2d1a5"/>
                                                            <g>
                                                                <path
                                                                    d="m294 227.5c-4.142 0-7.5-3.358-7.5-7.5v-15c0-4.142 3.358-7.5 7.5-7.5s7.5 3.358 7.5 7.5v15c0 4.142-3.358 7.5-7.5 7.5z"
                                                                    fill="#64727a"/>
                                                            </g>
                                                            <g>
                                                                <path
                                                                    d="m203 227.5c-4.142 0-7.5-3.358-7.5-7.5v-15c0-4.142 3.358-7.5 7.5-7.5s7.5 3.358 7.5 7.5v15c0 4.142-3.358 7.5-7.5 7.5z"
                                                                    fill="#64727a"/>
                                                            </g>
                                                            <g>
                                                                <path
                                                                    d="m249 260.847c-5.976 0-11.951-1.388-17.398-4.163-3.691-1.88-5.158-6.397-3.278-10.087 1.88-3.691 6.398-5.158 10.087-3.278 6.631 3.379 14.547 3.379 21.178 0 3.689-1.881 8.207-.413 10.087 3.278 1.88 3.69.413 8.207-3.278 10.087-5.447 2.775-11.422 4.163-17.398 4.163z"
                                                                    fill="#f2bb88"/>
                                                            </g>
                                                            <path
                                                                d="m288.989 40.759c0 22.511-9.303 40.759-40.489 40.759s-48.702-42.103-48.702-42.103 17.516-39.415 48.702-39.415c25.911 0 47.746 12.597 54.392 29.769 1.353 3.497-13.903 7.182-13.903 10.99z"
                                                                fill="#df646e"/>
                                                            <path
                                                                d="m254.305 81.307c1.031-.099 2.069-.167 3.093-.295 26.96-3.081 47.572-19.928 47.572-40.252 0-3.81-.72-7.49-2.08-10.99-15.42-6.31-33.46-10.34-54.39-10.34-4.139 0-8.163.159-12.073.462-5.127.397-7.393-6.322-3.107-9.163 7.36-4.878 16.519-8.364 26.68-9.879-3.71-.56-7.56-.85-11.5-.85-25.933 0-47.766 12.621-54.393 29.813-.006.002-.011.004-.017.007-1.337 3.487-2.055 7.201-2.06 10.94 0 22.51 25.28 40.76 56.47 40.76 1.946.008 3.872-.09 5.805-.213z"
                                                                fill="#dc4955"/>
                                                            <path
                                                                d="m363.31 164.43v33c0 5.99-.23 11.94-.7 17.83-4.32-.91-8.4-2.66-12.05-5.19-22.785-15.834-31.375-40.163-37.64-60.936-.382-1.268-1.547-2.134-2.871-2.134h-30.949c-4.96 0-9.65-2.15-12.89-5.91l-10.947-12.711c-1.197-1.39-3.349-1.39-4.546 0l-10.947 12.711c-3.24 3.76-7.93 5.91-12.89 5.91h-90.33c8.47-39.6 44.09-94 111.95-94 78.61 0 114.81 73 114.81 111.43z"
                                                                fill="#f2bb88"/>
                                                            <path
                                                                d="m381 164.19v37.81h-11.25c-4 0-7.93-1.16-11.22-3.44-19.74-13.72-26.93-35.65-33.69-58.43-1.26-4.24-5.16-7.13-9.58-7.13h-36.165c-.873 0-1.703-.38-2.273-1.042l-21.559-25.029c-1.197-1.389-3.349-1.389-4.546 0l-21.559 25.029c-.57.662-1.4 1.042-2.273 1.042h-38.015c-5.3 0-9.68 4.14-9.98 9.44 0 0-2.331 25.591-4.032 66.31-1.765 42.256-7.908 135.02-7.908 135.02-.16 2.822-1.215 5.393-2.879 7.441-2.381 2.929-5.67.375-9.72.375-3.01 0-5.83-1.04-8.06-2.82-2.23-1.77-.792-5.474-1.472-8.414-6.7-28.94-23.83-94.686-23.83-138.351 0-13.73-.14-34.689 0-37.649.14-26.43 12.74-54.048 32-78.128 12.937-16.178 28.667-38.955 58.628-47.692 10.986-3.204 23.248-5.101 36.883-5.101 50.8 0 82.75 26.31 100.6 48.39 19.68 24.319 31.9 55.879 31.9 82.369z"
                                                                fill="#df646e"/>
                                                            <path
                                                                d="m211.62 38.54c-19.38 9.9-33.55 23.84-43.37 36.44-19.26 24.69-31.27 56.78-31.41 83.88-.14 3.03-.84 25.18-.84 39.25 0 44.77 18.69 117.93 25.39 147.6.47 2.08 1.4 3.94 2.68 5.5-2.38 2.93-6.01 4.79-10.06 4.79-3.01 0-5.83-1.04-8.06-2.82-2.23-1.77-3.88-4.28-4.56-7.22-6.7-28.94-25.39-100.29-25.39-143.96 0-13.73.7-35.33.84-38.29.14-26.43 12.15-57.73 31.41-81.81 12.94-16.18 33.4-34.63 63.37-43.36z"
                                                                fill="#dc4955"/>
                                                            <g>
                                                                <path
                                                                    d="m316.539 193.816c-1.277 0-2.571-.327-3.755-1.013-11.762-6.82-25.806-6.82-37.567 0-3.583 2.078-8.172.858-10.25-2.726-2.078-3.583-.857-8.172 2.726-10.25 16.474-9.552 36.143-9.552 52.616 0 3.583 2.078 4.804 6.667 2.726 10.25-1.392 2.399-3.909 3.739-6.496 3.739z"
                                                                    fill="#df646e"/>
                                                            </g>
                                                            <g>
                                                                <path
                                                                    d="m225.539 193.816c-1.277 0-2.571-.327-3.755-1.013-11.762-6.82-25.806-6.82-37.567 0-3.583 2.078-8.171.858-10.25-2.726-2.078-3.583-.857-8.172 2.726-10.25 16.474-9.552 36.143-9.552 52.616 0 3.583 2.078 4.804 6.667 2.726 10.25-1.392 2.399-3.909 3.739-6.496 3.739z"
                                                                    fill="#df646e"/>
                                                            </g>
                                                            <g>
                                                                <path
                                                                    d="m302.143 383.517c-16.23 10.87-34.973 16.353-53.643 16.353s-37.3-5.41-53.54-16.27l3.476-6.313-1.526-11.067 4.15 3.37c28.46 20.41 66.63 20.37 95.05-.12.2-.14.39-.27.6-.39l3.826-2.211z"
                                                                    fill="#a9a4d3"/>
                                                            </g>
                                                            <g>
                                                                <path
                                                                    d="m211.98 376.2-1.85 15.68c-5.23-2.27-10.31-5.03-15.17-8.28l1.95-17.38 4.15 3.37c3.5 2.51 7.15 4.72 10.92 6.61z"
                                                                    fill="#938dc8"/>
                                                            </g>
                                                            <g>
                                                                <path
                                                                    d="m269.5 306.5h-42c-4.142 0-7.5-3.358-7.5-7.5s3.358-7.5 7.5-7.5h42c4.142 0 7.5 3.358 7.5 7.5s-3.358 7.5-7.5 7.5z"
                                                                    fill="#df646e"/>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    44 active view this
                                                </li> --}}
                                        </ul>
                                    </div>
                                    @if ($product->discount_price)
                                        @if ($product->sale_start_date && $product->sale_end_date)
                                            @if (now() >= $product->sale_start_date && now() <= $product->sale_end_date)
                                                <div class="pro-group">
                                                    <h6 class="product-title">{{ __('hurry up ! Deal end in') }} :</h6>
                                                    <div class="timer">
                                                        <p id="demo">
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                    <livewire:add-product-to-cart :productId="$product->id" />

                                    {{--                                        <div class="pro-group"> --}}
                                    {{--                                            <div class="product-offer"> --}}
                                    {{--                                                <h6 class="product-title"><i class="fa fa-tags"></i>5 offers Available --}}
                                    {{--                                                </h6> --}}
                                    {{--                                                <div class="offer-contain"> --}}
                                    {{--                                                    <ul> --}}
                                    {{--                                                        <li> --}}
                                    {{--                                                            <span class="code-lable">OFFER40</span> --}}
                                    {{--                                                            <div> --}}
                                    {{--                                                                <h5>Get extra $40 off on first Orders</h5> --}}
                                    {{--                                                                <p>Use code "OFFER40" Min. Cart Value $99 | Max. --}}
                                    {{--                                                                    Discount $40</p> --}}
                                    {{--                                                            </div> --}}
                                    {{--                                                        </li> --}}
                                    {{--                                                    </ul> --}}
                                    {{--                                                    <ul class="offer-sider"> --}}
                                    {{--                                                        <li> --}}
                                    {{--                                                            <span class="code-lable">OFFER25</span> --}}
                                    {{--                                                            <div> --}}
                                    {{--                                                                <h5>Get extra $25 off on second Orders</h5> --}}
                                    {{--                                                                <p>Use code "OFFER25" Min. Cart Value $99 | Max. --}}
                                    {{--                                                                    Discount $25</p> --}}
                                    {{--                                                            </div> --}}
                                    {{--                                                        </li> --}}
                                    {{--                                                        <li> --}}
                                    {{--                                                            <span class="code-lable">OFFER40</span> --}}
                                    {{--                                                            <div> --}}
                                    {{--                                                                <h5>Bank Offer40% Unlimited Cashback on bideal Axis Bank --}}
                                    {{--                                                                    Credit Card</h5> --}}
                                    {{--                                                                <p>Use code "OFFER40" Min. Cart Value $99 | Max. --}}
                                    {{--                                                                    Discount $40</p> --}}
                                    {{--                                                            </div> --}}
                                    {{--                                                        </li> --}}
                                    {{--                                                        <li> --}}
                                    {{--                                                            <span class="code-lable">OFFER10</span> --}}
                                    {{--                                                            <div> --}}
                                    {{--                                                                <h5>Bank Offer10% off* with Axis Bank Buzz Credit Card --}}
                                    {{--                                                                </h5> --}}
                                    {{--                                                                <p>Use code "OFFER10" Min. Cart Value $99 | Max. --}}
                                    {{--                                                                    Discount $10</p> --}}
                                    {{--                                                            </div> --}}
                                    {{--                                                        </li> --}}
                                    {{--                                                        <li> --}}
                                    {{--                                                            <span class="code-lable">OFFER5</span> --}}
                                    {{--                                                            <div> --}}
                                    {{--                                                                <h5>Bank Offer5% Unlimited Cashback on bideal sbi banck --}}
                                    {{--                                                                    Credit Card</h5> --}}
                                    {{--                                                                <p>Use code "OFFER5" Min. Cart Value $99 | Max. Discount --}}
                                    {{--                                                                    $5</p> --}}
                                    {{--                                                            </div> --}}
                                    {{--                                                        </li> --}}
                                    {{--                                                    </ul> --}}
                                    {{--                                                    <h5 class="show-offer"><span class="more-offer">show more --}}
                                    {{--                                                            offer</span><span class="less-offer">less offer</span></h5> --}}
                                    {{--                                                </div> --}}
                                    {{--                                            </div> --}}
                                    {{--                                        </div> --}}

                                    @if (app()->getLocale() == 'ar' && $product->short_desc_ar)
                                        <div class="pro-group">
                                            {!! $product->short_desc_ar !!}
                                        </div>
                                    @elseif (app()->getLocale() == 'en' && $product->short_desc_en)
                                        <div class="pro-group">
                                            {!! $product->short_desc_en !!}
                                        </div>
                                    @endif




                                    <div class="pro-group">
                                        {{-- <h6 class="product-title">{{ __('Delivery option') }}</h6> --}}
                                        <ul class="delivery-services">
                                            <li>
                                                <img src="{{ asset('assets/icons/tabby.png') }}" 
                                                    alt="{{__('dashboard.tabby_payment') }}" class="icon-class">
                                                    <br><br>
                                                    {{__('dashboard.tabby_payment') }}
                                                    
                                                    
                                            </li>
                                            <li>
                                                <img src="{{ asset('assets/icons/pay.png') }}"
                                                alt="{{__('dashboard.secure_payment') }}" class="icon-class">
                                                <br><br>
                                                {{__('dashboard.secure_payment') }}
                                                

                                            </li>
                                            <li>
                                                <img src="{{ asset('assets/icons/delivery-truck.png') }}"
                                                 alt="{{__('dashboard.cash_on_delivery') }}" class="icon-class">
                                                <br><br>
                                                {{__('dashboard.cash_on_delivery') }}
                                                
                                            </li>
                                            <li>
                                                <img src="{{ asset('assets/icons/cash-del.png') }}"
                                                alt=" {{__('dashboard.delivery_all_uae') }}" class="icon-class">
                                                <br><br>
                                                {{__('dashboard.delivery_all_uae') }}
                                                
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 collection-filter">
                        <!-- <div class="collection-filter-block creative-card creative-inner">
                                                                <div class="collection-mobile-back">
                                                                    <span class="filter-back">
                                                                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                                                                        back
                                                                    </span>
                                                                </div>
                                                                <div class="collection-collapse-block border-0 open">
                                                                    <h3 class="collapse-block-title">brand</h3>
                                                                    <div class="collection-collapse-block-content">
                                                                        <div class="collection-brand-filter">
                                                                            <ul class="category-list">
                                                                                <li><a href="javascript:void(0)">clothing</a></li>
                                                                                <li><a href="javascript:void(0)">bags</a></li>
                                                                                <li><a href="javascript:void(0)">footwear</a></li>
                                                                                <li><a href="javascript:void(0)">watches</a></li>
                                                                                <li><a href="javascript:void(0)">accessories</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> -->


                        {{-- <div class="pro-group">
                                        <ul class="delivery-services">
                                            <li>
                                                <img src="{{ asset('assets/icons/tabby.png') }}" style="height: 43px;" alt="{{__('dashboard.tabby_payment') }}" class="icon-class">
                                                <br><br>
                                                {{__('dashboard.tabby_payment') }}
                                            </li>
                                            <li>
                                                <img src="{{ asset('assets/icons/pay.svg') }}" style="height: 43px;" alt="{{__('dashboard.secure_payment') }}" class="icon-class">
                                                <br><br>
                                                 {{__('dashboard.secure_payment') }}
                                            </li>
                                            <li>
                                                <img src="{{ asset('assets/icons/delivery-truck.svg') }}" style="height: 43px;" alt="{{__('dashboard.cash_on_delivery') }}" class="icon-class">
                                                <br><br>
                                                 {{__('dashboard.cash_on_delivery') }}
                                            </li>
                                            <li>
                                                <img src="{{ asset('assets/icons/cash-del.svg') }}" style="height: 43px;" alt="{{__('dashboard.delivery_all_uae') }}" class="icon-class">
                                                <br><br>
                                                {{__('dashboard.delivery_all_uae') }}
                                            </li>
                                        </ul>
                                    </div> --}}

                        {{-- <div class="collection-filter-block creative-card creative-inner">
                            <div class="product-service">
                                <div class="media">
                                    <img src="{{ asset('assets/icons/microscope.svg') }}" alt="{{ __('dashboard.honey_tested') }}" class="icon-class">
                                    <div class="media-body">
                                        <h4>{{ __('dashboard.honey_tested') }}</h4>
                                        <p>{{ __('dashboard.honey_tested_description') }}</p>
                                    </div>
                                </div>
                                
                                <div class="media">
                                    <img src="{{ asset('assets/icons/energy.svg') }}" alt="{{ __('dashboard.energy_boost') }}" class="icon-class">
                                    <div class="media-body">
                                        <h4>{{ __('dashboard.energy_boost') }}</h4>
                                        <p>{{ __('dashboard.energy_boost_description') }}</p>
                                    </div>
                                </div>
                                
                                <div class="media">
                                    <img src="{{ asset('assets/icons/shield.svg') }}" alt="{{ __('dashboard.antioxidant_properties') }}" class="icon-class">
                                    <div class="media-body">
                                        <h4>{{ __('dashboard.antioxidant_properties') }}</h4>
                                        <p>{{ __('dashboard.antioxidant_properties_description') }}</p>
                                    </div>
                                </div>
                                
                                <div class="media border-0 m-0">
                                    <img src="{{ asset('assets/icons/bee.svg') }}" alt="{{ __('dashboard.pure_honey') }}" class="icon-class">
                                    <div class="media-body">
                                        <h4>{{ __('dashboard.pure_honey') }}</h4>
                                        <p>{{ __('dashboard.pure_honey_description') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="collection-filter-block creative-card creative-inner">
                            <div class="product-service">
                                <div class="media">
                                    <img src="{{ asset('assets/icons/microscope.svg') }}" style="height: 43px;"
                                        alt="{{__('dashboard.honey_tested') }}" class="icon-class">
                                    <div class="media-body">
                                        <h4 class="mt-2"> {{__('dashboard.honey_tested') }} </h4>
                                        {{-- <p> العسل الذي تم اختباره في مختبرات معتمدة للتحقق من جودته ونقائه.</p> --}}
                                    </div>
                                </div>
                                <div class="media">
                                    <img src="{{ asset('assets/icons/energy.svg') }}" style="height: 43px;"
                                        alt="{{__('dashboard.energy_boost') }}" class="icon-class">
                                    <div class="media-body">
                                        <h4 class="mt-2"> {{__('dashboard.energy_boost') }} </h4>
                                        {{-- <p>منتج يساعد في زيادة مستوى الطاقة في الجسم بشكل طبيعي دون الحاجة للمواد الكيميائية.</p> --}}
                                    </div>
                                </div>
                                <div class="media">
                                    <img src="{{ asset('assets/icons/shield.svg') }}" style="height: 43px;"
                                        alt="{{__('dashboard.antioxidant_properties') }}" class="icon-class">
                                    <div class="media-body">
                                        <h4 class="mt-2">{{__('dashboard.antioxidant_properties') }}</h4>
                                        {{-- <p>تساعد في حماية الخلايا من الأضرار الناتجة عن الجذور الحرة</p> --}}
                                    </div>
                                </div>
                                <div class="media border-0 m-0">
                                    <img src="{{ asset('assets/icons/bee.svg') }}" style="height: 43px;"
                                        alt=" {{__('dashboard.pure_honey') }}" class="icon-class">
                                    <div class="media-body">
                                        <h4 class="mt-2"> {{__('dashboard.pure_honey') }}</h4>
                                        {{-- <p>خالٍ تمامًا من المواد الصناعية أو الإضافات من المواد الكيميائيه و الصناعيه</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                            .icon-class {
                                width: 45px;
                                height: 35px;
                            }
                        </style>
                        <!-- side-bar single product slider start -->
                        <livewire:new-products />
                        <!-- side-bar single product slider end -->
                    </div>


                    <section class="tab-product tab-exes creative-card creative-inner">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="top-home-tab"
                                            data-bs-toggle="tab" href="#top-home" role="tab" aria-selected="true"><i
                                                class="icofont icofont-ui-home"></i>{{ __('Description') }}</a>
                                        <div class="material-border"></div>
                                    </li>
                                    {{--                                        <li class="nav-item"><a class="nav-link" id="profile-top-tab" --}}
                                    {{--                                                                data-bs-toggle="tab" href="#top-profile" role="tab" --}}
                                    {{--                                                                aria-selected="false"><i --}}
                                    {{--                                                    class="icofont icofont-man-in-glasses"></i>Details</a> --}}
                                    {{--                                            <div class="material-border"></div> --}}
                                    {{--                                        </li> --}}
                                    <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab"
                                            href="#top-contact" role="tab" aria-selected="false"><i
                                                class="icofont icofont-contacts"></i>{{ __('Video') }}</a>
                                        <div class="material-border"></div>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" id="review-top-tab" data-bs-toggle="tab"
                                            href="#top-review" role="tab" aria-selected="false"><i
                                                class="icofont icofont-contacts"></i>{{ __('Write Review') }}</a>
                                        <div class="material-border"></div>
                                    </li>
                                </ul>
                                <div class="tab-content nav-material" id="top-tabContent">
                                    <div class="tab-pane fade show active" id="top-home" role="tabpanel"
                                        aria-labelledby="top-home-tab">
                                        {!! app()->getLocale() == 'ar' ? $product->description_ar : $product->description_en !!}
                                    </div>
                                    <div class="tab-pane fade" id="top-contact" role="tabpanel"
                                        aria-labelledby="contact-top-tab">
                                        <div class="mt-3 text-center">
                                            @php
                                                $videoUrl = $product->video;
                                                $videoId = null;

                                                // Check for YouTube URL patterns
                                                if (strpos($videoUrl, 'youtube.com/watch?v=') !== false) {
                                                    parse_str(parse_url($videoUrl, PHP_URL_QUERY), $queryParams);
                                                    $videoId = $queryParams['v'] ?? null;
                                                } elseif (strpos($videoUrl, 'youtu.be/') !== false) {
                                                    $videoId = basename($videoUrl);
                                                }

                                                // Construct the embed URL
                                                $embedUrl = $videoId ? 'https://www.youtube.com/embed/' . $videoId : '';
                                            @endphp

                                            @if ($embedUrl)
                                                <iframe width="560" height="315" src="{{ $embedUrl }}"
                                                    allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                            @else
                                                <p>{{ __('No Video') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    @livewire('review-form', ['product_id' => $product->id])

                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Section ends -->

    <!-- related products -->
    <section class="section-big-py-space  ratio_asos b-g-light">
        <div class="custom-container">
            <div class="row">
                <div class="col-12 product-related">
                    <h2>{{ __('related products') }}</h2>
                </div>
            </div>
            <livewire:related-product :productId="$product->id" />
        </div>
    </section>

    <div class="modal fade bd-example-modal-lg theme-modal" id="order-now" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content quick-view-modal">
                <div class="modal-body">
                    <div class="cart_top text-center"> <!-- Centering the title -->
                        <h3>{{ __('Order now') }}</h3>
                    </div>
                    <div class="theme-form">
                        <div class="form-group">
                            <form class="theme-form" action="{{ route('web.place.order', $product->slug) }}"
                                method="post" id="addForm">
                                @csrf
                                @method('POST')

                                <!-- Start of Form Row -->
                                <div class="row">
                                    <input type="hidden" value="{{ $product->id }}">
                                    <!-- First Name -->
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name">{{ __('First Name') }}</label>
                                        <input type="text" name="first_name" class="form-control" id="first_name"
                                            placeholder="{{ __('First Name') }}">
                                        <label id="checkout_first_name" class="error_sms" style="display: none"></label>
                                    </div>

                                    <!-- Last Name -->
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name">{{ __('Last Name') }}</label>
                                        <input type="text" name="last_name" class="form-control" id="last_name"
                                            placeholder="{{ __('Last Name') }}">
                                        <label id="checkout_last_name" class="error_sms" style="display: none"></label>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-6 mb-3">
                                        <label for="phone">{{ __('Phone Number') }}</label>
                                        <input type="text" name="phone" class="form-control" id="phone"
                                            placeholder="{{ __('Phone Number') }}">
                                        <label id="checkout_phone" class="error_sms" style="display: none"></label>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6 mb-3">
                                        <label for="email">{{ __('Email') }}</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="{{ __('Email') }}">
                                        <label id="checkout_email" class="error_sms" style="display: none"></label>
                                        <label id="checkout_email" class="error_sms" style="display: none"></label>
                                    </div>

                                    <!-- Country -->
                                    <div class="col-md-6 mb-3">
                                        <label for="country">{{ __('dashboard.Country') }}</label>
                                        <input type="text" name="country" class="form-control" id="country"
                                            placeholder="{{ __('dashboard.Country') }}">
                                        <label id="checkout_country" class="error_sms" style="display: none"></label>
                                    </div>

                                    <!-- emirate -->
                                    <div class="col-md-6 mb-3">
                                        <label for="emirate">{{ __('dashboard.emirate') }}</label>
                                        <input type="text" name="emirate" class="form-control" id="emirate"
                                            placeholder="{{ __('dashboard.emirate') }}">
                                        <label id="checkout_emirate" class="error_sms" style="display: none"></label>
                                    </div>


                                    <!-- Street Address -->
                                    <div class="col-md-6 mb-3">
                                        <label for="street_address">{{ __('Street Address') }}</label>
                                        <input type="text" name="street_address" class="form-control"
                                            id="street_address" placeholder="{{ __('Street Address') }}">
                                        <label id="checkout_street_address" class="error_sms"
                                            style="display: none"></label>

                                    </div>

                                    <!-- region -->
                                    <div class="col-md-6 mb-3">
                                        <label for="region">{{ __('dashboard.region') }}</label>
                                        <input type="text" name="region" class="form-control" id="region"
                                            placeholder="{{ __('dashboard.region') }}">
                                        <label id="checkout_region" class="error_sms" style="display: none"></label>
                                    </div>

                                    <!-- Zip Code -->
                                    {{-- <div class="col-md-6 mb-3">
                                        <label for="zip_code">{{ __('Postal Code') }}</label>
                                        <input type="text" name="postal_code" class="form-control" id="postal_code"
                                            placeholder="{{ __('Postal Code') }}">
                                        <label id="checkout_postal_code" class="error_sms" style="display: none"></label>
                                    </div> --}}

                                    <div class="col-md-6 mb-3">
                                        <label for="zip_code">{{ __('Quantity') }}</label>
                                        <select type="text" name="quantity" class="form-control" id="quantity"
                                            placeholder="{{ __('Quantity') }}">
                                            @for ($i = 1; $i <= 20; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <label id="checkout_quantity" class="error_sms" style="display: none"></label>
                                    </div>

                                    <!-- Total amount -->
                                    <div class="col-md-6 mb-3">
                                        <label for="zip_code">{{ __('Total amount') }}</label>
                                        <input type="text" name="total" class="form-control" id="total"
                                            value="{{ $product->final_price }}" disabled>
                                        <input type="hidden" id="product-price" value="{{ $product->final_price }}">
                                    </div>

                                </div>
                                <!-- End of Form Row -->

                                <!-- Submit Button -->
                                <div class="text-center mt-4">
                                    <button id="order_button" type="submit" class="btn btn-solid btn-md btn-block">
                                        {{ __('Order now') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById('orders').addEventListener('click', function(event) {
            // Fire the Facebook Pixel 'InitiateCheckout' event
            fbq('track', 'InitiateCheckout', {
                content_ids: '{{ $product->id }}',
                content_type: 'product',
                value: {{ $product->price }},
                currency: 'AED',
                num_items: 1
            });
            ttq.track('InitiateCheckout', {
                value: '{{ $product->price }}',
                currency: 'AED'
            });

            // Let the modal still open by not preventing the default behavior
            // You don't need to prevent the default behavior because the modal uses Bootstrap's data attributes
        });
    </script>

    <script>
        fbq('track', 'ViewContent', {
            content_name: '{{ $product->name_ar }}',
            content_ids: ['{{ $product->id }}'],
            content_type: 'product',
            value: '{{ $product->price }}',
            currency: 'AED'
        });

        ttq.track('ViewContent', {
            content_name: '{{ $product->name_ar }}',
            content_id: '{{ $product->id }}',
            content_type: 'product',
            value: '{{ $product->price }}',
            currency: 'AED'
        });
        gtag('event', 'view_item', {
            items: [{
                item_id: '{{ $product->id }}', // Dynamic product ID
                item_name: '{{ $product->name }}', // Dynamic product name
                price: {{ $product->price }},
                item_category: 'Category Name'
            }]
        });
    </script>

    <script>
        document.getElementById('cartEffect').addEventListener('click', function() {

            fbq('track', 'AddToCart', {
                content_name: '{{ $product->name_ar }}',
                content_ids: ['{{ $product->id }}'],
                content_type: 'product',
                value: '{{ $product->price }}',
                currency: 'AED'
            });
            ttq.track('AddToCart', {
                content_name: '{{ $product->name_ar }}',
                content_id: '{{ $product->id }}',
                content_type: 'product',
                value: '{{ $product->price }}',
                currency: 'AED'
            });

        });
    </script>
    <!--<script>
        -- >
        <
        !--document.getElementById('withlistEffect').addEventListener('click', function() {
            -- >
            <
            !--fbq('track', 'AddToWishlist', {
                -- >
                <
                !--content_name: '{{ $product->name_en }}',
                -- >
                <
                !--content_ids: ['{{ $product->id }}'],
                -- >
                <
                !--content_type: 'product',
                -- >
                <
                !--value: '{{ $product->price }}',
                -- >
                currency: 'AED' // Change this as needed
                    <
                    !--
            });
            -- >
            <
            !--
        });
        -- >
        <
        !--
    </script>-->

    <script>
        $(document).ready(function() {

            var inputs = [
                'first_name',
                'last_name',
                'phone',
                'email',
                'country',
                'emirate',
                'street_address',
                'region',
                'quantity',
            ];


            $('#order_button').click(function(e) {
                e.preventDefault();
                var url = $('#addForm').attr('action');
                var form_data = $('#addForm').get(0);

                $('.error_sms').hide();

                $('#order_button').attr('disabled', 'disabled');
                $('#order_button').text('').append(
                    '<span class="spinner-border spinner-border-lg" role="status" aria-hidden="true"></span>'
                );

                for (var i = 0; i < inputs.length; i++) {
                    $('.input_' + inputs[i] + '').css('border', '');
                }

                $.ajax({
                    url: url,
                    type: 'post',
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: new FormData(form_data),
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $("#sucsess-modal").modal("show");
                        var url = data.url;
                        if (url) {
                            setTimeout(function() {
                                window.location = url;
                            }, 3000); // 3000 milliseconds = 8 seconds
                        }
                    },
                    error: function(data) {
                        var error = data.responseJSON.errors;
                        $('#order_button').removeAttr('disabled');
                        $('#order_button').text('').append('{{ __('Order now') }}');

                        for (var i = 0; i < inputs.length; i++) {
                            if (error.hasOwnProperty(inputs[i])) {
                                $('#checkout_' + inputs[i] + '').text('').append(
                                    '<i class="error_fontawai fa fa-exclamation-circle" style="float:right;padding: 5px"></i>' +
                                    error[inputs[i]] + '');
                                $('#checkout_' + inputs[i] + '').show();
                                $('.input_' + inputs[i] + '').css('border', '1px solid red')
                                    .css('margin-bottom', 0);

                            }
                        }
                    }
                });
            });
        });
    </script>
    <!-- related products -->
    <script>
        // Get the sale start and end dates from the Blade variables
        var saleStartDate = new Date("{{ $product->sale_start_date }}").getTime();
        var saleEndDate = new Date("{{ $product->sale_end_date }}").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();
            // Find the distance between now and the sale end date
            var distance = saleEndDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);


            // Output the result in an element with id="demo"
            var ContentElement = document.getElementById('demo');
            ContentElement.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";


            // If the countdown is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function updateTotalAmount() {
                // Get quantity and product price
                var quantity = document.getElementById('quantity').value;
                var price = document.getElementById('product-price').value;

                // Calculate the total amount
                var totalAmount = quantity * price;

                // Check if total is less than 500 and add shipping fee
                var shippingFee = 0;
                var shippingMessage = "";

                if (totalAmount < 500) {
                    shippingFee = 25; // Add shipping fee
                    shippingMessage = "Shipping fee of 25 AED is applied as the total is less than 500 AED.";
                }

                // Update the total including shipping fee
                var finalTotal = totalAmount + shippingFee;
                document.getElementById('total').value = finalTotal + " AED";

                // Display the shipping fee message (if applicable)
                var messageElement = document.getElementById('shipping-fee-message');
                if (!messageElement) {
                    // Create the message element if it doesn't exist
                    messageElement = document.createElement("p");
                    messageElement.id = "shipping-fee-message";
                    messageElement.style.color = "red";
                    document.getElementById('addForm').appendChild(messageElement);
                }

                // Update the message content
                messageElement.innerHTML = shippingMessage;
            }

            // Attach the event listener to the quantity select field
            document.getElementById('quantity').addEventListener('change', updateTotalAmount);

            // Call the function initially to set the total for default quantity (1) on page load
            updateTotalAmount();
        });
    </script>


    @if (session()->has('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

@endpush
