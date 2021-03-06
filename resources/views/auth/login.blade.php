@extends('layouts.site')
@section('content')
    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow">
        <div class="row">
            <div class="col-full s-content__main">
                <h3 class="add-bottom">Login Or <a href="/register">Register</a></h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-field">
                        <label for="email">{{ __('Username or Email') }}</label>
                            <input id="login" type="text"
                                   class="full-width form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="login" value="{{ old('username') ?: old('email') }}"  autofocus>
                    </div>
                    <div class="form-field">
                        <label for="password">{{ __('Password') }}</label>
                        <input class="full-width" id="password" type="password" class="form-control
                            @error('password') is-invalid @enderror"
                               name="password"  autocomplete="current-password">
                    </div>
                    <label class="add-bottom">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </label>
                    <input class="btn--primary full-width" type="submit" value="Submit">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link full-width" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </section> <!-- s-content -->
@endsection
