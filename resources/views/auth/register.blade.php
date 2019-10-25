@extends('layouts.site')
@section('content')
    <!-- pageheader
================================================== -->
    <section class="s-pageheader s-pageheader--home">
        @include('include.menu')
    </section> <!-- end s-pageheader -->

    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow">
        <div class="row">
            <div class="col-full s-content__main">
                <h3 class="add-bottom">Register  Or <a href="/login">Login</a></h3>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-field">
                        <label for="fullName">{{ __('Full Name') }}</label>
                            <input id="fullName" type="text" class="full-width form-control @error('fullName') is-invalid @enderror" name="fullName" value="{{ old('fullName') }}" required autocomplete="fullName" autofocus>
                            @error('fullName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                    <div class="form-field">
                        <label for="username">{{ __('Username') }}</label>
                            <input id="username" type="text" class="full-width form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                    <div class="form-field">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="full-width form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                    <div class="form-field">
                        <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="full-width form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                    <div class="form-field">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="full-width form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="form-field">
                            <button type="submit" class="btn btn-primary full-width ">
                                {{ __('Register') }}
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </section> <!-- s-content -->
@endsection
