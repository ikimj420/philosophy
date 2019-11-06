@extends('layouts.site')
@section('content')
    <!-- s-content
================================================== -->
    <section class="s-content">

        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1>Hire Is All Your's Post</h1>
            </div>
        </div>

        <div class="row">
            <h1 class="pull-right">
                <a class="btn full-width pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('blogs.create') !!}">Add New Blog</a>
            </h1>
        </div>

        <div class="row masonry-wrap">
            <div class="masonry">

                <div class="grid-sizer"></div>
                @forelse($blogs as $blog)
                    @if(!empty($blog->video))
                        <article class="masonry__brick entry format-video" data-aos="fade-up">

                            <div class="entry__thumb video-image">
                                <a href="{!! $blog->video !!}?color=01aef0&title=0&byline=0&portrait=0" data-lity>
                                    <img src="{!! asset('/storage/blog/'.$blog->pics) !!}"
                                         srcset="{!! asset('/storage/blog/'.$blog->pics) !!} 1x, {!! asset('/storage/blog/'.$blog->pics) !!} 1x" alt="">
                                </a>
                            </div>

                            <div class="entry__text">
                                <div class="entry__header">

                                    <div class="entry__date">
                                        <a href="{!! route('blogs.edit', [$blog->id]) !!}">Edit</a>
                                        <p>{!! date_format($blog->created_at, 'M d, Y') !!}</p>
                                    </div>
                                    <h1 class="entry__title"><a href="{!! '/blogs/'.$blog->id !!}">{!! $blog->title !!}</a></h1>

                                </div>
                                <div class="entry__excerpt">
                                    <p>
                                        {!! Str::limit($blog->body, 120, '... Read More') !!}
                                    </p>
                                </div>
                                <div class="entry__meta">
                                    <span class="entry__meta-links">
                                        <a href="/">{!! $blog->category->name !!}</a>
                                    </span>
                                </div>
                            </div>

                        </article> <!-- end article -->
                    @elseif(!empty($blog->audio))
                        <article class="masonry__brick entry format-audio" data-aos="fade-up">

                            <div class="entry__thumb">
                                <a href="{!! '/blogs/'.$blog->id !!}" class="entry__thumb-link">
                                    <img src="{!! asset('/storage/blog/'.$blog->pics) !!}"
                                         srcset="{!! asset('/storage/blog/'.$blog->pics) !!} 1x, {!! asset('/storage/blog/'.$blog->pics) !!} 1x" alt="">
                                </a>
                                <div class="audio-wrap">
                                    <audio id="player" src="{!! $blog->audio !!}" width="100%" height="42" controls="controls"></audio>
                                </div>
                            </div>

                            <div class="entry__text">
                                <div class="entry__header">

                                    <div class="entry__date">
                                        <a href="{!! route('blogs.edit', [$blog->id]) !!}">Edit</a>
                                        <p>{!! date_format($blog->created_at, 'M d, Y') !!}</p>
                                    </div>
                                    <h1 class="entry__title"><a href="{!! '/blogs/'.$blog->id !!}">{!! $blog->title !!}</a></h1>

                                </div>
                                <div class="entry__excerpt">
                                    <p>
                                        {!! Str::limit($blog->body, 120, '... Read More') !!}
                                    </p>
                                </div>
                                <div class="entry__meta">
                                    <span class="entry__meta-links">
                                        <a href="/">{!! $blog->category->name !!}</a>
                                    </span>
                                </div>
                            </div>

                        </article> <!-- end article -->
                    @else
                        <article class="masonry__brick entry format-standard" data-aos="fade-up">

                            <div class="entry__thumb">
                                <a href="{!! '/blogs/'.$blog->id !!}" class="entry__thumb-link">
                                    <img src="{!! asset('/storage/blog/'.$blog->pics) !!}"
                                         srcset="{!! asset('/storage/blog/'.$blog->pics) !!} 1x, {!! asset('/storage/blog/'.$blog->pics) !!} 1x" alt="">
                                </a>
                            </div>

                            <div class="entry__text">
                                <div class="entry__header">

                                    <div class="entry__date">
                                        <a href="{!! route('blogs.edit', [$blog->id]) !!}">Edit</a>
                                        <p>{!! date_format($blog->created_at, 'M d, Y') !!}</p>
                                    </div>
                                    <h1 class="entry__title"><a href="{!! '/blogs/'.$blog->id !!}">{!! $blog->title !!}</a></h1>

                                </div>
                                <div class="entry__excerpt">
                                    <p>
                                        {!! Str::limit($blog->body, 120, '... Read More') !!}
                                    </p>
                                </div>
                                <div class="entry__meta">
                                    <span class="entry__meta-links">
                                        <a href="/">{!! $blog->category->name !!}</a>
                                    </span>
                                </div>
                            </div>

                        </article> <!-- end article -->
                    @endif
                @empty
                    <p>Noting To Show</p>
                @endforelse

            </div> <!-- end masonry -->
        </div> <!-- end masonry-wrap -->

        <div class="row">
            <div class="col-full">
                <nav class="pgn">
                    <ul>
                        {!! $blogs->links() !!}
                    </ul>
                </nav>
            </div>
        </div>

    </section> <!-- s-content -->
@endsection
