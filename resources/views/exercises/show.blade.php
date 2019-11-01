@extends('layouts.site')
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
                                {!! Form::button('Remove From Favorite', ['type' => 'submit', 'class' => 'btn btn--primary full-width', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            </div>
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

                <div class="s-content__media col-full">
                    <div class="video-container">
                        <iframe src="{!! $exercise->video !!}?color=01aef0&title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    </div>
                </div> <!-- end s-content__media -->

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
                            <a href="/exercises/{!! $exercise->id !!}">{!! $tag->normalized !!}</a>
                        @empty
                            <span> Noting To Show</span>
                        @endforelse
                    </span>
                </p> <!-- end s-content__tags -->

                <div class="s-content__author">
                    <img src="{{ asset('/storage/user/'. $exercise->user->pics) }}" alt="{!! $exercise->user->fullName !!}">

                    <div class="s-content__author-about">
                        <h4 class="s-content__author-name">
                            <a href="/profiles/{!! $exercise->user->id !!}">{!! $exercise->user->fullName !!}</a>
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
    {{--<div class="comments-wrap">

        <div id="comments" class="row">
            <div class="col-full">

                <h3 class="h2">5 Comments</h3>

                <!-- commentlist -->
                <ol class="commentlist">

                    <li class="depth-1 comment">

                        <div class="comment__avatar">
                            <img width="50" height="50" class="avatar" src="images/avatars/user-01.jpg" alt="">
                        </div>

                        <div class="comment__content">

                            <div class="comment__info">
                                <cite>Itachi Uchiha</cite>

                                <div class="comment__meta">
                                    <time class="comment__time">Dec 16, 2017 @ 23:05</time>
                                    <a class="reply" href="#0">Reply</a>
                                </div>
                            </div>

                            <div class="comment__text">
                                <p>Adhuc quaerendum est ne, vis ut harum tantas noluisse, id suas iisque mei. Nec te inani ponderum vulputate,
                                    facilisi expetenda has et. Iudico dictas scriptorem an vim, ei alia mentitum est, ne has voluptua praesent.</p>
                            </div>

                        </div>

                    </li> <!-- end comment level 1 -->

                    <li class="thread-alt depth-1 comment">

                        <div class="comment__avatar">
                            <img width="50" height="50" class="avatar" src="images/avatars/user-04.jpg" alt="">
                        </div>

                        <div class="comment__content">

                            <div class="comment__info">
                                <cite>John Doe</cite>

                                <div class="comment__meta">
                                    <time class="comment__time">Dec 16, 2017 @ 24:05</time>
                                    <a class="reply" href="#0">Reply</a>
                                </div>
                            </div>

                            <div class="comment__text">
                                <p>Sumo euismod dissentiunt ne sit, ad eos iudico qualisque adversarium, tota falli et mei. Esse euismod
                                    urbanitas ut sed, et duo scaevola pericula splendide. Primis veritus contentiones nec ad, nec et
                                    tantas semper delicatissimi.</p>
                            </div>

                        </div>

                        <ul class="children">

                            <li class="depth-2 comment">

                                <div class="comment__avatar">
                                    <img width="50" height="50" class="avatar" src="images/avatars/user-03.jpg" alt="">
                                </div>

                                <div class="comment__content">

                                    <div class="comment__info">
                                        <cite>Kakashi Hatake</cite>

                                        <div class="comment__meta">
                                            <time class="comment__time">Dec 16, 2017 @ 25:05</time>
                                            <a class="reply" href="#0">Reply</a>
                                        </div>
                                    </div>

                                    <div class="comment__text">
                                        <p>Duis sed odio sit amet nibh vulputate
                                            cursus a sit amet mauris. Morbi accumsan ipsum velit. Duis sed odio sit amet nibh vulputate
                                            cursus a sit amet mauris</p>
                                    </div>

                                </div>

                                <ul class="children">

                                    <li class="depth-3 comment">

                                        <div class="comment__avatar">
                                            <img width="50" height="50" class="avatar" src="images/avatars/user-04.jpg" alt="">
                                        </div>

                                        <div class="comment__content">

                                            <div class="comment__info">
                                                <cite>John Doe</cite>

                                                <div class="comment__meta">
                                                    <time class="comment__time">Dec 16, 2017 @ 25:15</time>
                                                    <a class="reply" href="#0">Reply</a>
                                                </div>
                                            </div>

                                            <div class="comment__text">
                                                <p>Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est
                                                    etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.</p>
                                            </div>

                                        </div>

                                    </li>

                                </ul>

                            </li>

                        </ul>

                    </li> <!-- end comment level 1 -->

                    <li class="depth-1 comment">

                        <div class="comment__avatar">
                            <img width="50" height="50" class="avatar" src="images/avatars/user-02.jpg" alt="">
                        </div>

                        <div class="comment__content">

                            <div class="comment__info">
                                <cite>Shikamaru Nara</cite>

                                <div class="comment__meta">
                                    <time class="comment-time">Dec 16, 2017 @ 25:15</time>
                                    <a class="reply" href="#">Reply</a>
                                </div>
                            </div>

                            <div class="comment__text">
                                <p>Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem.</p>
                            </div>

                        </div>

                    </li>  <!-- end comment level 1 -->

                </ol> <!-- end commentlist -->


                <!-- respond
                ================================================== -->
                <div class="respond">

                    <h3 class="h2">Add Comment</h3>

                    <form name="contactForm" id="contactForm" method="post" action="">
                        <fieldset>

                            <div class="form-field">
                                <input name="cName" type="text" id="cName" class="full-width" placeholder="Your Name" value="">
                            </div>

                            <div class="form-field">
                                <input name="cEmail" type="text" id="cEmail" class="full-width" placeholder="Your Email" value="">
                            </div>

                            <div class="form-field">
                                <input name="cWebsite" type="text" id="cWebsite" class="full-width" placeholder="Website" value="">
                            </div>

                            <div class="message form-field">
                                <textarea name="cMessage" id="cMessage" class="full-width" placeholder="Your Message"></textarea>
                            </div>

                            <button type="submit" class="submit btn--primary btn--large full-width">Submit</button>

                        </fieldset>
                    </form> <!-- end form -->

                </div> <!-- end respond -->

            </div> <!-- end col-full -->

        </div> <!-- end row comments -->
    </div>--}} <!-- end comments-wrap -->

    </section> <!-- s-content -->
@endsection
