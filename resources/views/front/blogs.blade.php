@extends('front.layouts.app')
@section('content')
    <div class="breadcrumb-main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-contain">
                        <div>
                            <h2>{{__('Blog')}}</h2>
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

    <section class="section-big-py-space blog-page ratio2_3">
        <div class="custom-container">
            <div class="row">
                    <livewire:blogs/>
            </div>
        </div>
    </section>
@endsection
