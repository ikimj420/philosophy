@extends('layouts.welcome')
@section('content')
    <!-- s-content
    ================================================== -->
    <section class="s-content">

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
                                        <a href="/profiles/{!! $blog->user_id !!}">{!! $blog->user['fullName'] !!}</a>
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
                                        <a href="/profiles/{!! $blog->user_id !!}">{!! $blog->user['fullName'] !!}</a>
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
                                        <a href="/profiles/{!! $blog->user_id !!}">{!! $blog->user['fullName'] !!}</a>
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
                    {!! $blogs->links() !!}
                </nav>
            </div>
        </div>

    </section> <!-- s-content -->

    <!-- s-extra
    ================================================== -->
    <section class="s-extra">

        {{--<div class="row top">

            <div class="col-eight md-six tab-full popular">
                <h3>Popular Posts</h3>

                    <div class="block-1-2 block-m-full popular__posts">
                        <article class="col-block popular__post">
                            <a href="#0" class="popular__thumb">
                                <img src="images/thumbs/small/wheel-150.jpg" alt="">
                            </a>
                            <h5><a href="#0">Visiting Theme Parks Improves Your Health.</a></h5>
                            <section class="popular__meta">
                                <span class="popular__author"><span>By</span> <a href="#0"> John Doe</a></span>
                                <span class="popular__date"><span>on</span> <time datetime="2017-12-19">Dec 19, 2017</time></span>
                            </section>
                        </article>
                    </div> <!-- end popular_posts -->

            </div> <!-- end popular -->

        </div>--}} <!-- end row -->

        <div class="row bottom tags-wrap">
            <div class="col-full tags">
                <h3>Tags</h3>

                <div class="tagcloud">
                    @forelse($tags as $tag)
                        <a href="/tag/tags/{{ $tag }}">{!! $tag !!}</a>
                    @empty
                        <span> Noting To Show</span>
                    @endforelse
                </div> <!-- end tagcloud -->
            </div> <!-- end tags -->
        </div> <!-- end tags-wrap -->

    </section> <!-- end s-extra -->

@endsection
