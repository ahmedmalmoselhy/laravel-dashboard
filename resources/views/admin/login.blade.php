@extends('admin.layouts.auth')

@section('title', $pageTitle)

@section('content')
    <!-- Authentication card start -->

    <form class="md-float-material form-material">
        <div class="text-center">
            <img src="{{asset('admin_dashboard/assets/images/logo.png')}}" alt="logo.png">
        </div>
        <div class="auth-box card">
            <div class="card-block">
                <div class="row m-b-20">
                    <div class="col-md-12">
                        <h3 class="text-center">{{_i('Sign In')}}</h3>
                    </div>
                </div>
                <div class="form-group form-primary">
                    <input type="text" name="email" class="form-control" required="" placeholder="Your Email Address">
                    <span class="form-bar"></span>
                </div>
                <div class="form-group form-primary">
                    <input type="password" name="password" class="form-control" required="" placeholder="Password">
                    <span class="form-bar"></span>
                </div>
                <div class="row m-t-25 text-left">
                    <div class="col-12">
                        <div class="checkbox-fade fade-in-primary d-">
                            <label>
                                <input type="checkbox" value="">
                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                <span class="text-inverse">{{_i('Remember me')}}</span>
                            </label>
                        </div>
                        {{--                        <div class="forgot-phone text-right f-right">--}}
                        {{--                            <a href="auth-reset-password.htm" class="text-right f-w-600"> Forgot Password?</a>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <div class="row m-t-30">
                    <div class="col-md-12">
                        <button type="button"
                                class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">
                            {{_i('Sign in')}}
                        </button>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-10">
                        <p class="text-inverse text-left m-b-0">{{_i('Thank you')}}.</p>
                        <p class="text-inverse text-left"><a href="{{ route('home') }}"><b class="f-w-600">{{_i('Back to website')}}</b></a>
                        </p>
                    </div>
                    <div class="col-md-2">
                        <img src="{{asset('admin_dashboard/assets/images/auth/Logo-small-bottom.png')}}"
                             alt="small-logo.png">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end of form -->
@endsection
