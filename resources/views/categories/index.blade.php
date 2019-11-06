@extends('layouts.site')
@section('content')
<!-- styles
    ================================================== -->
<section class="s-content">

    <div class="row narrow">
        <div class="col-full s-content__header" data-aos="fade-up">
            <h1>Hire Is All Your's Categories</h1>
        </div>
    </div>

    <div class="row">
        <h1 class="pull-right">
            <a class="btn full-width pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('categories.create') !!}">Add New Category</a>
        </h1>
    </div>

    <div class="row masonry-wrap">
        <div class="masonry">

            <div class="grid-sizer"></div>
            @forelse($categories as $category)
                <article class="masonry__brick entry format-standard" data-aos="fade-up">

                    <div class="entry__thumb">
                        <a href="{!! route('categories.edit', [$category->id]) !!}" class="entry__thumb-link">
                            <img src="{{ asset('/storage/blog/'. $category->pics) }}"
                                 srcset="{{ asset('/storage/category/'. $category->pics) }} 1x, {{ asset('/storage/category/'. $category->pics) }} 1x" alt="">
                        </a>
                    </div>

                    <div class="entry__text">
                        <div class="entry__header">

                            <div class="entry__date">
                                {!! date_format($category->created_at, 'M d, Y') !!}
                            </div>
                            <h1 class="entry__title"><a href="{!! route('categories.edit', [$category->id]) !!}">{!! $category->name !!}</a></h1>
                        </div>
                        <div class="entry__excerpt">
                            <p>
                                {!! $category->desc !!}
                            </p>
                        </div>
                    </div>

                </article> <!-- end article -->
            @empty
                <p>No</p>
            @endforelse
        </div> <!-- end masonry -->
    </div> <!-- end masonry-wrap -->
    </div> <!-- end row -->
</section> <!-- end styles -->
@endsection

