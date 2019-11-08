@extends('layouts.site')
@section('content')
    <!-- s-content
================================================== -->
    <section class="s-content s-content--narrow s-content--no-padding-bottom">
        <article class="row format-video">
            @auth
                @if(Auth::id() === $blog->user_id || Auth::user()->isAdmin === 1)
                    <button class="btn btn--stroke pull-left">
                        <a href="{!! route('blogs.edit', [$blog->id]) !!}">Edit</a>
                    </button>
                @endif
            @endauth
            <div>
                @guest()
                @else
                    @if(!$fav)
                        {!! Form::open(array('route' => ['favorites.saveBlog', $blog->id] , 'method' => 'POST')) !!}
                        <!-- Submit Field -->
                            <div class="btn-group pull-right">
                                {!! Form::submit('Add To Favorite', ['class' => 'btn full-width']) !!}
                            </div>
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['route' => ['favorites.destroyBlog', $blog->id], 'method' => 'delete']) !!}
                            <div class='btn-group pull-right'>
                                {!! Form::button('Remove From Favorite', ['type' => 'submit', 'class' => 'btn btn--primary full-width']) !!}
                            </div>
                            {!! Form::close() !!}
                        @endif
                @endguest
            </div>
            <div class="s-content__header col-full">
                <h1 class="s-content__header-title">
                    {!! $blog->title !!}
                </h1>
                <ul class="s-content__header-meta">
                    <li class="date">{!! date_format($blog->created_at, 'M d, Y') !!}</li>
                    <li class="cat">
                        In
                        <a href="/blogs/blog/{!! $blog->category_id !!}">{!! $blog->category->name !!}</a>
                    </li>
                </ul>
            </div> <!-- end s-content__header -->
            @if(!empty($blog->video))
                <div class="s-content__media col-full">
                    <div class="video-container">
                        <iframe src="{!! $blog->video !!}" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    </div>
                </div> <!-- end s-content__media -->
            @endif
            @if(!empty($blog->audio))
            <div class="s-content__media col-full">
                <div class="s-content__post-thumb">
                    <img src="{!! asset('/storage/blog/'.$blog->pics) !!}" alt="" >
                    <div class="audio-wrap">
                        <audio id="player2" src="{!! $blog->audio !!}" width="100%" height="42" controls="controls"></audio>
                    </div>
                </div>
            </div> <!-- end s-content__media -->
            @endif
            <div class="col-full s-content__main">
                @if ($blog->body != "")
                    @foreach($blog->getBlogBodyAttribute() as $body)
                        <p> {!! $body !!}</p>
                    @endforeach
                @endif
                <p>
                    <img src="{{ asset('/storage/blog/'. $blog->pics) }}" alt="{!! $blog->title !!}" >
                </p>
                @if(!empty($blog->code))
                    <pre><code>{!! $blog->code !!}</code></pre>
                @endif
                <p class="s-content__tags">
                    <span>Post Tags</span>
                    <span class="s-content__tag-list">
                        @forelse($blog->tags as $tag)
                            <a href="/tag/tags/{{ $tag }}">{!! $tag->normalized !!}</a>
                        @empty
                            <span> Noting To Show</span>
                        @endforelse
                    </span>
                </p> <!-- end s-content__tags -->
                    <div class="s-content__author">
                        <img src="{{ asset('/storage/user/'. $blog->user->pics) }}" alt="{!! $blog->user->fullName !!}">
                        <div class="s-content__author-about">
                            <h4 class="s-content__author-name">
                                <a href="/profiles/{!! $blog->user->id !!}"> By {!! $blog->user->fullName !!}</a>
                            </h4>
                            <p> {!! $blog->user->email !!} </p>
                        </div>
                    </div>

                {{--<div class="s-content__pagenav">
                    <div class="s-content__nav">
                        <div class="s-content__prev">
                            <a href="#0" rel="prev">
                                <span>Previous Post</span>
                                Tips on Minimalist Design
                            </a>
                        </div>
                        <div class="s-content__next">
                            <a href="#0" rel="next">
                                <span>Next Post</span>
                                Less Is More
                            </a>
                        </div>
                    </div>
                </div> --}}<!-- end s-content__pagenav -->

            </div> <!-- end s-content__main -->
        </article>
        <!-- comments
            ================================================== -->
        <div class="comments-wrap">
            <div id="comments" class="row">
                <div class="col-full">
                    @comments(['model' => $blog])
                </div>
            </div>
        </div>
    </section> <!-- s-content -->
@endsection
