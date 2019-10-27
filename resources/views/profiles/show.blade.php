@extends('layouts.site')
@section('content')
    <!-- s-content
================================================== -->
    <section class="s-content s-content--narrow">

        <div class="row">

            <div class="s-content__header col-full">
                <h1 class="s-content__header-title">
                    {!! $user->fullName; !!} Profile
                </h1>
            </div> <!-- end s-content__header -->

            <div class="s-content__media col-full">
                <div class="s-content__post-thumb">
                    <img src="{!! asset('storage/user/'.$user->pics) !!}" alt="{!! $user->pics !!}" >
                </div>
            </div> <!-- end s-content__media -->

            <div class="col-full s-content__main">

                <div class="row block-1-2 block-tab-full">
                    <div class="col-block">
                        <h3 class="quarter-top-margin">Username</h3>
                        <p>{!! $user->username; !!}</p>
                    </div>

                    <div class="col-block">
                        <h3 class="quarter-top-margin">Email</h3>
                        <p>{!! $user->email; !!}</p>
                    </div>

                    <div class="col-block">
                        <h3 class="quarter-top-margin">Biography</h3>
                        <p>{!! $user->bio; !!}</p>
                    </div>
                    <a class="btn full-width" href="{!! route('profiles.edit', [$user->id]) !!}">Edit User</a>
                </div>


            </div> <!-- end s-content__main -->

        </div> <!-- end row -->

    </section> <!-- s-content -->
@endsection
