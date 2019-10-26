@extends('layouts.site')
@section('content')
    <!-- styles
        ================================================== -->
    <section id="styles" class="s-styles">
        <div class="row add-bottom">
            @include('flash::message')
            <div class="row">

                <div class="col-full s-content__main">

                    <h3 class="add-bottom">Profile</h3>
                    <div>
                        {!! $user->fullName; !!}
                    </div>
                    <div>
                        {!! $user->username; !!}
                    </div>
                    <div>
                        {!! $user->email; !!}
                    </div>
                    <div>
                        {!! $user->bio; !!}
                    </div>
                    <a href="{!! route('profiles.edit', [$user->id]) !!}"> Edit</a>
                </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end row -->
    </section> <!-- end styles -->
@endsection
