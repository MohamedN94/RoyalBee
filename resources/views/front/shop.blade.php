@extends('front.layouts.app')
@push('styles')
    <style>
        .price{
            color: #84b213;
            font-size: calc(12px + (14 - 12) * ((100vw - 320px) / (1920 - 320)));
            font-weight: 700;
        }
    </style>
@endpush
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-main ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-contain">
                        <div>
                            <h2>category</h2>
                            <ul>
                                <li><a href="{{route('web.home')}}">home</a></li>
                                <li><i class="fa fa-angle-double-right"></i></li>
                                <li><a href="javascript:void(0)">category</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!-- section start -->
    <section class="section-big-pt-space ratio_asos b-g-light">
        <div class="collection-wrapper">
            <div class="custom-container">
                <div class="row">
                    <div class="col-sm-3 collection-filter category-page-side">
                        <!-- side-bar colleps block stat -->
                        <div class="collection-filter-block creative-card creative-inner category-side">
                            <!-- brand filter start -->
                            <div class="collection-mobile-back">
                                <span class="filter-back"><i class="fa fa-angle-left"
                                                             aria-hidden="true"></i> back</span></div>

                            <!-- price filter start here -->
                            <div class="collection-collapse-block border-0 open">
                                <h3 class="collapse-block-title">price</h3>
                                <div class="collection-collapse-block-content">
                                    <div class="filter-slide">
                                        <input class="js-range-slider" type="text" name="my_range" value=""
                                               data-type="double"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- silde-bar colleps block end here -->
                        <!-- side-bar single product slider start -->
                        <livewire:new-products/>
                        <!-- side-bar single product slider end -->
                        <!-- side-bar banner start here -->
{{--                        <div class="collection-sidebar-banner">--}}
{{--                            <a href="javascript:void(0)"><img src="{{asset('front/images/category/side-banner.png')}}"--}}
{{--                                                              class="img-fluid " alt=""></a>--}}
{{--                        </div>--}}
                        <!-- side-bar banner end here -->

                    </div>
                    <div class="collection-content col">
                        <div class="page-main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="top-banner-wrapper">
                                        <a href="#"><img
                                                src="{{asset($category->banner_image)}}" class="img-fluid " alt=""></a>
                                        <div class="top-banner-content small-section">
                                            <h4>{{$category->name_en}}</h4>
                                            {!! $category->description_en !!}
                                        </div>
                                    </div>
                                    <livewire:product-filter :category="$category->id"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section End -->
@endsection
