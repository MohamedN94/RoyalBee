@extends('front.layouts.app')
@section('content')
    @php $logo = str_replace('\\/', '/', setting('logo') ); @endphp

    <!--slider start-->
    <section class="theme-slider section-pt-space">
        <div class="custom-container">
            <div class="row">
                <div class="col-xl-8 col-lg-9 offset-xl-2 px-abjust">
                    <div class="slide-1">
                        <div class="slide-1">
                            @foreach ($sliders as $slider)
                                <div>
                                    <div class="slider-banner slide-banner-5">
                                        <div class="slider-img"
                                            style="background-size: contain !important;background-position: center center;background-repeat: no-repeat;display: block;background-color: transparent">
                                            <!-- Mobile Image -->
                                            <img src="{{ app()->getLocale() == 'ar' ? asset($slider->mobile_image_ar) : asset($slider->mobile_image) }}" class="slider-image mobile-image"
                                                alt="Mobile Slider">

                                            <!-- Desktop Image -->
                                            <img src="{{ app()->getLocale() == 'ar' ? asset($slider->image_ar) : asset($slider->image) }}" class="slider-image desktop-image"
                                                alt="Desktop Slider">
                                        </div>
                                        <div class="slider-banner-contain">
                                            <div>
                                                <h3>{{ app()->getLocale() == 'ar' ? $slider->title_ar : $slider->title_en }}
                                                </h3>
                                                <h1>{!! app()->getLocale() == 'ar' ? $slider->description_ar : $slider->description_en !!}</h1>
                                                @if ($slider->link)
                                                    <a href="{{ $slider->link }}" class="btn btn-rounded">
                                                        {{ __('shop now') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <style>
                    .slider-image {
                        display: none !important;
                        width: 100% !important;
                    }

                    /* Show mobile image for small screens */
                    @media (max-width: 768px) {
                        .mobile-image {
                            display: block !important;
                        }

                        .slider-img {
                            height: auto !important;
                        }
                    }

                    /* Show desktop image for larger screens */
                     @media (min-width: 769px) {
                        .desktop-image {
                            width:auto;
                            height:auto;
                            border: 2px ;
                            border-radius:30px;
                            padding: 0px;
                            display: block !important;
                            margin-top:5%;
                        }
                    }
                </style>
                <div class="col-xl-2 col-sm-3 ps-0 offer-banner">
                    <div class="offer-banner-img">
                        <img src="{{ asset('front/images/layout-6/collection-banner/4.jpg') }}" alt="offer-banner"
                            class="img-fluid">
                        <style>
                            .img-fluid {
                                border-radius: 25px;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('.slide-1').slick({
                autoplay: true,
                autoplaySpeed: 3000, // 3 seconds delay
                arrows: true, // Show navigation arrows
                dots: false, // Set to true if you want dots
                infinite: true,
                slidesToShow: 1, // Number of slides to show at a time
                slidesToScroll: 1, // Number of slides to scroll at a time
                prevArrow: '<button type="button" class="slick-prev">Previous</button>',
                nextArrow: '<button type="button" class="slick-next">Next</button>',
            });
        });
    </script>
    <!--slider end-->


    <!--rounded category start-->
    <section class="rounded-category vagitable-category  section-mt-space">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="slide-6">
                        @foreach ($collections as $collection)
                            <div>
                                <div class="category-contain">
                                    <a href="{{ route('web.category.show', $collection->slug) }}">
                                        <div class="img-wrapper">
                                            <img src="{{ asset($collection->image) }}" alt="category-img" class="img-fluid">
                                        </div>
                                        <div>
                                            <div class="btn-rounded">
                                                {{ app()->getLocale() == 'ar' ? $collection->name_ar : $collection->name_en }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--rounded category end-->


    <!--services start-->
    <section class="services services-inverse" style="background-color: #fffefc;">
        <div class="container">
            <div class="d-flex flex-wrap service-block">
                <div class="col-lg-3 col-md-6  col-6">
                    <div class="media">
                        <img src="{{ asset('assets/icons/tabby.png') }}" style="height: 43px;margin: 4%;"
                            alt=" {{__('dashboard.tabby_payment') }} " class="icon-class">
                        <div class="media-body mt-2">
                            <h5 class="text-center" style="font-size: small;"> {{__('dashboard.tabby_payment') }} </h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6  col-6">
                    <div class="media">
                        <img src="{{ asset('assets/icons/pay.png') }}" style="height: 43px;margin: 4%;"
                            alt=" {{__('dashboard.secure_payment') }} " class="icon-class">
                        <div class="media-body mt-2">
                            <h5 class="text-center" style="font-size: small;"> {{__('dashboard.secure_payment') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6  col-6">
                    <div class="media">
                        <img src="{{ asset('assets/icons/cash-del.png') }}" style="height: 43px;margin: 4%;"
                            alt="{{__('dashboard.cash_on_delivery') }}" class="icon-class">
                        <div class="media-body mt-2">
                            <h5 class="text-center" style="font-size: small;"> {{__('dashboard.cash_on_delivery') }} </h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6  col-6">
                    <div class="media">
                        <img src="{{ asset('assets/icons/delivery-truck.png') }}" style="height: 43px;margin: 4%;"
                            alt=" {{__('dashboard.delivery_all') }} " class="icon-class">
                        <div class="media-body mt-2">
                            <h5 class="text-center" style="font-size: small;">{{__('dashboard.delivery_all') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--services end-->


    <!--title start-->
    <div class="title4">
        <h4>{{ __('product') }} <span>{{ __('trending') }}</span></h4>
    </div>
    <!--title end-->


    <!--product box start -->
    <livewire:products />
    <!--product box end-->

    <section class="container py-5">
        <!-- Heading Section -->
        <div class="row mb-4 text-center">
            <div class="col mb-4">
                <h2>
                    {{ __('dashboard.benefits_of') }} <span class="text-warning">{{ __('dashboard.honey') }}</span>
                </h2>
            </div>
        </div>
        <!-- Content Section -->
        <div class="row">
            <div class="col-md-6">
                <img loading="lazy" style="width: 90%;"
                    src="https://www.almalaky.com/wp-content/uploads/2021/08/Layer-2@2x.png"
                    class=" attachment-full size-full wp-image-49851" alt=""
                    srcset="https://www.almalaky.com/wp-content/uploads/2021/08/Layer-2@2x.png 926w, https://www.almalaky.com/wp-content/uploads/2021/08/Layer-2@2x-300x298.png 300w, https://www.almalaky.com/wp-content/uploads/2021/08/Layer-2@2x-150x150.png 150w, https://www.almalaky.com/wp-content/uploads/2021/08/Layer-2@2x-768x763.png 768w, https://www.almalaky.com/wp-content/uploads/2021/08/Layer-2@2x-600x596.png 600w, https://www.almalaky.com/wp-content/uploads/2021/08/Layer-2@2x-100x100.png 100w, https://www.almalaky.com/wp-content/uploads/2021/08/Layer-2@2x-50x50.png 50w">
            </div>
            <div class="col-md-6">
                <!-- Icon Box 1 -->
                <div class="col-12 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <!-- SVG Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" style="height: 75px;" id="Layer_1" data-name="Layer 1"
                                viewBox="0 0 71.4 70.63">
                                <g>
                                    <path class="cls-1"
                                        d="M67.1,36.24a1.66,1.66,0,0,1-1.57.93c-1.67,0-3.34,0-5,0A1.62,1.62,0,0,1,59,35.59c0-.83.63-1.34,1.62-1.35,1.61,0,3.23,0,4.84,0a1.59,1.59,0,0,1,1.68,1Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M36.06,4.14a1.58,1.58,0,0,1,1,1.69c-.05,1.64,0,3.28,0,4.91a1.4,1.4,0,0,1-1.21,1.55,1.48,1.48,0,0,1-1.59-1.1,2.58,2.58,0,0,1-.14-.86c0-1.43,0-2.87,0-4.3a1.77,1.77,0,0,1,1.11-1.89Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M4.14,35A2,2,0,0,1,6,34.22c1.55.06,3.11,0,4.67,0,1,0,1.42.36,1.49,1.21s-.29,1.61-1.25,1.66c-1.84.1-3.69.06-5.53,0a1.31,1.31,0,0,1-1.21-.89Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M35,67.1A1.3,1.3,0,0,1,34.13,66a27.25,27.25,0,0,1,.09-5.78c.15-.85.7-1.17,1.61-1.09A1.19,1.19,0,0,1,37,60.47c0,1.79,0,3.58,0,5.37a1.26,1.26,0,0,1-.77,1.26Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M27.82,38.42c-1.26,0-2.52,0-3.79,0a1.41,1.41,0,0,1-1.46-.76,1.61,1.61,0,0,1,.16-1.74c1.49-2,3-4,4.46-6l10.9-14.52a1.75,1.75,0,0,1,2.13-.7,1.56,1.56,0,0,1,.7,1.88c-.74,4.2-1.42,8.41-2.12,12.61-.19,1.12-.19,1.13.94,1.13h7c.68,0,1.45-.18,1.86.62a2,2,0,0,1-.4,2.2q-4,6-8,12.08c-2.27,3.44-4.53,6.9-6.8,10.34a3.69,3.69,0,0,1-.47.63,1.47,1.47,0,0,1-1.84.36A1.43,1.43,0,0,1,30.39,55c.62-4.6,1.26-9.19,1.89-13.79a19.13,19.13,0,0,1,.23-2c.17-.72-.17-.77-.72-.76C30.47,38.43,29.14,38.42,27.82,38.42Zm6.39,10.39.12,0c.29-.46.57-.92.87-1.38L44.12,34c.15-.24.45-.49.28-.77s-.49-.1-.75-.1H37c-1.08,0-1.51-.43-1.47-1.5a14.88,14.88,0,0,1,.25-1.74Q36.38,26,37,22.07L36.9,22,26.81,35.47h1.1c2,0,4.06,0,6.08,0,1.28,0,1.9.61,1.76,1.75-.29,2.41-.64,4.8-1,7.2C34.59,45.89,34.4,47.35,34.21,48.81Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M56.75,12.9a1.44,1.44,0,0,1,1.4.72A1.32,1.32,0,0,1,58,15.26c-1.29,1.37-2.61,2.7-4,4a1.47,1.47,0,0,1-2-2.11c1.27-1.34,2.6-2.63,3.91-3.92A1.08,1.08,0,0,1,56.75,12.9Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M14.31,12.9a2,2,0,0,1,1.23.52c1.12,1.13,2.26,2.23,3.36,3.37a1.66,1.66,0,0,1,.41,2.07,1.34,1.34,0,0,1-1.42.67,1.42,1.42,0,0,1-.92-.45c-1.25-1.24-2.49-2.49-3.73-3.73A1.41,1.41,0,0,1,13,13.71,1.38,1.38,0,0,1,14.31,12.9Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M18,51.88a1.2,1.2,0,0,1,1.34.76,1.38,1.38,0,0,1-.26,1.62q-1.87,1.92-3.8,3.79a1.73,1.73,0,0,1-2,0,1.63,1.63,0,0,1-.07-2c1.26-1.34,2.59-2.62,3.9-3.93C17.35,51.8,17.7,51.91,18,51.88Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M56.84,58.34a1.16,1.16,0,0,1-1.07-.45c-1.16-1.17-2.33-2.32-3.48-3.49a1.37,1.37,0,0,1-.19-2.09,1.61,1.61,0,0,1,2.22-.07c1.22,1.14,2.39,2.34,3.55,3.55a1.41,1.41,0,0,1,.31,1.76A1.23,1.23,0,0,1,56.84,58.34Z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div style="margin-right: 2%">
                            <h3 class="h5">{{ __('dashboard.natural_energy_booster') }}</h3>
                            <p>{{ __('dashboard.natural_energy_booster_description') }}</p>
                        </div>
                    </div>
                </div>
                <!-- Icon Box 2 -->
                <div class="col-12 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <!-- SVG Icon -->
                            <svg style="height: 75px;" xmlns="http://www.w3.org/2000/svg" id="Layer_1"
                                data-name="Layer 1" viewBox="0 0 79.55 72.1">
                                <g>
                                    <path class="cls-1"
                                        d="M4.22,63.54a1.2,1.2,0,0,1,1.2-1.06c1,0,1-.66,1-1.35V46.26c0-4.17.07-8.34,0-12.5-.1-4.38,3.12-6,6.55-5.09,1.92.52,3.12,2.25,3.14,4.68,0,2.91,0,5.83,0,8.74,0,.31-.12.68.29,1,.47-.48.31-1.08.26-1.59-.31-3.18,1.81-5.28,5.09-5.06,2.36.16,4.74,0,7.12,0a4,4,0,0,1,4,4c0,.54,0,1.09,0,1.63s.12,1.11.95,1.09.86-.42.88-1c.09-2.16.17-2.22,2.34-2.22H59c1.93,0,2,.13,2.1,2.05,0,.46-.17,1.09.58,1.17s1.24.12,1.59-.77a3.57,3.57,0,0,1,3.88-2.46c1.35.09,2.76-.18,3.89.88a3.8,3.8,0,0,1,1.32,3c0,5.66,0,11.33,0,17,0,1,0,1.88,1.37,1.72.34,0,.55.33.8.55,0,2,0,2-2,2q-33.39,0-66.78,0C4.42,65.08,3.94,64.81,4.22,63.54Zm43.7-20.92c-3.16,0-6.33,0-9.49,0-.66,0-1.13.09-1.12.93,0,4.49,0,9,0,13.48a1.81,1.81,0,0,0,2.08,1.92q8.49,0,17,0c1.5,0,2-.5,2-2,0-4.32,0-8.65,0-13,0-1.07-.38-1.34-1.38-1.32C54,42.65,51,42.62,47.92,42.62ZM25.22,56.7c2.75,0,5.5,0,8.25,0,.86,0,1.19-.26,1.18-1.15,0-2.87,0-5.75,0-8.62,0-.83-.33-1.08-1.12-1.08q-8.19,0-16.38,0c-.79,0-1.11.26-1.1,1.08,0,2.88,0,5.75,0,8.63,0,.89.33,1.15,1.18,1.14C19.89,56.67,22.56,56.7,25.22,56.7ZM9.05,47.4V59.77c0,2.69,0,2.62,2.74,2.71,1.26,0,1.63-.34,1.62-1.61-.06-8.87,0-17.74,0-26.61a4.86,4.86,0,0,0-.18-1.6,2.06,2.06,0,0,0-3.27-1.1,2.64,2.64,0,0,0-.87,2.35C9.05,38.41,9.06,42.9,9.05,47.4ZM39.5,62.45H61.1c1.83,0,1.84,0,1.79-1.88,0-.43.16-1-.46-1.13s-1.47-.4-2,.37a4,4,0,0,1-3.82,1.82c-5.87,0-11.74,0-17.61,0a4.1,4.1,0,0,1-3.49-1.55,2,2,0,0,0-1.72-.74c-5.46,0-10.91,0-16.36,0-1.22,0-1.45.42-1.46,1.52s.21,1.62,1.5,1.61C24.84,62.42,32.17,62.45,39.5,62.45Zm30.14-9.54c0-2.87,0-5.74,0-8.61a1.51,1.51,0,0,0-.93-1.6c-1.79-.71-3.15.24-3.15,2.18,0,4.91,0,9.82,0,14.73,0,3.29-.61,2.77,2.94,2.85.89,0,1.15-.34,1.14-1.18C69.62,58.49,69.64,55.7,69.64,52.91ZM24.72,43.19c1.42,0,2.83,0,4.24,0,.84,0,1.27-.22,1.18-1.12,0-.33,0-.67,0-1,0-1.44-.51-1.95-1.95-2-2.33,0-4.66,0-7,0a1.9,1.9,0,0,0-1.66.91c-.39.51-.16,1.12-.24,1.69-.14,1.11.24,1.59,1.44,1.51S23.39,43.19,24.72,43.19Zm38.17,8.06c0-1.46,0-2.91,0-4.36,0-.64-.14-1-.89-1s-.95.3-.95,1q0,4.41,0,8.84c0,.63.14,1,.89,1s1-.43.95-1.11C62.88,54.15,62.89,52.7,62.89,51.25Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M33.22,6c1.08.67,1,1.51.33,2.41s-1.57,2-2.41,3.07a3.26,3.26,0,0,0,1.66.18A1.19,1.19,0,0,1,34,12.73a1.13,1.13,0,0,1-.68,1.33,2.37,2.37,0,0,1-1.31.3H28.77c-.72,0-1.5,0-1.8-.8a2,2,0,0,1,.52-2.07c.74-.87,1.44-1.78,2.19-2.72-3-.51-3.48-1.16-2.21-2.75Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M43.2,15.35c-.69,0-1.14,0-1.6,0a1.14,1.14,0,0,1-1.2-1.16c-.08-.74.22-1.3.92-1.39a20.35,20.35,0,0,1,5.23,0A1.32,1.32,0,0,1,47.26,15c-.62.87-1.32,1.7-2,2.54-.18.22-.52.41-.42.71s.58.18.88.23a2.77,2.77,0,0,0,.5,0c.78,0,1.28.35,1.31,1.18S47.2,21,46.45,21a37.61,37.61,0,0,1-5,0c-1-.09-1.37-1.23-.77-2.24C41.39,17.62,42.5,16.76,43.2,15.35Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M33,26.83a2.31,2.31,0,0,0-1.46-.21,1.21,1.21,0,0,1-1.4-1.25A1.24,1.24,0,0,1,31.36,24a32.85,32.85,0,0,1,4.86,0c1.22.11,1.49,1.48.59,2.64-.73.94-1.5,1.86-2.38,3,.61,0,1,.07,1.48.07.92,0,1.4.42,1.39,1.36A1.18,1.18,0,0,1,36,32.36c-1.41,0-2.83,0-4.24,0a1.58,1.58,0,0,1-1.44-.84,1.35,1.35,0,0,1,.3-1.6C31.38,28.91,32.19,27.91,33,26.83Z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div style="margin-right: 2%">
                            <h3 class="h5">{{ __('dashboard.rich_in_antioxidants') }}</h3>
                            <p>{{ __('dashboard.rich_in_antioxidants_description') }}</p>
                        </div>
                    </div>
                </div>
                <!-- Icon Box 3 -->
                <div class="col-12 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <!-- SVG Icon -->
                            <svg style="height: 75px;" xmlns="http://www.w3.org/2000/svg" id="Layer_1"
                                data-name="Layer 1" viewBox="0 0 70.26 68.84">
                                <title>Benifets of honey icons (1)</title>
                                <g>
                                    <path class="cls-1"
                                        d="M4,42.41a1.12,1.12,0,0,1,1.33-.64c1.85.31,3.7.64,5.55,1,.83.15,1,.43,1.06,1.3,0,1,0,1.09,1,.63a11.81,11.81,0,0,1,4.75-1A39.87,39.87,0,0,1,27,44.74c3,.63,6,1.22,9,1.82a1.82,1.82,0,0,1,.88.4c.61.58,1.21,1.17,1.79,1.79a1.51,1.51,0,0,1,.39,1.07c0,.8,0,1.6,0,2.41,0,1-.32,1.33-1.31,1.33H28.57c1.29.72,2.49,1.32,3.61,2a4.77,4.77,0,0,0,3,.72,13.53,13.53,0,0,1,1.91,0,18.58,18.58,0,0,0,7.23-1.09c3.27-1,6.58-2,9.89-2.89a3.38,3.38,0,0,1,4,2.26,3.44,3.44,0,0,1-2,4.31L43.64,63.37l-2.49.88h-15c-3.19-1.06-6.38-2.11-9.55-3.2a9.85,9.85,0,0,0-3.83-.73c-.56,0-.81.13-.78.76,0,.79-.28,1.11-1,1.25l-5.55,1A1.13,1.13,0,0,1,4,62.65Zm29.58,19.7h6.6a2.31,2.31,0,0,0,.73-.08l12.27-4.34c.73-.26,1.48-.5,2.19-.8a1.26,1.26,0,1,0-.84-2.37c-3.36,1-6.71,2-10.08,2.93a15.52,15.52,0,0,1-5,1.06c-1.78-.08-3.57,0-5.36,0a4.42,4.42,0,0,1-2.39-.67l-7.51-4.17c-.65-.36-.94-.82-.82-1.37s.51-.8,1.32-.8c3.84,0,7.69,0,11.53,0,.53,0,.73-.14.71-.69a3,3,0,0,0-2.25-2.32c-4-.8-8.07-1.58-12.09-2.43a34,34,0,0,0-6.38-.26,1.28,1.28,0,0,0-.52.15c-1,.42-2.09.86-3.14,1.25a.81.81,0,0,0-.6.91c0,3.12,0,6.25,0,9.37,0,.62.14.82.79.81a9.25,9.25,0,0,1,3.22.26c3.33,1.15,6.68,2.24,10,3.36a3.81,3.81,0,0,0,1.2.19ZM6.16,52.44c0,2.61,0,5.21,0,7.82,0,.54.16.68.7.56a19.56,19.56,0,0,1,2.41-.41c.46,0,.52-.26.51-.64,0-.72,0-1.44,0-2.16,0-4.08,0-8.17,0-12.26,0-.43-.09-.67-.57-.73-.85-.11-1.69-.28-2.54-.43-.39-.07-.53.06-.52.48Q6.17,48.55,6.16,52.44Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M33.38,5.9,47.66,9.69c.8.21,1.06.53,1.06,1.34,0,4.4.07,8.8,0,13.19a22.4,22.4,0,0,1-1.85,8.16,19.33,19.33,0,0,1-5,7.08,13.15,13.15,0,0,1-7.28,3.38,12.41,12.41,0,0,1-9.31-2.66,17.35,17.35,0,0,1-4.8-5.69,24.74,24.74,0,0,1-2.79-8.9,17.12,17.12,0,0,1-.14-2.15c0-4.09,0-8.18,0-12.27,0-.94.17-1.21,1.06-1.45l8.89-2.38L32.88,5.9ZM19.73,18.67c.1,1.83-.13,4.09.1,6.35a21.93,21.93,0,0,0,2.5,8.28A14.36,14.36,0,0,0,29,39.86a9.72,9.72,0,0,0,8.83-.24,14.85,14.85,0,0,0,6.25-6.49,23.1,23.1,0,0,0,2.57-10.39c.09-3.49,0-7,0-10.48a.59.59,0,0,0-.51-.69Q40.23,10,34.31,8.4a3.51,3.51,0,0,0-1.93-.12q-6.06,1.65-12.14,3.25c-.42.11-.53.32-.52.74C19.74,14.26,19.73,16.25,19.73,18.67Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M62.24,15.77c-.43,0-.86,0-1.29,0s-.55.11-.51.5v.06c0,.44.21,1-.14,1.29s-1.11.1-1.67.12c-.31,0-.35-.2-.38-.45,0-.48.22-1.08-.15-1.41s-.91,0-1.37-.11c-.83-.12-.38-.78-.42-1.18s-.32-.92.42-1c.48-.05,1.08.21,1.41-.15s.09-.9.11-1.37c0-.3.12-.47.44-.45h.24c1.45,0,1.47,0,1.5,1.42,0,.45.17.58.59.56s.81,0,1.22,0Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M4,13.67c.48,0,1-.05,1.42,0s.55-.11.51-.49V13c0-1.42.25-1.59,1.69-1.36.3,0,.35.21.38.46.05.48-.23,1.08.14,1.41s.92.05,1.38.11c.83.12.38.78.42,1.18s.32.92-.42,1c-.48,0-1.08-.22-1.42.14s-.06.91-.11,1.37c0,.06,0,.14,0,.18-.44.59-1.05.17-1.58.27-.29.06-.46-.11-.45-.42s0-.46,0-.68c0-.86,0-.86-.89-.86l-1,0Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M54.47,5.9c0,.47.05.94,0,1.41s.11.55.49.52h.07c.44,0,1-.21,1.29.13s.1,1.11.12,1.68c0,.3-.2.35-.45.37-.47,0-1-.19-1.37.11s-.08.9-.15,1.35c0,0,0,.1,0,.12-.45.56-1.06.16-1.59.26-.31.06-.45-.13-.44-.44v-.18c0-1.2,0-1.22-1.27-1.21-.53,0-.73-.13-.72-.69,0-1.45,0-1.47,1.43-1.49.45,0,.58-.18.56-.59s0-.9,0-1.35Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M13.76,5.9c0,.47.05.94,0,1.41s.11.55.49.52h.06c.45,0,1.05-.21,1.3.13s.1,1.11.12,1.68c0,.3-.2.35-.45.37-.47,0-1-.19-1.38.11s-.07.9-.14,1.35c0,0,0,.1,0,.12-.45.56-1.06.16-1.59.26-.31.06-.46-.13-.44-.44a1.09,1.09,0,0,0,0-.18c0-1.2,0-1.22-1.26-1.21-.53,0-.73-.13-.72-.69,0-1.45,0-1.47,1.43-1.49.44,0,.57-.18.56-.59s0-.9,0-1.35Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M10.87,36.17H10.8c-1,0-1,0-1-1s0-1-1-1-1,0-1-1v-.06c0-1.24-.12-1.1,1.13-1.11.84,0,.84,0,.84-.85,0-.18,0-.37,0-.55s.13-.46.44-.45h.25c1.4,0,1.42,0,1.49,1.36,0,.39.17.48.52.49,1.34.05,1.31.06,1.35,1.41,0,.64-.21.86-.81.77-.14,0-.29,0-.43,0-.49-.06-.69.15-.63.63a2.09,2.09,0,0,1,0,.25C11.94,36.27,12.07,36.16,10.87,36.17Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M55.39,36.17h-.12c-1,0-1,0-1-1a2.67,2.67,0,0,1,0-.49c0-.36-.13-.5-.5-.52-1.37-.06-1.35-.07-1.37-1.44,0-.54.14-.82.73-.74.12,0,.24,0,.36,0,.64.1.87-.18.78-.79,0-.12,0-.25,0-.37-.07-.54.16-.71.7-.7,1.4,0,1.4,0,1.48,1.38,0,.33.13.5.48.48h.12c.44.06,1.05-.22,1.28.16s.09,1.11.09,1.68c0,.33-.25.32-.48.34-.46.05-1-.2-1.36.13s-.11.86-.11,1.31-.16.56-.55.54a5.19,5.19,0,0,0-.56,0Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M16.66,36h.06c1,0,1,0,1,1s0,1,1,1,1,0,1,1c0,.18,0,.37,0,.55s-.1.48-.45.5-1.08-.22-1.42.15-.07.9-.1,1.37c0,.3-.13.46-.44.45h-.25c-1.44,0-1.45,0-1.48-1.42,0-.45-.19-.55-.6-.56-1.47,0-1.46,0-1.39-1.52,0-.41.17-.53.55-.54s1,.2,1.31-.12.1-.86.11-1.3.14-.58.54-.55a5.23,5.23,0,0,0,.56,0Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M49.6,42h-.13c-1,0-1,0-1-1,0-.16,0-.33,0-.49,0-.37-.13-.5-.5-.52-1.4-.06-1.37-.07-1.36-1.44,0-.5.2-.62.66-.62,1.19,0,1.22,0,1.18-1.21,0-.6.18-.78.77-.77,1.4,0,1.41,0,1.42,1.39,0,.45.14.6.6.61,1.44,0,1.42,0,1.39,1.47,0,.47-.2.58-.63.59-1.32,0-1.32,0-1.35,1.3C50.68,42,50.68,42,49.6,42Z">
                                    </path>
                                    <path class="cls-1"
                                        d="M24.33,24.42V22.64a2,2,0,0,1,2.19-2.23c.13,0,.25,0,.37,0,.72-.05,1.63.3,2.09-.14s.11-1.37.16-2.08a5,5,0,0,1,.09-1.09A1.9,1.9,0,0,1,31,15.61q2.16,0,4.32,0a2,2,0,0,1,1.77,1.82c0,.81,0,1.61,0,2.41,0,.42.14.59.57.58.74,0,1.48,0,2.22,0a2,2,0,0,1,2,2.08c0,1.31,0,2.63,0,3.94a1.86,1.86,0,0,1-2,2H38c-.92,0-.92,0-.92.89v1.79A1.89,1.89,0,0,1,35,33.2H31.12a2,2,0,0,1-2-1.94q0-1.17,0-2.34c0-.4-.15-.54-.54-.53-.74,0-1.48,0-2.22,0a2,2,0,0,1-2.05-2.05C24.32,25.7,24.33,25.06,24.33,24.42Zm8.8-6.64c-.41,0-.83,0-1.23,0s-.6.12-.58.56c0,.72,0,1.44,0,2.16a2,2,0,0,1-2.08,2.09c-.74,0-1.48,0-2.22,0-.36,0-.52.12-.51.5,0,.88,0,1.77,0,2.65,0,.34.14.48.48.47.67,0,1.35,0,2,0a2.08,2.08,0,0,1,2.3,2.28c0,.72,0,1.44,0,2.15,0,.38.14.51.51.51.86,0,1.73,0,2.59,0,.42,0,.53-.18.52-.56,0-.63,0-1.27,0-1.91a2.17,2.17,0,0,1,2.44-2.47c.64,0,1.27,0,1.91,0,.41,0,.6-.11.59-.55,0-.84,0-1.69,0-2.53,0-.4-.14-.55-.54-.54-.76,0-1.52,0-2.28,0A1.92,1.92,0,0,1,35,21,9.59,9.59,0,0,1,35,18.46c0-.55-.18-.73-.71-.68C33.87,17.81,33.5,17.78,33.13,17.78Z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div style="margin-right: 2%">
                            <h3 class="h5">{{ __('dashboard.supports_digestion') }}</h3>
                            <p>{{ __('dashboard.supports_digestion_description') }}</p>
                        </div>
                    </div>
                </div>
                <!-- Icon Box 4 -->
                <div class="col-12 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <!-- SVG Icon -->
                            <svg style="height: 75px;" xmlns="http://www.w3.org/2000/svg" id="Layer_1"
                                data-name="Layer 1" viewBox="0 0 68.01 70.3">
                                <path
                                    d="M60.61,14.07V62.79H8.13V14.15c1.9,0,3.73,0,5.56,0a3.83,3.83,0,0,0,1.87-.57A32,32,0,0,1,26.41,8.66c1.39-.33,2.8-.56,4.2-.83h5.52a1.09,1.09,0,0,0,.33.15,31.54,31.54,0,0,1,15.25,5.87,1.59,1.59,0,0,0,.87.33C55.26,14.16,57.93,14.11,60.61,14.07ZM9.78,15.78V61.06H58.86V15.81c-2.22,0-4.33,0-6.45,0a3,3,0,0,1-1.52-.51C40,7.52,26.88,7.51,16,15.26a3,3,0,0,1-1.52.5C12.93,15.82,11.38,15.78,9.78,15.78Z">
                                </path>
                                <path d="M56.68,58.85H11.93V17.49h5.65V19H13.5V57.2H55.06V35h1.62Z"></path>
                                <path
                                    d="M48.15,16.53l-5.7,12a27.27,27.27,0,0,0-17.73,0l-5.83-12C28.71,11.56,38.36,11.56,48.15,16.53Zm-15.26,4c.84,1.48,1.58,2.84,2.38,4.18a1.63,1.63,0,0,0,.81.77c1.82.35,3.66.62,5.56.92L46,17.29l-2.45-1L42.23,19l-1.42-.7,1.12-2.55L39,15l-.44,2.77L37,17.58l.22-2.91-2.89-.2v3.71H32.69V14.46l-3,.23.24,2.91-1.53.1L27.94,15,25,15.75l1.11,2.52-1.44.64-1.3-2.56-2.29.94,4.41,9.09,8.11-1.15-2.15-3.89Z">
                                </path>
                                <path d="M49.47,19.08V17.52h7.2V29H55.11V19.08Z"></path>
                                <path d="M55.16,32.88V31h1.52v1.85Z"></path>
                                <path d="M50.17,20.83h1.48v1.56H50.17Z"></path>
                                <path d="M16.58,52.86H15.1V51.35h1.48Z"></path>
                                <path d="M19.29,55.54H17.82V54h1.47Z"></path>
                                <path d="M51.69,24.07v1.47H50.15V24.07Z"></path>
                                <path d="M22,52.84H20.58V51.32H22Z"></path>
                                <path d="M19.33,48.58v1.47H17.79V48.58Z"></path>
                            </svg>
                        </div>
                        <div style="margin-right: 2%">
                            <h3 class="h5">{{ __('dashboard.promotes_wound_healing') }}</h3>
                            <p>{{ __('dashboard.promotes_wound_healing_description') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Instagram Reels Section -->
    <div class="title4">
        <h4>{{ __('dashboard.instagram') }} <span>{{ __('dashboard.Reel') }}</span></h4>
    </div>

    <section class="theme-slider section-pt-space">
        <div class="custom-container">
            <div class="row">
                <div class=" ">
                    <!-- Slick Slider Wrapper -->
                    <div class="slide-4">
                        @foreach ($reels as $reel)
                            <div class="iphone-frame">
                                <div class="reel-container">
                                    <video class="reel-video" loop>
                                        <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <div class="reel-overlay" dir="rtl">
                                        <p class="reel-user-info mb-1">
                                            <img src="{{ $logo }}" alt="" style="width: 20%">
                                        </p>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .slide-4 {
            width: 100%;
            height: 100%;
        }

        /* Slick Slider slide */
        .slick-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 10px;
            /* Add margin to create space between slides */
        }

        /* iPhone Frame */
        .iphone-frame {
            width: 420px;
            height: 720px;
            border: 2px solid #000;
            border-radius: 50px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            margin-bottom:30px;
            margin-top:30px;
        }

        /* iPhone Notch */
        .iphone-frame::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 160px;
            height: 30px;
            background-color: #000;
            border-radius: 15px;
            z-index: 10;
        }

        /* Reels Content */
        .reel-container {
            width: 100%;
            height: 100%;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Overlay for Reels Text and Icons */
        .reel-overlay {
            position: absolute;
            bottom: 20px;
            width: 90%;
            color: #fff;
            z-index: 2;
            font-family: Arial, sans-serif;
        }

        .reel-user-info {
            font-size: 14px;
            line-height: 1.5;
        }

        .reel-actions {
            position: absolute;
            right: 10px;
            bottom: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .reel-actions button {
            background-color: transparent;
            border: none;
            font-size: 20px;
            color: #fff;
            cursor: pointer;
        }

        .action-count {
            font-size: 12px;
        }

        /* Bottom Navigation Bar */
        .bottom-bar {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            color: #fff;
        }

        .bottom-bar button {
            background-color: transparent;
            border: none;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var videos = document.querySelectorAll('.reel-video');
            var currentlyPlaying = null;
            videos.forEach(function(video) {
                video.addEventListener('click', function() {
                    if (currentlyPlaying && currentlyPlaying !== video) {
                        currentlyPlaying.pause();
                    }
                    if (video.paused) {
                        video.play();
                        currentlyPlaying = video;
                    } else {
                        video.pause();
                        currentlyPlaying = null;
                    }
                });
            });

        });
    </script>
    <!-- Banner Image Section -->
    <section class="banner-image-section">
        <img src="http://royalbee.ae/uploads/sliders/173275210642159.jpg"  alt="Banner Image"
            class="img-fluid">
    </section>
<style>
    .banner-image-section{
        width: 100% !important;
    padding: 20px;
    border-radius: 50px;
    }
    @media (max-width: 576px) {
    .banner-image-section{
        margin-top:50px;
    }
}

</style>

    <!--title start-->
    <div class="title4">
        <h4>{{ __('Best') }} <span>{{ __('Seller') }}</span></h4>
    </div>
    <!--title end-->


    <!--product box start -->
    <livewire:best-seller-product />
    <!--product box end-->

    <!--tab product-->
    <!-- Tab Navigation -->
    <section class="section-pt-space">
        <div class="tab-product-main">
            <div class="tab-prodcut-contain">
                <ul class="tabs tab-title">
                    @foreach ($collections as $index => $collection)
                        <li class="{{ $index === 0 ? 'current' : '' }}">
                            <a href="{{ route('web.category.show', $collection->slug) }}"
                                data-collection-id="{{ $collection->id }}">
                                {{ app()->getLocale() == 'ar' ? $collection->name_ar : $collection->name_en }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <!-- Tab Content -->
    <section class="section-pt-space ratio_square">
        <div class="custom-container addtocart_count">
            <div class="row">
                <div class="col pr-0">
                    <div class="theme-tab product no-arrow mb--5">
                        <div class="tab-content-cls">
                            <div id="tab-1" class="tab-content active default product">
                                <div class="product-slide-6 no-arrow" id="product-list">
                                    <!-- The content for each tab will be loaded here via AJAX -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- product tab end -->

    @if ($blogs->count() > 0)
        <!--title start-->
        <div class="title4 ">
            <h4>{{ __('latest') }} <span>{{ __('blog') }}</span></h4>
        </div>
        <!--title end-->

        <!--blog start-->
        <section class="blog section-big-mb-space mb--5 ">
            <div class="custom-container">
                <div class="row">
                    <div class="col pr-0">
                        <div class="blog-slide-4 no-arrow">
                            @forelse ($blogs as $blog)
                                <div>
                                    <div class="blog-contain">
                                        <div class="blog-img">
                                            <a href="{{ route('web.blogDetail', $blog->slug) }}">
                                                <img src="{{ asset($blog->image) }}"
                                                    alt="{{ app()->getLocale() == 'ar' ? $blog->title_ar : $blog->title_en }}"
                                                    class="img-fluid w-100">
                                            </a>
                                        </div>
                                        <div class="blog-details-2">
                                            <a href="">
                                                <h4>{{ app()->getLocale() == 'ar' ? $blog->title_ar : $blog->title_en }}
                                                </h4>
                                            </a>
                                            <p>{!! substr(app()->getLocale() == 'ar' ? $blog->content_ar : $blog->content_en, 0, 200) !!}
                                                {{ strlen(app()->getLocale() == 'ar' ? $blog->content_ar : $blog->content_en) > 100 ? '...' : '' }}
                                            </p>
                                            {{-- <ul>
                                                <li>
                                                    <a href="javascript:void(0)"><i class="fa fa-user-md"></i>Donec lacinia</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)"><i class="fa fa-comments"></i>comants</a>
                                                </li>
                                            </ul> --}}
                                        </div>
                                        <div class="blog-label1">
                                            {{ $blog->created_at->format('d') }} <br>
                                            {{ $blog->created_at->format('M') }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <style>
        .slider-banner .slider-img {
            background-size: contain !important;
        }
    </style>
    <!--blog end-->
    <script>
        $('.slide-1').slick({
            autoplay: true,
            autoplaySpeed: 2500,
            arrows: true, // Add arrows for navigation
        });

        $('.slide-1-section').slick({
            dots: false,
            infinite: true, // Set to true for seamless autoplay
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true, // Enable autoplay
            autoplaySpeed: 2500, // Set autoplay speed
            arrows: true, // Add arrows for navigation
            responsive: [{
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 490,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>
@endsection
