@extends('front.layouts.app')
@section('content')
    <div class="breadcrumb-main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-contain">
                        <div>
                            <h2>{{__('Pages')}}</h2>
                            <ul>
                                <li><a href="{{route('web.home')}}">{{__('Home')}}</a></li>
                                <li><i class="fa fa-angle-double-right"></i></li>
                                <li><a href="javascript:void(0)">{{__('About us')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="about-page section-big-py-space">
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="banner-section"><img src="{{asset('front/assets/images/blog/1.jpg')}}"
                                                     class="img-fluid   w-100" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    @if(app()->getLocale() == 'ar')
                        {!! $page->description_ar !!}
                    @else
                        {!! $page->description_en !!}
                    @endif
                </div>
            </div>
        </div>
    </section>    <!-- footer start -->
@endsection
