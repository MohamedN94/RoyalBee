@extends('front.layouts.app')
@push('styles')
<style>
    .error_sms {
        color: #cc1616;
        background-color: rgba(239, 19, 32, 0.1);
        font-size: 0.8rem;
        padding: 3px 9px;
        border-radius: 3px;
        width: 100%;
        display: none;
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
                            <h2>register</h2>
                            <ul>
                                <li><a href="index.html">home</a></li>
                                <li><i class="fa fa-angle-double-right"></i></li>
                                <li><a href="javascript:void(0)">register</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->

    <!--section start-->
    <section class="login-page section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="theme-card">
                        <h3 class="text-center">Create account</h3>
                        <form class="theme-form" action="{{route('web.signup')}}" method="post" id="registerForm">
                            @csrf
                            @method('POST')
                            <div class="row g-3">
                                <div class="col-md-12 form-group">
                                    <label for="email">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="fname"
                                           placeholder="First Name">
                                    <label id="register_first_name" class="error_sms"
                                           style="display: none"></label>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="review">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" id="lname"
                                           placeholder="Last Name">
                                    <label id="register_last_name" class="error_sms"
                                           style="display: none"></label>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-12 form-group">
                                    <label>email</label>
                                    <input type="text" name="email" class="form-control" placeholder="Email">
                                    <label id="register_email" class="error_sms"
                                           style="display: none"></label>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control"
                                           placeholder="Enter your password">
                                    <label id="register_password" class="error_sms"
                                           style="display: none"></label>
                                </div>
                                <div class="col-md-12 form-group">
                                    <button id="register_button" class="btn btn-solid btn-md btn-block">create
                                        Account
                                    </button>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-12 ">
                                    <p>Have you already account? <a href="{{route('web.login')}}" class="txt-default">click</a>
                                        here
                                        to &nbsp;<a
                                            href="{{route('web.login')}}" class="txt-default">Login</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->
@endsection


