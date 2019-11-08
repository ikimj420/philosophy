@extends('layouts.site')
@section('content')
    <!-- s-content
================================================== -->
    <section class="s-content">
        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1>Category: Code</h1>
                <p class="lead">Here you can find latest code.</p>
            </div>
        </div>
        <div class="row masonry-wrap">
            <div class="masonry">
                <div class="grid-sizer"></div>
                @forelse($code as $blog)
                <article class="masonry__brick entry format-standard" data-aos="fade-up">
                    <div class="entry__thumb">
                        <a href="{!! '/blogs/'.$blog->id !!}" class="entry__thumb-link">
                            <img src="{{ asset('/storage/blog/'. $blog->pics) }}"
                                 srcset="{{ asset('/storage/blog/'. $blog->pics) }} 1x, {{ asset('/storage/blog/'. $blog->pics) }} 1x" alt="">
                        </a>
                    </div>
                    <div class="entry__text">
                        <div class="entry__header">
                            <div class="entry__date">
                                {!! date_format($blog->created_at, 'M d, Y') !!}
                            </div>
                            <h1 class="entry__title"><a href="{!! '/blogs/'.$blog->id !!}">{!! $blog->title !!}</a></h1>
                        </div>
                        <div class="entry__excerpt">
                            <p>
                                {!! Str::words($blog->body, 10, ' >>>') !!}
                            </p>
                        </div>
                        <div class="entry__meta">
                            <span class="entry__meta-links">
                                <a href="/profiles/{!! $blog->user_id !!}">{!! $blog->user['fullName'] !!}</a>
                            </span>
                        </div>
                    </div>

                </article> <!-- end article -->
                @empty
                    <p>No</p>
                @endforelse
            </div> <!-- end masonry -->
        </div> <!-- end masonry-wrap -->

        <div class="row">
            <div class="col-full">
                <nav class="pgn">
                    {!! $code->links() !!}
                </nav>
            </div>
        </div>

    </section> <!-- s-content -->
@endsection
