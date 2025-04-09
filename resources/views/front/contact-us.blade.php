@extends('front.layouts.app')
@section('content')
    <div class="breadcrumb-main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-contain">
                        <div>
                            <h2>{{__('Contact us')}}</h2>
                            <ul>
                                <li><a href="{{route('web.home')}}">{{__('Home')}}</a></li>
                                <li><i class="fa fa-angle-double-right"></i></li>
                                <li><a href="javascript:void(0)">{{__('Contact us')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="contact-page section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="row section-big-pb-space">
                <div class="col-xl-6 offset-xl-3">
                    <h3 class="text-center mb-3">{{__('Get in touch')}}</h3>
                    <form class="theme-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{__('First Name')}}</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="name"
                                        placeholder="{{__('Enter Your name')}}"
                                        required=""
                                    />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{__('Last Name')}}</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="last-name"
                                        placeholder="{{__('Last Name')}}"
                                        required=""
                                    />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="review">{{__('Phone Number')}}</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="review"
                                        placeholder="{{__('Enter your number')}}"
                                        required=""
                                    />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('Email')}}</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="{{__('Email')}}"
                                        required=""
                                    />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label>{{__('Write Your Message')}}</label>
                                    <textarea
                                        class="form-control"
                                        placeholder="{{__('Write Your Message')}}"
                                        rows="2"
                                    ></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-normal" type="submit">
                                    {{__('Send Your Message')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 map">
                    <div class="theme-card">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1605.811957341231!2d25.45976406005396!3d36.3940974010114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1550912388321"
                            allowfullscreen=""
                        ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
