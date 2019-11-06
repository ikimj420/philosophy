@extends('layouts.app')
@section('content')
    <!-- s-content
================================================== -->
    <section class="s-content s-content--narrow s-content--no-padding-bottom">

        <article class="row format-video">
            <div>
                @guest()
                @else
                    @if(!$fav)
                        {!! Form::open(array('route' => ['favorite.saveExercise', $exercise->id] , 'method' => 'POST')) !!}
                        <!-- Submit Field -->
                            <div class="btn-group pull-right">
                                {!! Form::submit('Add To Favorite', ['class' => 'btn full-width']) !!}
                            </div>
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['route' => ['favorite.destroyExercise', $exercise->id], 'method' => 'delete']) !!}
                            <div class='btn-group pull-right'>
                                {!! Form::button('Remove From Favorite', ['type' => 'submit', 'class' => 'btn btn--primary full-width']) !!}
                            </div>
                            {!! Form::close() !!}
                        @endif
                @endguest
            </div>
            <div class="s-content__header col-full">
                <h1 class="s-content__header-title">
                    {!! $exercise->title !!}
                </h1>
                <ul class="s-content__header-meta">
                    <li class="date">{!! date_format($exercise->created_at, 'M d, Y') !!}</li>
                    <li class="cat">
                        In
                        <a href="/">{!! $exercise->category->name !!}</a>
                    </li>
                </ul>
            </div> <!-- end s-content__header -->
            @if(!empty($exercise->video))
                <div class="s-content__media col-full">
                    <div class="video-container">
                        <iframe src="{!! $exercise->video !!}?color=01aef0&title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    </div>
                </div> <!-- end s-content__media -->
            @endif
            <div class="col-full s-content__main">
                <div>
                    <h3> Ingredients </h3>

                    @if ($exercise->ingredients != "")
                        @foreach($exercise->getExerciseIngredientsAttribute() as $ingredient)
                            <p> {!! $ingredient !!}</p>
                        @endforeach
                    @endif
                </div>
                <div>
                    <h3> How To Make </h3>
                    @if ($exercise->make != "")
                        @foreach($exercise->getExerciseMakeAttribute() as $m)
                            <p> {!! $m!!}</p>
                        @endforeach
                    @endif
                </div>
                <div>
                    <h3> Video To Start From Minutes : </h3>
                    <p>
                        {!! $exercise->fromMin !!}.min
                    </p>
                </div>

                <p>
                    <img src="{{ asset('/storage/exercise/'. $exercise->pics) }}" alt="{!! $exercise->title !!}" >
                </p>

                <p class="s-content__tags">
                    <span>Recipes Tags</span>

                    <span class="s-content__tag-list">
                        @forelse($exercise->tags as $tag)
                            <a href="/tag/tags/{{ $tag }}">{!! $tag->normalized !!}</a>
                        @empty
                            <span> Noting To Show</span>
                        @endforelse
                    </span>
                </p> <!-- end s-content__tags -->

                <div class="s-content__author">
                    <img src="{{ asset('/storage/user/'. $exercise->user->pics) }}" alt="{!! $exercise->user->fullName !!}">

                    <div class="s-content__author-about">
                        <h4 class="s-content__author-name">
                            <a href="/profiles/{!! $exercise->user->id !!}"> By {!! $exercise->user->fullName !!}</a>
                        </h4>

                        <p>
                            {!! $exercise->user->email !!}
                        </p>

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

                    @comments(['model' => $exercise])

                </div>
            </div>
        </div>

    </section> <!-- s-content -->
@endsection
