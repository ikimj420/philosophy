@extends('layouts.site')
@section('content')
    <section class="s-content s-content--narrow">
        <div class="row">
            @if (session('status'))
                <div class="alert-box alert-box--success hideit">
                    <p>{{ session('status') }}</p>
                    <i class="fa fa-times alert-box__close"></i>
                </div> <!-- end success -->
            @endif
            <div class="col-full s-content__main">
                <h3 class="add-bottom">Reset Password</h3>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-field">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="full-width form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    <div class="form-field">
                        <button type="submit" class="full-width btn btn-primary">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section> <!-- s-content -->
@endsection
