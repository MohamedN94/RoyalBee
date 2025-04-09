@extends('front.layouts.app')
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-main ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-contain">
                        <div>
                            <h2>Blog</h2>
                            <ul>
                                <li><a href="{{route('web.home')}}">{{__('Home')}}</a></li>
                                <li><i class="fa fa-angle-double-right"></i></li>
                                <li><a href="javascript:void(0)">{{__('Blog')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->

    <!--section start-->
    <section class="blog-detail-page section-big-py-space ratio2_3" style="background-color: #f9f9f9;">
        <div class="container">
            <div class="row section-big-pb-space">
                <div class="col-sm-12 blog-detail">
                    <div class="creative-card">
                        <img src="{{asset($blog->image)}}" class="img-fluid w-100 "
                             alt="{{app()->getLocale() == 'ar' ? $blog->title_ar :  $blog->title_en}}">
                        <h3>{{app()->getLocale() == 'ar' ? $blog->title_ar : $blog->title_en}}</h3>
                        <ul class="post-social">
                        </ul>
                        <p>{!! app()->getLocale() == 'ar' ? $blog->content_ar : $blog->content_en  !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->

@endsection
