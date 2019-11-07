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
                    @auth
                        @if(Auth::id() === $user->id || Auth::user()->isAdmin === 1)
                            <a class="btn full-width" href="{!! route('profiles.edit', [$user->id]) !!}">Edit User</a>
                        @endif
                    @endauth
                </div>


            </div> <!-- end s-content__main -->

        </div> <!-- end row -->

        <hr>
        @auth
            <div class="row">

                <div class="s-content__header col-full">
                    <h1 class="s-content__header-title">
                        {!! $user->fullName; !!} Favorites
                    </h1>
                </div> <!-- end s-content__header -->

                <div class="col-full s-content__main">

                    <div class="row block-1-2 block-tab-full">
                        @forelse($blogs as $blog)
                            <div class="col-block">
                                <h3 class="quarter-top-margin"><a href="/blogs/{!! $blog->id; !!}">{!! $blog->title; !!}</a></h3>
                                <p>Blog</p>
                            </div>
                        @empty
                            <p>
                                Noting To Show
                            </p>
                        @endforelse
                    </div>

                    <div class="row block-1-2 block-tab-full">
                        @forelse($exercises as $exercise)
                            <div class="col-block">
                                <h3 class="quarter-top-margin"><a href="/exercises/{!! $exercise->id; !!}">{!! $exercise->title; !!}</a></h3>
                                <p>Recipes</p>
                            </div>
                        @empty
                            <p>
                                Noting To Show
                            </p>
                        @endforelse
                    </div>


                </div> <!-- end s-content__main -->

            </div> <!-- end row -->
        @endauth
    </section> <!-- s-content -->
@endsection
