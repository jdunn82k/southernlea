@extends('layouts.admin')

@section('content')

    <div id="page-wrapper">
        <div class="main-page login-page ">
            <h2 class="title1">Login</h2>
            <div class="widget-shadow">
                <div class="login-body">
                    <form method="POST" action="{{ URL::to('/admin') }}" aria-label="{{ __('Login') }}">
                        {{csrf_field()}}
                        <input type="email" class="user" name="email" placeholder="Enter Your Email" required>
                        <input type="password" name="password" class="lock" placeholder="Password" required>
                        <div class="forgot-grid">
                            <label class="checkbox"><input type="checkbox" name="remember"><i></i>Remember me</label>
                            <div class="forgot">
                                <a href="{{ route('password.request') }}">forgot password?</a>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <input type="submit" name="Sign In" value="Sign In">
                    </form>
                </div>
            </div>

        </div>
    </div>


    {{--<div class="container">--}}
        {{--<div class="mx-auto text-center">--}}
            {{--<img src="{{URL::to('img/main-01.jpg')}}" width="300px" alt="">--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<form method="POST" class='admin-login' action="{{ URL::to('/admin') }}" aria-label="{{ __('Login') }}">--}}
                {{--{{csrf_field()}}--}}
                {{--<div class="form-group row">--}}
                    {{--<label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                    {{--<div class="col-md-6">--}}
                        {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>--}}

                        {{--@if ($errors->has('email'))--}}
                            {{--<span class="invalid-feedback" role="alert">--}}
                                {{--<strong>{{ $errors->first('email') }}</strong>--}}
                            {{--</span>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group row">--}}
                    {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                    {{--<div class="col-md-6">--}}
                        {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

                        {{--@if ($errors->has('password'))--}}
                            {{--<span class="invalid-feedback" role="alert">--}}
                                {{--<strong>{{ $errors->first('password') }}</strong>--}}
                            {{--</span>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group row">--}}
                    {{--<div class="col-md-6 offset-md-4">--}}
                        {{--<div class="form-check">--}}
                            {{--<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                            {{--<label class="form-check-label" for="remember">--}}
                                {{--{{ __('Remember Me') }}--}}
                            {{--</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group row mb-0">--}}
                    {{--<div class="col-md-8 offset-md-4">--}}
                        {{--<button type="submit" class="btn btn-primary">--}}
                            {{--{{ __('Login') }}--}}
                        {{--</button>--}}

                        {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                            {{--{{ __('Forgot Your Password?') }}--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</form>--}}

        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
