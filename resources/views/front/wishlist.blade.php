@extends('front.layouts.app')
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-main ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-contain">
                        <div>
                            <h2>wishlist</h2>
                            <ul>
                                <li><a href="{{route('web.home')}}">home</a></li>
                                <li><i class="fa fa-angle-double-right"></i></li>
                                <li><a href="javascript:void(0)">wishlist</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->
    @if($wishlists->count())
        <!--section start-->
        <livewire:wishlists/>

    @else
        <div class="cart-empty text-center">
            <div class="cart-empty__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="480px" height="200px" viewBox="0 0 480 438" version="1.1">
                    <!-- Heart shape for the wishlist -->
                    <path fill="#E74C3C" d="M240 420l-35.4-35.6C92.6 289.2 40 242.7 40 168.8 40 113.7 83.7 70 138.8 70c33.4 0 65 17.6 83.2 44.6C240.2 87.6 271.8 70 305.2 70 360.3 70 404 113.7 404 168.8c0 73.9-52.6 120.4-164.6 215.6L240 420z"></path>

                </svg>
            </div>
            <h2 class="cart-empty__title">{{__('Your wishlist is currently empty.')}}</h2>
            <p class="cart-empty__text">{{__('You may check out all the available products and buy some in the shop.')}}</p>
            <a href="{{route('web.home')}}"
               class="cart-empty__btn btn btn-primary btn-hover-secondary mt-4"
               style="margin-right: 48px;">{{__('Return to shop')}}</a>
        </div>
    @endif

    <!--section end-->
@endsection
