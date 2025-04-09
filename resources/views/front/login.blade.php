@extends('front.layouts.app')
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-main ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-contain">
                        <div>
                            <h2>    </h2>
                            <ul>
                                <li><a href="{{route('web.home')}}">home</a></li>
                                <li><i class="fa fa-angle-double-right"></i></li>
                                <li><a href="javascript:void(0)">login</a></li>
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
                <div class="col-xl-4 col-lg-6 col-md-8 offset-xl-4 offset-lg-3 offset-md-2">
                    <div class="theme-card">
                        <h3 class="text-center">Login</h3>
                        <form class="theme-form" action="{{route('web.login')}}" method="post" id="addForm">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control input_email" placeholder="Email">
                                <label id="login_email" class="error_sms"
                                       style="display: none"></label>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control input_password"
                                       placeholder="Enter your password"
                                       name="password">
                                <label id="login_password" class="error_sms"
                                       style="display: none"></label>
                            </div>
                            <button  id="login_button" class="btn btn-normal">Login</button>
                            <a class="float-end txt-default mt-2" href="#">Forgot your password?</a>
                        </form>
                        <p class="mt-3">Sign up for a free account at our store. Registration is quick and easy. It
                            allows
                            you to be able to order from our shop. To start shopping click register.</p>
                        <a href="{{ route('web.signup.form') }}" class="txt-default pt-3 d-block">Create an Account</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->

@endsection
