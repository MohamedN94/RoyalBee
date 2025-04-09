@extends('front.layouts.app')
@push('styles')
    <style>
        .price {
            color: #84b213;
            font-size: calc(12px + (14 - 12) * ((100vw - 320px) / (1920 - 320)));
            font-weight: 700;
        }
    </style>
@endpush
@section('content')
{{--    <!-- breadcrumb start -->--}}
{{--    <div class="breadcrumb-main ">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col">--}}
{{--                    <div class="breadcrumb-contain">--}}
{{--                        <div>--}}
{{--                            <h2>{{__('Category')}}</h2>--}}
{{--                            <ul>--}}
{{--                                <li><a href="{{route('web.home')}}">{{__('Home')}}</a></li>--}}
{{--                                <li><i class="fa fa-angle-double-right"></i></li>--}}
{{--                                <li><a href="javascript:void(0)">{{__('Category')}}</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- breadcrumb End -->--}}


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
                                                             aria-hidden="true"></i> {{__('back')}}</span></div>

                            <!-- price filter start here -->
                            <div class="collection-collapse-block border-0 open">
                                <h3 class="collapse-block-title">{{__('price')}}</h3>
                                <div class="collection-collapse-block-content">
                                    <div class="filter-slide">
                                        <input class="js-range-slider" type="text" name="my_range" value=""
                                               data-type="double"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <livewire:new-products/>


                    </div>
                    <div class="collection-content col">
                        <div class="page-main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <livewire:search :category="$category" :query="$query"
                                                             :products="$products"/>

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
