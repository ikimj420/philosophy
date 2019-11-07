@extends('layouts.site')
@section('content')
    <!-- s-content
================================================== -->
    <section class="s-content">

        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1>Hire Is All Your's Recipes</h1>
            </div>
        </div>
        @auth
            <div class="row">
                <h1 class="pull-right">
                    <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('exercises.create') !!}">Add New Recipes</a>
                </h1>
            </div>
        @endauth
        <div class="row masonry-wrap">
            <div class="masonry">

                <div class="grid-sizer"></div>
                @forelse($exercises as $exercise)
                    <article class="masonry__brick entry format-video" data-aos="fade-up">

                            <div class="entry__thumb video-image">
                                <a href="{!! $exercise->video !!}?color=01aef0&title=0&byline=0&portrait=0" data-lity>
                                    <img src="{!! asset('/storage/exercise/'.$exercise->pics) !!}"
                                         srcset="{!! asset('/storage/exercise/'.$exercise->pics) !!} 1x, {!! asset('/storage/exercise/'.$exercise->pics) !!} 1x" alt="">
                                </a>
                            </div>

                            <div class="entry__text">
                                <div class="entry__header">

                                    <div class="entry__date">
                                        <p>{!! date_format($exercise->created_at, 'M d, Y') !!}</p>
                                    </div>
                                    <h1 class="entry__title"><a href="{!! '/exercises/'.$exercise->id !!}">{!! $exercise->title !!}</a></h1>

                                </div>
                                <div class="entry__excerpt">
                                    <p>
                                        {!! Str::limit($exercise->ingredients, 120, '... Read More') !!}
                                    </p>
                                </div>
                                <div class="entry__meta">
                                    <span class="entry__meta-links">
                                        <a href="/profiles/{!! $exercise->user_id !!}">{!! $exercise->user['fullName'] !!}</a>
                                    </span>
                                </div>
                            </div>

                        </article> <!-- end article -->
                @empty
                    <p>Noting To Show</p>
                @endforelse

            </div> <!-- end masonry -->
        </div> <!-- end masonry-wrap -->

        <div class="row">
            <div class="col-full">
                <nav class="pgn">
                    <ul>
                        {!! $exercises->links() !!}
                    </ul>
                </nav>
            </div>
        </div>

    </section> <!-- s-content -->
@endsection

