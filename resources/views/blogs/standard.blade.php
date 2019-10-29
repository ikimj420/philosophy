@extends('layouts.site')
@section('content')
    <!-- s-content
================================================== -->
    <section class="s-content">

        <div class="row narrow">
            @include('flash::message')
            @include('adminlte-templates::common.errors')

            <div class="col-full s-content__header" data-aos="fade-up">
                <h1>Category: Standard</h1>

                <p class="lead">Here you can find latest standard finding.</p>
            </div>
        </div>

        <div class="row masonry-wrap">
            <div class="masonry">

                <div class="grid-sizer"></div>
                @forelse($standard as $blog)
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
                                    {!! Str::limit($blog->body, 120) !!}
                                </p>
                            </div>
                            <div class="entry__meta">
                            <span class="entry__meta-links">
                                <a href="/">{!! $blog->category->name !!}</a>
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
                    {!! $standard->links() !!}
                </nav>
            </div>
        </div>

    </section> <!-- s-content -->
@endsection


