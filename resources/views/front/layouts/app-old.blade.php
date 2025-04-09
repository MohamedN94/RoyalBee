<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{__('Royal bee')}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="big-deal">
    <meta name="keywords" content="big-deal">
    <meta name="author" content="big-deal">
    <link rel="icon" href="{{asset('front/images/favicon/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('front/images/favicon/favicon.png')}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

    <!--icon css-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('front/css/themify.css')}}">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/slick-theme.css')}}">
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap" rel="stylesheet">

    <!--Animate css-->
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/animate.css')}}">
    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/noty/noty.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{asset('assets/plugins/toaster/toast.min.css')}}">
    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/color6.css')}}" media="screen" id="color">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css"
          integrity="sha512-B46MVOJpI6RBsdcU307elYeStF2JKT87SsHZfRSkjVi4/iZ3912zXi45X5/CBr/GbCyLx6M1GQtTKYRd52Jxgw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/ie7/ie7.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/css/themify-icons.min.css">
    <style>
        .toast-success {
            background-color: #28a745 !important;
            /* Change background color */
            color: #fff !important;
            /* Change text color */
            border-radius: 5px !important;
            /* Change border radius */
            font-size: 16px !important;
            /* Change font size */
        }

        .toast-success .toast-message {
            font-style: italic !important;
            font-weight: bold !important;
            /* Change message font style */
        }

        .btn-default {
            background-color: transparent;
            border: none;
            padding: 0;
            margin: 0;
            font-size: 16px;
        }

        .input-group .btn {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .text-danger {
            color: red;
        }

        .text-muted {
            color: gray;
        }

        .product-image {
            width: 144px;
            height: auto;
        }

        .discount-price {
            color: #f97c2d;
            font-weight: 700;
            margin-top: 3px;
        }

        .original-price {
            color: #444444;
            text-decoration: none;
            font-weight: 500;
        }

        .rating i {
            font-size: 24px;
            color: #e4e5e9;
            cursor: pointer;
        }

        .rating i.text-warning {
            color: #FFD700;

        }

        .search-btn {
            border: none;
            background: none;
            padding: 0;
            margin: 0;
            font-size: inherit;
            color: inherit;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
        }

        .search-btn:hover {
            color: #555;
        }

        .search-btn i {
            font-size: 16px;
        }

        .search-btn:focus {
            outline: none;
        }



    .slick-prev,
    .slick-arrow {
        display: none !important;
    }

    .icon-nav , .icon-block {
        z-index: 10;
        margin-left: 4px!important;

        ul {
            display: flex;
            align-items: center;
            li {
                margin: 0px 9px !important ;
            }
        }
    }

    .icon-block .mobile-search,
    .icon-block .mobile-setting,
    .icon-block .mobile-user {
        position: inherit !important;
    }

    .icon-block .mobile-search svg,
    .icon-block .mobile-wishlist svg,
    .icon-block .mobile-cart svg,
    .icon-block .mobile-setting svg,
    .icon-block .mobile-user svg {
        fill: #999999 !important;
    }

    .mobile-fix-option{
        display: none;
    }

    .language-dropdown {
        position: relative;
    }

    .mobile-setting .language-dropdown-open {
        background-color: #ececec;
        -webkit-box-shadow: 0 0 1px 0 #dddddd;
        box-shadow: 0 0 1px 0 #dddddd;
        position: absolute;
        top: 100%;
        right: 0;
        left: unset;
        z-index: 11;
        flex-direction: column;
        border-radius: 10%
    }

    .mobile-setting .language-dropdown-open li {
        display: block;
        padding: 6px 5px;
        margin-top: 8px;
        margin: 10px 0px;
    }

    .mobile-setting img {
        margin: 10px 0px;
        border-radius: 20%;
    }



    @media (max-width: 576px) {
        .rtl .tab-product-main .tab-prodcut-contain ul li:nth-child(n+2) {
            margin-right: 0 !important;
        }

        .logo-sm-center {
            right: 0 !important;
        }

        .icon-block .mobile-wishlist {
            right: 0!important;
        }
        .icon-block .mobile-cart {
            right: 0!important;
        }

        .item-count-contain {
            display: none!important;
        }

        .icon-nav , .icon-block ul li {
            margin: 0px 4px !important;
        }

         .icon-block .mobile-wishlist,
         .icon-block .mobile-cart  {
            position: inherit !important;
        }

    }


    </style>
    @stack('styles')
    @livewireStyles
</head>

<body class="bg-light @if (app()->getLocale() == 'ar') rtl @endif">

<!-- loader start -->
<div class="loader-wrapper">
    <div>
        <img src="{{asset('front/images/vagitable-loader.gif')}}" alt="loader" class="img-fluid">
    </div>
</div>
<!-- loader end -->

<!--header start-->
<header id="stickyheader">
    <div class="mobile-fix-option"></div>
    <div class="top-header" dir="ltr">
        <div class="custom-container">
            <div class="row">
                <div class="col-xl-5 col-md-7 col-sm-6">
                    <div class="top-header-left">
                        {{-- <div class="shpping-order">
                            <h6>{{__('free shipping on order over')}} $99 </h6>
                        </div>
                        <div class="app-link">
                            <h6>
                                {{__('Download aap')}}
                            </h6>
                            <ul>
                                <li><a><i class="fa fa-apple"></i></a></li>
                                <li><a><i class="fa fa-android"></i></a></li>
                                <li><a><i class="fa fa-windows"></i></a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
                <div class="col-xl-7 col-md-5 col-sm-6">
                    <div class="top-header-right">
                        {{-- <div class="top-menu-block">
                            <ul>
                                <li><a href="javascript:void(0)">gift cards</a></li>
                                <li><a href="javascript:void(0)">Notifications</a></li>
                                <li><a href="javascript:void(0)">help & contact</a></li>
                                <li><a href="javascript:void(0)">todays deal</a></li>
                                <li><a href="javascript:void(0)">track order</a></li>
                                <li><a href="javascript:void(0)">shipping</a></li>
                                <li><a href="javascript:void(0)">easy returns</a></li>
                            </ul>
                        </div> --}}
                        <div class="language-block">
                            <div class="language-dropdown">
                                    <span class="language-dropdown-click">
                                        {{ app()->getLocale() == 'en' ? 'English' : 'Arabic' }} <i
                                            class="fa fa-angle-down" aria-hidden="true"></i>
                                    </span>
                                <ul class="language-dropdown-open">
                                    <li><a href="{{ url('/en') }}">english</a></li>
                                    <li><a href="{{ url('/ar') }}">arabic</a></li>
                                </ul>

                            </div>
                            {{-- <div class="curroncy-dropdown">
                                <span class="curroncy-dropdown-click">
                                    usd<i class="fa fa-angle-down" aria-hidden="true"></i>
                                </span>
                                <ul class="curroncy-dropdown-open">
                                    <li><a href="javascript:void(0)"><i class="fa fa-inr"></i>inr</a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-usd"></i>usd</a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-eur"></i>eur</a></li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="layout-header1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-menu-block">
                        <div class="menu-left">
                            {{-- <div class="sm-nav-block">
                                <span class="sm-nav-btn"><i class="fa fa-bars"></i></span>
                                <ul class="nav-slide">
                                    <li>
                                        <div class="nav-sm-back">
                                            back <i class="fa fa-angle-right ps-2"></i>
                                        </div>
                                    </li>
                                    @foreach($collections as $collection)
                                    <li><a href="#">{{$collection->name_en}}</a></li>
                                    @endforeach

                                </ul>
                            </div> --}}
                            <div class="brand-logo logo-sm-center">
                                <a href="{{route('web.home')}}">
                                    @php $logo = str_replace('\\/', '/', setting('logo') ); @endphp
                                    <img src="{{asset($logo)}}" style="width: 147px" alt="logo-header">
                                </a>
                            </div>
                        </div>

                        <div class="menu-block">
                            <nav id="main-nav">
                                <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                    <li>
                                        <div class="mobile-back text-right">Back<i class="fa fa-angle-right ps-2"
                                                                                   aria-hidden="true"></i></div>
                                    </li>
                                    <!--HOME-->
                                    <li>
                                        <a class="dark-menu-item" href="{{route('web.home')}}">{{__('Home')}}</a>
                                    </li>
                                    <!--HOME-END-->
                                    <!--SHOP-->
                                    <li>
                                        <a class="dark-menu-item" href="{{route('web.search')}}">{{__('shop')}}</a>
                                    </li>

                                    <li>
                                        <a class="dark-menu-item" href="{{route('web.about')}}">{{__('About us')}}</a>
                                    </li>
                                    <li>
                                        <a class="dark-menu-item" href="{{route('web.home')}}">{{__('Blog')}}</a>
                                    </li>
                                    <li>
                                        <a class="dark-menu-item"
                                           href="{{route('web.contact')}}">{{__('Contact us')}}</a>
                                    </li>

                                </ul>
                            </nav>
                        </div>

                        <div class="menu-right">
                            <div class="icon-nav icon-block">
                                <ul>
                                    <li class="mobile-search">
                                        <a href="javascript:void(0)">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="0 0 612.01 612.01"
                                                 style="enable-background:new 0 0 612.01 612.01;"
                                                 xml:space="preserve">
                                                    <g>
                                                        <g id="_x34__4_">
                                                            <g>
                                                                <path d="M606.209,578.714L448.198,423.228C489.576,378.272,515,318.817,515,253.393C514.98,113.439,399.704,0,257.493,0
                                                C115.282,0,0.006,113.439,0.006,253.393s115.276,253.393,257.487,253.393c61.445,0,117.801-21.253,162.068-56.586
                                                l158.624,156.099c7.729,7.614,20.277,7.614,28.006,0C613.938,598.686,613.938,586.328,606.209,578.714z M257.493,467.8
                                                c-120.326,0-217.869-95.993-217.869-214.407S137.167,38.986,257.493,38.986c120.327,0,217.869,95.993,217.869,214.407
                                                S377.82,467.8,257.493,467.8z"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                        </a>
                                    </li>
                                    <li class="mobile-user " onclick="openAccount()">
                                        <a href="javascript:void(0)">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                                 xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="M256,0c-74.439,0-135,60.561-135,135s60.561,135,135,135s135-60.561,135-135S330.439,0,256,0z M256,240
                                             c-57.897,0-105-47.103-105-105c0-57.897,47.103-105,105-105c57.897,0,105,47.103,105,105C361,192.897,313.897,240,256,240z"/>
                                                        </g>
                                                    </g>
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M297.833,301h-83.667C144.964,301,76.669,332.951,31,401.458V512h450V401.458C435.397,333.05,367.121,301,297.833,301z
                                             M451.001,482H451H61v-71.363C96.031,360.683,152.952,331,214.167,331h83.667c61.215,0,118.135,29.683,153.167,79.637V482z"/>
                                                    </g>
                                                </g>
                                                </svg>
                                        </a>
                                    </li>
                                    <li class="mobile-setting" onclick="">
                                        <div class="language-block">
                                            <div class="language-dropdown">
                                                <span class="language-dropdown-click">
                                                    @if (app()->getLocale() == 'en')
                                                        <img src="{{asset('assets/images/usa.png')}}" height="20" width="22" alt="en">
                                                    @else
                                                        <img src="{{asset('assets/images/ksa.png')}}" height="20" width="22" alt="en">
                                                    @endif
                                                    {{-- <i  class="fa fa-angle-down" aria-hidden="true"></i> --}}
                                                </span>
                                                <ul class="language-dropdown-open">
                                                    <li><a href="{{ url('/en') }}">
                                                        <img src="{{asset('assets/images/usa.png')}}" height="20" width="25" alt="en">
                                                    </a></li>
                                                    <li><a href="{{ url('/ar') }}">
                                                        <img src="{{asset('assets/images/ksa.png')}}" height="20" width="25" alt="en">
                                                    </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <livewire:wishlist-counter/>
                                    <livewire:cart-counter/>
                                </ul>
                            </div>
                            <div class="toggle-nav">
                                <i class="fa fa-bars sidebar-bar"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="searchbar-input">
            <div class="input-group">
                    <span class="input-group-text">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px" y="0px" width="28.931px" height="28.932px" viewBox="0 0 28.931 28.932"
                             style="enable-background:new 0 0 28.931 28.932;" xml:space="preserve">
                            <g>
                                <path
                                    d="M28.344,25.518l-6.114-6.115c1.486-2.067,2.303-4.537,2.303-7.137c0-3.275-1.275-6.355-3.594-8.672C18.625,1.278,15.543,0,12.266,0C8.99,0,5.909,1.275,3.593,3.594C1.277,5.909,0.001,8.99,0.001,12.266c0,3.276,1.275,6.356,3.592,8.674c2.316,2.316,5.396,3.594,8.673,3.594c2.599,0,5.067-0.813,7.136-2.303l6.114,6.115c0.392,0.391,0.902,0.586,1.414,0.586c0.513,0,1.024-0.195,1.414-0.586C29.125,27.564,29.125,26.299,28.344,25.518z M6.422,18.111c-1.562-1.562-2.421-3.639-2.421-5.846S4.86,7.983,6.422,6.421c1.561-1.562,3.636-2.422,5.844-2.422s4.284,0.86,5.845,2.422c1.562,1.562,2.422,3.638,2.422,5.845s-0.859,4.283-2.422,5.846c-1.562,1.562-3.636,2.42-5.845,2.42S7.981,19.672,6.422,18.111z"/>
                            </g>
                        </svg>
                    </span>
                <input type="text" class="form-control" placeholder="search your product">
                <span class="input-group-text close-searchbar">
                        <svg viewBox="0 0 329.26933 329" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"/>
                        </svg>
                    </span>
            </div>
        </div>
    </div>
    <div class="category-header">
        <div class="custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="navbar-menu">
                        <div class="category-left">
                            <div class=" nav-block">
                                <div class="nav-left">
                                    <nav class="navbar" data-bs-toggle="collapse"
                                         data-bs-target="#navbarToggleExternalContent">
                                        <button class="navbar-toggler" type="button">
                                            <span class="navbar-icon"><i class="fa fa-arrow-down"></i></span>
                                        </button>
                                        <h5 class="mb-0 ms-3 text-white title-font">{{__('Shop by category')}}</h5>
                                    </nav>

                                    <div class="collapse {{ request()->routeIs('web.home') ? 'show' : '' }} nav-desk"
                                         id="navbarToggleExternalContent">

                                        <ul class="nav-cat title-font">
                                            @foreach($collections as $collection)
                                                <li><a href="{{route('web.category.show',$collection->slug)}}"><img
                                                            src="{{asset($collection->image)}}" alt="catergory-product">
                                                        {{app()->getLocale() == 'ar' ? $collection->name_ar :
                                                        $collection->name_en}}
                                                    </a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="input-box">
                                    <form class="big-deal-form" action="{{route('web.search')}}" method="GET">
                                        <div class="input-group">
                                            <button type="submit" class="search-btn px-2"><i class="fa fa-search"></i>
                                            </button>
                                            <input type="text" name="query" class="form-control"
                                                   value="{{request('search')}}"
                                                   placeholder="{{ __('Search a Product') }}">
                                            <select name="category">
                                                <option disabled selected value="all">{{__('All Categories')}}</option>
                                                @foreach(\App\Models\Admin\Category::all() as $category)
                                                    <option
                                                        value="{{$category->id}}">
                                                        {{app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="category-right">
                            <div class="contact-block">
                                <div>
                                    <i class="fa fa-volume-control-phone"></i>
                                    <span>{{__('call us')}}<span>123-456-76890</span></span>
                                </div>
                            </div>
                            <div class="btn-group">
                                <div class="gift-block" data-bs-toggle="dropdown">
                                    <div class="grif-icon">
                                        <i class="icon-gift"></i>
                                    </div>
                                    <div class="gift-offer">
                                        <p>gift box</p>
                                        <span>Festivel Offer</span>
                                    </div>
                                </div>
                                <div class="dropdown-menu gift-dropdown">
                                    <div class="media">
                                        <div class="me-3">
                                            <img src="{{asset('front/images/icon/1.png')}}"
                                                 alt="Generic placeholder image">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">Billion Days</h5>
                                            <p><img src="{{asset('front/images/icon/currency.png')}}" class="cash"
                                                    alt="gift-block"> Flat Rs. 270 Rewards</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="me-3">
                                            <img src="{{asset('front/images/icon/2.png')}}"
                                                 alt="Generic placeholder image">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">Fashion Discount</h5>
                                            <p><img src="{{asset('front/images/icon/fire.png')}}" class="fire"
                                                    alt="gift-block">Extra 10% off (upto Rs. 10,000*) </p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="me-3">
                                            <img src="{{asset('front/images/icon/3.png')}}"
                                                 alt="Generic placeholder image">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">75% {{__('off Store')}}</h5>
                                            <p>{{__('No coupon code is required.')}}</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="me-3">
                                            <img src="{{asset('front/images/icon/6.png')}}"
                                                 alt="Generic placeholder image">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">{{__('Up to')}} 50% {{__('off')}}</h5>
                                            <p>{{__('Buy popular products under')}} 20 {{__('AED')}}</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="me-3">
                                            <img src="{{asset('front/images/icon/5.png')}}"
                                                 alt="Generic placeholder image">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">{{__('Beauty store')}}</h5>
                                            <p><img src="{{asset('front/images/icon/currency.png')}}" class="cash"
                                                    alt="curancy"> {{{__('Flat')}}} {{__('AED')}} 270
                                                {{__('Rewards')}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--header end-->

@yield('content')

<!-- subscribe start -->
<section class="subscribe1 mt-4">
    <img src="{{asset('front/images/marketplace/subscribe2.png')}}" alt="subscribe" class="bg-img img-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="subscribe-contain">
                    <div class="subscribe-left">
                        <div class="media">
                            <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                 xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path d="m0
                                    197.61v297.8l173.2-154.29z"></path>
                                    <path d="m26.47 512h466.2l-236.65-203.21c-61.813
                                    53.36-16.636 13.542-229.55 203.21z"></path>
                                    <path d="m66.4 144.81-48.28 28.85 48.28
                                    40.01z"></path>
                                    <path d="m195.95 321.02c28.701-24.77 26.492-22.863
                                    57.32-49.47h5.43c41.981 36.045 29.32 25.174 57.52 49.39 71.602-58.557
                                    14.234-11.633 99.38-81.27 0-9.221 0-228.158 0-239.67h-319.2v238.53c60.491
                                    50.123 60.988 50.541 99.55
                                    82.49zm-36.35-115.02v-30h192.8v30zm0-158h192.8v30h-192.8zm0
                                    64h192.8v30h-192.8c0-7.219 0-23.148 0-30z"></path>
                                    <path d="m445.6
                                    144.82v70.32l49.69-40.63z"></path>
                                    <path d="m339.33 340.78 172.67
                                    148.28v-289.46z"></path>
                                </g>
                            </svg>
                            <div class="media-body">
                                <h6>{{__('Sale Up To')}} 20% {{__('Off')}}

                                </h6>
                                <h3>{{__('join our newsletter')}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="subscribe-right">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="{{__('Enter Your Email')}}">
                            <div class="input-group-text">{{__('subscribe')}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- subscribe end -->


<!-- footer start -->
<footer>
    @php
        $quickLinks = \App\Models\Admin\Page::orderBy('order')->where('page_type_id' , 2)->get();
        $mainMenuPages = \App\Models\Admin\Page::orderBy('order')->where('page_type_id' , 3)->get();
    @endphp
    <div class="footer1 ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-main">
                        <div class="footer-box">
                            <div class="footer-title mobile-title">
                                <h5>{{__('about')}}</h5>
                            </div>
                            <div class="footer-contant">
                                <div class="footer-logo">
                                    <a href="{{route('web.home')}}">
                                        @php $logo = str_replace('\\/', '/', setting('logo') ); @endphp
                                        <img src="{{ asset($logo) }}" class="img-fluid" alt="logo">
                                    </a>
                                </div>
                                {!! app()->getLocale() == 'ar' ? setting('store_description') :
                                setting('store_description_en') !!}
                                <ul class="sosiyal">
                                    <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-rss"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-box">
                            <div class="footer-title">
                                <h5>{{__('Main Menu')}}</h5>
                            </div>
                            <div class="footer-contant">
                                <ul>
                                    @foreach($mainMenuPages as $mainMenuPage)
                                        <li>
                                            <a href="{{$mainMenuPage->url }}">{{app()->getLocale() == 'ar' ?
                                                $mainMenuPage->name_ar
                                                :$mainMenuPage->name_en}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="footer-box">
                            <div class="footer-title">
                                <h5>{{__('Quick links')}}</h5>
                            </div>
                            <div class="footer-contant">
                                <ul>
                                    @foreach($quickLinks as $quickLink)
                                        <li>
                                            <a href="{{$quickLink->url }}">{{app()->getLocale() == 'ar' ?
                                                $quickLink->name_ar
                                                : $quickLink->name_en}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="footer-box">
                            <div class="footer-title">
                                <h5></h5>
                            </div>
                            <div class="footer-contant">
                                {{-- <ul class="contact-list">--}}
                                {{-- <li><i class="fa fa-map-marker"></i>big deal store demo store <br>
                                    india-<span>3654123</span>--}}
                                {{-- </li>--}}
                                {{-- <li><i class="fa fa-phone"></i>call us: <span>123-456-7898</span></li>--}}
                                {{-- <li><i class="fa fa-envelope-o"></i>email us: support@bigdeal.com</li>--}}
                                {{-- <li><i class="fa fa-fax"></i>fax <span>123456</span></li>--}}
                                {{-- </ul>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="subfooter footer-border">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-8 col-sm-12">
                    <div class="footer-left">
                        {{-- <p>2019-20 Copy Right by Themeforest Powered by pixel strap</p> --}}
                    </div>
                </div>
                <div class="col-xl-6 col-md-4 col-sm-12">
                    <div class="footer-right">
                        <ul class="payment">
                            <li><a href="javascript:void(0)"><img src="{{asset('front/images/layout-1/pay/1.png')}}"
                                                                  class="img-fluid" alt="pay"></a></li>
                            <li><a href="javascript:void(0)"><img src="{{asset('front/images/layout-1/pay/2.png')}}"
                                                                  class="img-fluid" alt="pay"></a></li>
                            <li><a href="javascript:void(0)"><img src="{{asset('front/images/layout-1/pay/3.png')}}"
                                                                  class="img-fluid" alt="pay"></a></li>
                            <li><a href="javascript:void(0)"><img src="{{asset('front/images/layout-1/pay/4.png')}}"
                                                                  class="img-fluid" alt="pay"></a></li>
                            <li><a href="javascript:void(0)"><img src="{{asset('front/images/layout-1/pay/5.png')}}"
                                                                  class="img-fluid" alt="pay"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->


<!--Newsletter modal popup start-->
<div class="modal fade bd-example-modal-lg theme-modal" id="exampleModal" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="news-latter">
                    <div class="modal-bg">
                        <div class="newslatter-main">
                            <div class="offer-content">
                                <div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    <h2>{{__('newsletter')}}</h2>
                                    <p>{{__('Subscribe to our website mailling list')}}
                                        <br> {{__('and get a Offer, Just for you!')}}
                                    </p>
                                    <form
                                        action="https://pixelstrap.us19.list-manage.com/subscribe/post?u=5a128856334b598b395f1fc9b&amp;id=082f74cbda"
                                        class="auth-form needs-validation" method="post"
                                        id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                                        target="_blank">
                                        <div class="form-group mx-sm-3">
                                            <input type="email" class="form-control" name="EMAIL" id="mce-EMAIL"
                                                   placeholder="{{__('Enter your email')}}" required="required">
                                            <button type="submit" class="btn btn-theme btn-normal btn-sm "
                                                    id="mc-submit">{{__('subscribe')}}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="imd-wrraper">
                                <img src="{{asset('front/images/layout-6/product/2.jpg')}}" alt="newsletterimg"
                                     class="img-fluid bg-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Newsletter Modal popup end-->


<!-- Quick-view modal popup start-->
<div class="modal fade bd-example-modal-lg theme-modal" id="quick-view" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content quick-view-modal">
            <div class="modal-body">
                <input type="hidden" id="modal-product-id">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="quick-view-img">
                            <img src="" alt="product" id="product-image" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-6 rtl-text">
                        <div class="product-right">
                            <div class="pro-group">
                                <h2 id="product-name"></h2>
                                <ul class="pro-price">

                                    <li id="product-discount-price"></li>
                                    <li>
                                        <p id="product-price"></p>
                                    </li>
                                    <li id="discount-value"></li>
                                </ul>
                                <div class="revieu-box">
                                    <ul id="avg-review"></ul>
                                    <a>(<span id="reviews-count"></span> {{__('reviews')}} )</a>
                                </div>
                                <ul class="best-seller">
                                    <li id="best-seller-badge">
                                        <svg viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path
                                                    d="m102.427 43.155-2.337-2.336a3.808 3.808 0 0 1 -.826-4.149l1.263-3.053a3.808 3.808 0 0 0 -2.063-4.975l-3.036-1.256a3.807 3.807 0 0 1 -2.352-3.519v-3.286a3.808 3.808 0 0 0 -3.809-3.808h-3.3a3.81 3.81 0 0 1 -3.518-2.35l-1.269-3.052a3.808 3.808 0 0 0 -4.98-2.059l-3.032 1.258a3.807 3.807 0 0 1 -4.152-.825l-2.323-2.323a3.809 3.809 0 0 0 -5.386 0l-2.336 2.336a3.808 3.808 0 0 1 -4.149.826l-3.053-1.263a3.809 3.809 0 0 0 -4.975 2.063l-1.257 3.036a3.808 3.808 0 0 1 -3.519 2.353h-3.285a3.808 3.808 0 0 0 -3.809 3.808v3.3a3.808 3.808 0 0 1 -2.349 3.519l-3.053 1.266a3.809 3.809 0 0 0 -2.059 4.976l1.259 3.035a3.81 3.81 0 0 1 -.825 4.152l-2.324 2.323a3.809 3.809 0 0 0 0 5.386l2.337 2.337a3.807 3.807 0 0 1 .826 4.149l-1.263 3.056a3.808 3.808 0 0 0 2.063 4.975l3.036 1.256a3.807 3.807 0 0 1 2.352 3.519v3.286a3.808 3.808 0 0 0 3.809 3.808h3.3a3.809 3.809 0 0 1 3.518 2.35l1.265 3.052a3.808 3.808 0 0 0 4.984 2.059l3.035-1.259a3.811 3.811 0 0 1 4.152.825l2.323 2.324a3.809 3.809 0 0 0 5.386 0l2.336-2.336a3.81 3.81 0 0 1 4.149-.827l3.053 1.264a3.809 3.809 0 0 0 4.975-2.063l1.257-3.037a3.809 3.809 0 0 1 3.519-2.352h3.285a3.808 3.808 0 0 0 3.809-3.808v-3.3a3.808 3.808 0 0 1 2.349-3.518l3.053-1.266a3.809 3.809 0 0 0 2.059-4.976l-1.259-3.036a3.809 3.809 0 0 1 .825-4.151l2.324-2.324a3.809 3.809 0 0 0 -.003-5.39z"
                                                    fill="#f9cc4e"/>
                                                <circle cx="64" cy="45.848" fill="#4ec4b5" r="29.146"/>
                                                <path
                                                    d="m59.795 41.643 4.205-12.614 4.205 12.614h12.615l-8.41 8.41 4.205 12.615-12.615-8.41-12.615 8.41 4.205-12.615-8.41-8.41z"
                                                    fill="#f9cc4e"/>
                                                <path
                                                    d="m87.579 74.924h-1.6a3.809 3.809 0 0 0 -3.519 2.352l-1.257 3.037a3.809 3.809 0 0 1 -4.975 2.063l-3.053-1.264a3.81 3.81 0 0 0 -4.149.827l-2.336 2.336a3.809 3.809 0 0 1 -5.386 0l-2.323-2.324a3.811 3.811 0 0 0 -4.152-.825l-3.029 1.259a3.808 3.808 0 0 1 -4.977-2.059l-1.265-3.052a3.809 3.809 0 0 0 -3.518-2.35h-1.618l-17.417 35.386 17.255-5.872 5.872 17.256 17.868-36.304 17.868 36.3 5.872-17.256 17.26 5.876z"
                                                    fill="#f95050"/>
                                            </g>
                                        </svg>

                                        {{__('Best Seller')}}

                                    </li>
                                    {{-- <li>
                                        <svg enable-background="new 0 0 497 497" viewBox="0 0 497 497"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path
                                                    d="m329.63 405.42-.38.43c-10.048 19.522-48.375 35.567-80.775 35.607-24.881 0-53.654-9.372-71.486-20.681-5.583-3.54-2.393-10.869-6.766-15.297l19.149-5.13c3.76-1.22 6.46-4.54 6.87-8.47l8.574-59.02 82.641-2.72 12.241 28.06.837 8.668-1.844 9.951 3.456 6.744.673 6.967c.41 3.93 3.11 7.25 6.87 8.47z"
                                                    fill="#f2d1a5" />
                                                <path
                                                    d="m420.39 497h-343.78c-6.21 0-7.159-6.156-6.089-12.266l2.53-14.57c3.82-21.96 16.463-37.323 37.683-44.153l27.702-8.561 28.754-8.035c18.34 18.57 48.615 27.957 81.285 27.957 32.4-.04 61.709-8.478 80.259-26.809l.38-.43 31.486 5.256 26.39 8.5c21.22 6.83 36.9 24.87 40.72 46.83l2.53 14.57c1.07 6.111-3.64 11.711-9.85 11.711z"
                                                    fill="#7e8b96" />
                                                <g>
                                                    <path
                                                        d="m384.055 215c-2.94 43.71-18.85 104.74-24.92 130.96-.68 2.94-2.33 5.45-4.56 7.22-2.23 1.78-5.05 2.82-8.06 2.82-6.88 0-12.55-5.37-12.94-12.23 0 0-5.58-84.28-7.63-128.77z"
                                                        fill="#dc4955" />
                                                </g>
                                                <path
                                                    d="m141 271c-27.062 0-49-21.938-49-49 0-11.046 8.954-20 20-20h8.989l240.468-6.287 8.293 6.287h15.25c11.046 0 20 8.954 20 20 0 27.062-21.938 49-49 49z"
                                                    fill="#f2bb88" />
                                                <path
                                                    d="m360.6 415.39-.06.09c-49.3 66.23-174.56 66.38-223.76.56l-.43-.63 18.171-1.91 12.669-8.02c18.34 18.57 48.41 29.8 81.08 29.8h.15c32.4-.04 62.28-11.1 80.83-29.43l.38-.43z"
                                                    fill="#a9a4d3" />
                                                <path
                                                    d="m147.8 418.394v10.136l-32.89 10.59c-15.6 5.02-27.05 18.18-29.86 34.34l-3.59 23.54h-4.85c-6.21 0-10.92-5.6-9.85-11.71l2.53-14.57c3.82-21.96 19.5-40 40.72-46.83l26.34-8.48z"
                                                    fill="#64727a" />
                                                <path
                                                    d="m182.19 417.45-34.39 11.08c-3.99-3.86-7.68-8.02-11.02-12.49l-.43-.63 30.84-9.93c1.828 1.848 10.344.351 12.353 2.02 2.928 2.433-.561 7.928 2.647 9.95z"
                                                    fill="#938dc8" />
                                                <path
                                                    d="m299.7 358.2-2.71-28.06-79.861 2.255.001-.005-16.48.47-2.98 26.56-.763 6.8 2.039 12.83-3.989 4.55-.778 6.93c-.41 3.93-3.11 7.25-6.87 8.47l-20.12 6.48c4.37 4.43 9.41 8.44 15 11.97l10.02-3.22c9.79-3.17 16.79-11.79 17.88-21.97l2.058-17.506c.392-3.33 3.888-5.367 6.958-4.02 11.414 5.008 21.565 7.765 28.393 7.765 11.322.001 31.852-7.509 52.202-20.299z"
                                                    fill="#f2bb88" />
                                                <path
                                                    d="m134.539 164.427s-.849 18.411-.849 33.002c0 38.745 9.42 76.067 25.701 105.572 20.332 36.847 72.609 61.499 88.109 61.499s68.394-24.653 89.275-61.499c14.137-24.946 23.338-55.482 25.843-87.741.458-5.894-9.799-20.073-9.799-26.058l10.491-24.775c0-38.422-36.205-111.427-114.81-111.427s-113.961 73.005-113.961 111.427z"
                                                    fill="#f2d1a5" />
                                                <g>
                                                    <path
                                                        d="m294 227.5c-4.142 0-7.5-3.358-7.5-7.5v-15c0-4.142 3.358-7.5 7.5-7.5s7.5 3.358 7.5 7.5v15c0 4.142-3.358 7.5-7.5 7.5z"
                                                        fill="#64727a" />
                                                </g>
                                                <g>
                                                    <path
                                                        d="m203 227.5c-4.142 0-7.5-3.358-7.5-7.5v-15c0-4.142 3.358-7.5 7.5-7.5s7.5 3.358 7.5 7.5v15c0 4.142-3.358 7.5-7.5 7.5z"
                                                        fill="#64727a" />
                                                </g>
                                                <g>
                                                    <path
                                                        d="m249 260.847c-5.976 0-11.951-1.388-17.398-4.163-3.691-1.88-5.158-6.397-3.278-10.087 1.88-3.691 6.398-5.158 10.087-3.278 6.631 3.379 14.547 3.379 21.178 0 3.689-1.881 8.207-.413 10.087 3.278 1.88 3.69.413 8.207-3.278 10.087-5.447 2.775-11.422 4.163-17.398 4.163z"
                                                        fill="#f2bb88" />
                                                </g>
                                                <path
                                                    d="m288.989 40.759c0 22.511-9.303 40.759-40.489 40.759s-48.702-42.103-48.702-42.103 17.516-39.415 48.702-39.415c25.911 0 47.746 12.597 54.392 29.769 1.353 3.497-13.903 7.182-13.903 10.99z"
                                                    fill="#df646e" />
                                                <path
                                                    d="m254.305 81.307c1.031-.099 2.069-.167 3.093-.295 26.96-3.081 47.572-19.928 47.572-40.252 0-3.81-.72-7.49-2.08-10.99-15.42-6.31-33.46-10.34-54.39-10.34-4.139 0-8.163.159-12.073.462-5.127.397-7.393-6.322-3.107-9.163 7.36-4.878 16.519-8.364 26.68-9.879-3.71-.56-7.56-.85-11.5-.85-25.933 0-47.766 12.621-54.393 29.813-.006.002-.011.004-.017.007-1.337 3.487-2.055 7.201-2.06 10.94 0 22.51 25.28 40.76 56.47 40.76 1.946.008 3.872-.09 5.805-.213z"
                                                    fill="#dc4955" />
                                                <path
                                                    d="m363.31 164.43v33c0 5.99-.23 11.94-.7 17.83-4.32-.91-8.4-2.66-12.05-5.19-22.785-15.834-31.375-40.163-37.64-60.936-.382-1.268-1.547-2.134-2.871-2.134h-30.949c-4.96 0-9.65-2.15-12.89-5.91l-10.947-12.711c-1.197-1.39-3.349-1.39-4.546 0l-10.947 12.711c-3.24 3.76-7.93 5.91-12.89 5.91h-90.33c8.47-39.6 44.09-94 111.95-94 78.61 0 114.81 73 114.81 111.43z"
                                                    fill="#f2bb88" />
                                                <path
                                                    d="m381 164.19v37.81h-11.25c-4 0-7.93-1.16-11.22-3.44-19.74-13.72-26.93-35.65-33.69-58.43-1.26-4.24-5.16-7.13-9.58-7.13h-36.165c-.873 0-1.703-.38-2.273-1.042l-21.559-25.029c-1.197-1.389-3.349-1.389-4.546 0l-21.559 25.029c-.57.662-1.4 1.042-2.273 1.042h-38.015c-5.3 0-9.68 4.14-9.98 9.44 0 0-2.331 25.591-4.032 66.31-1.765 42.256-7.908 135.02-7.908 135.02-.16 2.822-1.215 5.393-2.879 7.441-2.381 2.929-5.67.375-9.72.375-3.01 0-5.83-1.04-8.06-2.82-2.23-1.77-.792-5.474-1.472-8.414-6.7-28.94-23.83-94.686-23.83-138.351 0-13.73-.14-34.689 0-37.649.14-26.43 12.74-54.048 32-78.128 12.937-16.178 28.667-38.955 58.628-47.692 10.986-3.204 23.248-5.101 36.883-5.101 50.8 0 82.75 26.31 100.6 48.39 19.68 24.319 31.9 55.879 31.9 82.369z"
                                                    fill="#df646e" />
                                                <path
                                                    d="m211.62 38.54c-19.38 9.9-33.55 23.84-43.37 36.44-19.26 24.69-31.27 56.78-31.41 83.88-.14 3.03-.84 25.18-.84 39.25 0 44.77 18.69 117.93 25.39 147.6.47 2.08 1.4 3.94 2.68 5.5-2.38 2.93-6.01 4.79-10.06 4.79-3.01 0-5.83-1.04-8.06-2.82-2.23-1.77-3.88-4.28-4.56-7.22-6.7-28.94-25.39-100.29-25.39-143.96 0-13.73.7-35.33.84-38.29.14-26.43 12.15-57.73 31.41-81.81 12.94-16.18 33.4-34.63 63.37-43.36z"
                                                    fill="#dc4955" />
                                                <g>
                                                    <path
                                                        d="m316.539 193.816c-1.277 0-2.571-.327-3.755-1.013-11.762-6.82-25.806-6.82-37.567 0-3.583 2.078-8.172.858-10.25-2.726-2.078-3.583-.857-8.172 2.726-10.25 16.474-9.552 36.143-9.552 52.616 0 3.583 2.078 4.804 6.667 2.726 10.25-1.392 2.399-3.909 3.739-6.496 3.739z"
                                                        fill="#df646e" />
                                                </g>
                                                <g>
                                                    <path
                                                        d="m225.539 193.816c-1.277 0-2.571-.327-3.755-1.013-11.762-6.82-25.806-6.82-37.567 0-3.583 2.078-8.171.858-10.25-2.726-2.078-3.583-.857-8.172 2.726-10.25 16.474-9.552 36.143-9.552 52.616 0 3.583 2.078 4.804 6.667 2.726 10.25-1.392 2.399-3.909 3.739-6.496 3.739z"
                                                        fill="#df646e" />
                                                </g>
                                                <g>
                                                    <path
                                                        d="m302.143 383.517c-16.23 10.87-34.973 16.353-53.643 16.353s-37.3-5.41-53.54-16.27l3.476-6.313-1.526-11.067 4.15 3.37c28.46 20.41 66.63 20.37 95.05-.12.2-.14.39-.27.6-.39l3.826-2.211z"
                                                        fill="#a9a4d3" />
                                                </g>
                                                <g>
                                                    <path
                                                        d="m211.98 376.2-1.85 15.68c-5.23-2.27-10.31-5.03-15.17-8.28l1.95-17.38 4.15 3.37c3.5 2.51 7.15 4.72 10.92 6.61z"
                                                        fill="#938dc8" />
                                                </g>
                                                <g>
                                                    <path
                                                        d="m269.5 306.5h-42c-4.142 0-7.5-3.358-7.5-7.5s3.358-7.5 7.5-7.5h42c4.142 0 7.5 3.358 7.5 7.5s-3.358 7.5-7.5 7.5z"
                                                        fill="#df646e" />
                                                </g>
                                            </g>
                                        </svg>
                                        44 active view this
                                    </li> --}}
                                </ul>
                            </div>
                            <div class="pro-group">
                                <h6 class="product-title">{{__('product information')}}</h6>
                                <p id="product-desc"></p>
                            </div>
                            <div class="pro-group pb-0">


                                {{-- <h6 class="product-title">quantity</h6>--}}
                                {{-- <div class="qty-box">--}}
                                {{-- <div class="input-group">--}}
                                {{-- <button class="qty-minus"></button>--}}
                                {{-- <input class="qty-adj form-control" type="number" value="1">--}}
                                {{-- <button class="qty-plus"></button>--}}
                                {{-- </div>--}}
                                {{-- </div>--}}
                                <input type="hidden" name="product_id" id="product-id">
                                <livewire:add-cart/>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick-view modal popup end-->

<!-- edit product modal start-->
{{--<div class="modal fade bd-example-modal-lg theme-modal pro-edit-modal" id="edit-product" tabindex="-1"
    role="dialog" --}} {{-- aria-hidden="true">--}}
{{-- <div class="modal-dialog modal-lg modal-dialog-centered" role="document">--}}
{{-- <div class="modal-content ">--}}
{{-- <div class="modal-body">--}}
{{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
    aria-label="Close"></button>--}}
{{-- <div class="pro-group">--}}
{{-- <div class="product-img">--}}
{{-- <div class="media">--}}
{{-- <div class="img-wraper">--}}
{{-- <a href="product-page(left-sidebar).html">--}}
{{-- <img src="{{asset('front/images/mega-store/product/9.jpg')}}" alt="" --}}
{{-- class="img-fluid">--}}
{{-- </a>--}}
{{-- </div>--}}
{{-- <div class="media-body">--}}
{{-- <a href="product-page(left-sidebar).html">--}}
{{-- <h3>redmi not 3</h3>--}}
{{-- </a>--}}
{{-- <h6>$80<span>$120</span></h6>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- <div class="pro-group">--}}
{{-- <h6 class="product-title">Select Size</h6>--}}
{{-- <div class="size-box">--}}
{{-- <ul>--}}
{{-- <li><a href="javascript:void(0)">s</a></li>--}}
{{-- <li><a href="javascript:void(0)">m</a></li>--}}
{{-- <li><a href="javascript:void(0)">l</a></li>--}}
{{-- <li><a href="javascript:void(0)">xl</a></li>--}}
{{-- <li><a href="javascript:void(0)">2xl</a></li>--}}
{{-- </ul>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- <div class="pro-group">--}}
{{-- <h6 class="product-title">Select color</h6>--}}
{{-- <div class="color-selector inline">--}}
{{-- <ul>--}}
{{-- <li>--}}
{{-- <div class="color-1 active"></div>--}}
{{-- </li>--}}
{{-- <li>--}}
{{-- <div class="color-2"></div>--}}
{{-- </li>--}}
{{-- <li>--}}
{{-- <div class="color-3"></div>--}}
{{-- </li>--}}
{{-- <li>--}}
{{-- <div class="color-4"></div>--}}
{{-- </li>--}}
{{-- <li>--}}
{{-- <div class="color-5"></div>--}}
{{-- </li>--}}
{{-- <li>--}}
{{-- <div class="color-6"></div>--}}
{{-- </li>--}}
{{-- <li>--}}
{{-- <div class="color-7"></div>--}}
{{-- </li>--}}
{{-- </ul>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- <div class="pro-group">--}}
{{-- <h6 class="product-title">Quantity</h6>--}}
{{-- <div class="qty-box">--}}
{{-- <div class="input-group">--}}
{{-- <button class="qty-minus"></button>--}}
{{-- <input class="qty-adj form-control" type="number" value="1" />--}}
{{-- <button class="qty-plus"></button>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- <div class="pro-group mb-0">--}}
{{-- <div class="modal-btn">--}}
{{-- <a href="cart.html" class="btn btn-solid btn-sm" style="padding: 0px">--}}
{{-- add to cart--}}
{{-- </a>--}}
{{-- <a href="#" class="btn btn-solid btn-sm" id="more-details-btn">--}}
{{-- more detail--}}
{{-- </a>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{--</div>--}}
<!-- edit product modal end-->

<!-- Add to cart bar -->
<livewire:side-cart/>
<!-- Add to cart bar end-->

<!-- Add to wishlist bar -->
<div id="wishlist_side" class="add_to_cart right">
    <a href="javascript:void(0)" class="overlay" onclick="closeWishlist()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>{{__('My wishlist')}}</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeWishlist()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>


        <livewire:side-wishlist/>

    </div>
</div>
<!-- Add to wishlist bar -->

<!-- My account bar start-->


<div id="myAccount" class="add_to_cart right account-bar">
    <a href="javascript:void(0)" class="overlay" onclick="closeAccount()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>{{__('my account')}}</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeAccount()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        @if(auth()->check())
            <div class="theme-form">
                <div class="form-group">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                            {{-- <a class="dropdown-item" href="#">Profile</a>--}}
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('web.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item"> {{__(('Logout'))}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <form class="theme-form" action="{{route('web.login')}}" method="post" id="addForm">
                @csrf
                <div id="general-error" class="alert alert-danger text-danger" style="display: none;"></div>
                <div class="form-group">
                    <label for="email">{{__('Email')}}</label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                    <label id="login_email" class="error_sms" style="display: none"></label>
                </div>
                <div class="form-group">
                    <label for="review">{{__('Password')}}</label>
                    <input type="password" name="password" class="form-control" id="review"
                           placeholder="Enter your password">
                    <label id="login_password" class="error_sms" style="display: none"></label>
                </div>
                <div class="form-group">
                    <button id="login_button" class="btn btn-solid btn-md btn-block ">{{__('Login')}}</button>
                </div>
                <div class="accout-fwd">
                    <a href="#" class="d-block">
                        <h5>{{__('forget password?')}}</h5>
                    </a>
                    <a href="{{route('web.signup.form')}}" class="d-block">
                        <h6>{{__('you have no account?')}}
                            <span>{{__('signup now')}}</span>
                        </h6>
                    </a>
                </div>
            </form>
        @endif
    </div>
</div>

<!-- Add to account bar end-->

<!-- add to  setting bar  start-->
<div id="mySetting" class="add_to_cart right">
    <a href="javascript:void(0)" class="overlay" onclick="closeSetting()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>{{__('my setting')}}</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeSetting()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <div class="setting-block">
            <div class="form-group">
                <label for="language-select">{{__('language')}}</label>
                <select id="language-select" onchange="location = this.value;">
                    <option value="{{ url('/en') }}" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                    <option value="{{ url('/ar') }}" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>Arabic</option>
                </select>
            </div>
            {{-- <div class="form-group">
                <select>
                    <option value="">{{__('currency')}}</option>
                    <option value="">uro</option>
                    <option value="">ruppees</option>
                    <option value="">piund</option>
                    <option value="">doller</option>
                </select>
            </div> --}}
        </div>
    </div>
</div>
@if (session('registered_successfully'))

    <script>
        new Noty({
            layout: 'topRight',
            text: "{{ session('registered_successfully') }}",
            theme: 'relax',
            type: 'success',
            timeout: 3000,
            killer: true
        }).show();
    </script>

@endif

@if(session('error'))

    <script>
        new Noty({
            layout: 'topRight',
            text: "{{ session('error') }}",
            theme: 'relax',
            type: 'error',
            timeout: 3000,
            killer: true
        }).show();
    </script>

@endif
<!-- add to  setting bar  end-->

<!-- notification product -->
{{--<div class="product-notification" id="dismiss">--}}
{{-- <span onclick="dismiss();" class="btn-close" aria-hidden="true"></span>--}}
{{-- <div class="media">--}}
{{-- <img class="me-2" src="{{asset('front/images/layout-6/product/5.jpg')}}"
    alt="Generic placeholder image">--}}
{{-- <div class="media-body">--}}
{{-- <h5 class="mt-0 mb-1">Latest trending</h5>--}}
{{-- Cras sit amet nibh libero, in gravida nulla.--}}
{{-- </div>--}}
{{-- </div>--}}
{{--</div>--}}
<!-- notification product -->
<script>
    feather.replace()
</script>


<!-- latest jquery-->
<script src={{asset('front/js/jquery-3.3.1.min.js')}}></script>


<!-- tool tip js -->
<script src={{asset('front/js/tippy-popper.min.js')}}></script>
<script src={{asset('front/js/tippy-bundle.iife.min.js')}}></script>

<!-- popper js-->
<script src={{asset('front/js/popper.min.js')}}></script>

<!-- Bootstrap js-->
<script src={{asset('front/js/bootstrap-notify.min.js')}}></script>

<!-- father icon -->
<script src={{asset('front/js/feather.min.js')}}></script>
<script src={{asset('front/js/feather-icon.js')}}></script>

<!-- Timer js-->
<script src={{asset('front/js/menu.js')}}></script>

<!-- slick js-->
<script src={{asset('front/js/slick.js')}}></script>

<!-- Bootstrap js-->
<script src={{asset('front/js/bootstrap.js')}}></script>

<!-- Theme js-->
<script src={{asset('front/js/modal.js')}}></script>
<script src={{asset('front/js/script.js')}}></script>
<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{ asset('assets/plugins/noty/noty.min.js') }}"></script>
<script src="{{asset('assets/plugins/toaster/toast.min.js')}}"></script>
<!-- range sldier -->
<script src="{{asset('front/js/ion.rangeSlider.js')}}"></script>
<script src="{{asset('front/js/rangeslidermain.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    toastr.options = {
        "closeButton": false,                // Show close button
        "debug": false,                     // Debug mode
        "newestOnTop": true,                // Display newest notification on top
        "progressBar": true,                // Show progress bar
        "positionClass": "toast-top-left", // Position in top right corner
        "preventDuplicates": false,         // Prevent duplicate notifications
        "onclick": null,                    // OnClick event
        "showDuration": "300",              // Show duration in milliseconds
        "hideDuration": "1000",             // Hide duration in milliseconds
        "timeOut": "2000",                  // Auto close timeout
        "extendedTimeOut": "1000",          // Extended timeout
        "showEasing": "swing",              // Show easing effect
        "hideEasing": "linear",             // Hide easing effect
        "showMethod": "fadeIn",             // Show method
        "hideMethod": "fadeOut"             // Hide method
    };
</script>
<script>
    $(document).ready(function () {
        var inputs =
            [
                'email',
                'password',
            ];


        $('#login_button').click(function (e) {
            e.preventDefault();
            var url = $('#addForm').attr('action');
            var form_data = $('#addForm').get(0);

            // Hide any existing error messages
            $('.error_sms').hide();
            $('#general-error').hide();
            $('#login_button').attr('disabled', 'disabled').text('').append('<span class="spinner-border spinner-border-lg" role="status" aria-hidden="true"></span>');

            for (var i = 0; i < inputs.length; i++) {
                $('.input_' + inputs[i]).css('border', '');
            }

            $.ajax({
                url: url,
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: new FormData(form_data),
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {
                    $("#sucsess-modal").modal("show");
                    var url = data.url;
                    if (url) {
                        setTimeout(function () {
                            window.location = url;
                        }, 3000);
                    }
                },
                error: function (data) {
                    var error = data.responseJSON.errors;
                    var errorMessage = data.responseJSON.message;

                    $('#login_button').removeAttr('disabled').text('{{__('Login')}}');

                    // Show a general error message if authentication fails
                    if (errorMessage) {
                        $('#general-error').text(errorMessage).show();
                    }

                    // Show specific field errors
                    for (var i = 0; i < inputs.length; i++) {
                        if (error && error.hasOwnProperty(inputs[i])) {
                            $('#login_' + inputs[i]).text(error[inputs[i]]).show();
                            $('#email').addClass('is-invalid');
                            $('.input_' + inputs[i]).css('border', '1px solid red').css('margin-bottom', 0);
                        }
                    }
                }
            });
        });

        function loadProducts(collectionId) {
            $.ajax({
                url: '/get-products-by-collection',
                method: 'GET',
                data: {collection_id: collectionId},
                beforeSend: function () {
                    $('#product-list').html('<p>Loading...</p>');
                },
                success: function (response) {
                    $('#product-list').html(response);

                    // Reinitialize slick slider or any other JS plugins
                    $('#product-list').slick({
                        infinite: true,
                        slidesToShow: 3,  // Example for 3 items per row
                        slidesToScroll: 1,
                        arrows: true,
                    });
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    $('#product-list').html('<p>Something went wrong. Please try again later.</p>');
                }
            });
        }


        var firstCollectionId = $('.tabs li.current a').data('collection-id');
        loadProducts(firstCollectionId);

        $('.tabs li a').on('click', function (e) {
            e.preventDefault();
            $('.tabs li').removeClass('current');
            $(this).parent().addClass('current');
            var collectionId = $(this).data('collection-id');
            loadProducts(collectionId);
        });
    });

    function initializeSlick() {
        if ($('.product-slide-6').length) {
            $('.product-slide-6').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: true,
            });
        } else {
            console.error('Slick element not found');
        }
    }

</script>
<script>
    $(document).ready(function () {
        var inputs =
            [
                'first_name',
                'last_name',
                'email',
                'password',
            ];


        $('#register_button').click(function (e) {
            e.preventDefault();
            var url = $('#registerForm').attr('action');
            var form_data = $('#registerForm').get(0);

            // Hide any existing error messages
            $('.error_sms').hide();
            $('#general-error').hide();
            $('#register_button').attr('disabled', 'disabled').text('').append('<span class="spinner-border spinner-border-lg" role="status" aria-hidden="true"></span>');

            for (var i = 0; i < inputs.length; i++) {
                $('.input_' + inputs[i]).css('border', '');
            }

            $.ajax({
                url: url,
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: new FormData(form_data),
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {
                    $("#sucsess-modal").modal("show");
                    var url = data.url;
                    if (url) {
                        setTimeout(function () {
                            window.location = url;
                        }, 3000);
                    }
                },
                error: function (data) {
                    var error = data.responseJSON.errors;
                    var errorMessage = data.responseJSON.message;

                    $('#register_button').removeAttr('disabled').text('{{__('Register')}}');

                    // Show a general error message if authentication fails
                    if (errorMessage) {
                        $('#general-error').text(errorMessage).show();
                    }

                    // Show specific field errors
                    for (var i = 0; i < inputs.length; i++) {
                        if (error && error.hasOwnProperty(inputs[i])) {
                            $('#register_' + inputs[i]).text(error[inputs[i]]).show();
                            $('#email').addClass('is-invalid');
                            $('.input_' + inputs[i]).css('border', '1px solid red').css('margin-bottom', 0);
                        }
                    }
                }
            });
        });
    });
</script>
<script>
    function showProduct(element, productId) {
        var modal = $('#quick-view');
        modal.find('#product-name').text(''); // Clear product name
        modal.find('#product-id').text(''); // Clear product ID
        modal.find('#product-price').text(''); // Clear product price
        modal.find('#product-discount-price').text(''); // Clear discount price
        modal.find('#product-image').attr('src', ''); // Clear product image
        modal.find('#product-desc').html(''); // Clear product description
        modal.find('#reviews-count').html(''); // Clear product description
        modal.find('#avg-review').html(''); // Clear product description

        // Set the product_id in the hidden input field
        document.getElementById('modal-product-id').value = productId;
        document.getElementById('product-id').value = productId;
        modal.find('#best-seller-badge').hide();


        // Fetch the product details using AJAX
        var ur = window.laravelUrl + '/api/product/' + productId;
        $.ajax({
            url: ur,
            type: 'GET',
            headers: {
                'Accept-Language': '{{app()->getLocale()}}'
            },
            success: function (response) {
                // Populate the modal with the product details
                var modal = $('#quick-view');
                var locale = '{{ app()->getLocale() }}';
                var productName = locale === 'ar' ? response.data.name : response.data.name_en;
                var productDesc = locale === 'ar' ? response.data.desc : response.data.desc_en;
                modal.find('#product-name').text(productName);
                modal.find('#product-id').text(response.data.id);
                // Update the price and discount elements
                var priceElement = modal.find('#product-price');
                var discountPriceElement = modal.find('#product-discount-price');

                // Set the values
                priceElement.text(response.data.price);
                discountPriceElement.text(response.data.discount_price);

                if (response.data.discount_price != null) {
                    priceElement.addClass('line-through');
                    discountPriceElement.show();
                } else {
                    priceElement.removeClass('line-through');
                    discountPriceElement.hide();
                }

                modal.find('#product-image').attr('src', response.data.image);
                var editorContentElement = document.getElementById('product-desc');
                editorContentElement.innerHTML = productDesc;
                var reviewContentElement = document.getElementById('reviews-count');
                reviewContentElement.innerHTML = response.data.review;

                for (var i = 1; i <= 5; i++) {
                    if (response.data.review_avg >= i) {
                        // Full star
                        $("#avg-review").append('<i class="fa fa-star" style="color: #FFD700;"></i>');
                    } else if (response.data.review_avg >= (i - 0.5)) {
                        // Half star
                        $("#avg-review").append('<i class="fa fa-star-half-alt" style="color: #FFD700;"></i>');
                    } else {
                        // Empty star
                        $("#avg-review").append('<i class="fa fa-star" style="color: #e4e5e9;"></i>');
                    }
                }


                if (response.data.best_seller == 1) {
                    modal.find('#best-seller-badge').show();
                } else {
                    modal.find('#best-seller-badge').hide();
                }

                var moreDetailsBtn = document.getElementById('more-details-btn');
                moreDetailsBtn.href = '/product/' + response.data.slug;
                // Display the modal
                modal.modal('show');

            },
            error: function (xhr, status, error) {
                // Handle the error
                console.log(error);
            }
        });
    }
</script>

<script>
    window.laravelUrl = "{{ url('/') }}";
</script>
@stack('scripts')
@livewireScripts
</body>

</html>
