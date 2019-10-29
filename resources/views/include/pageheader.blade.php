<!-- pageheader
================================================== -->
<section class="s-pageheader s-pageheader--home">

@include('include.menu')

    <div class="pageheader-content row">
        <div class="col-full">

            <div class="featured">
                @forelse($cocktails as $cocktail)
                    <div class="featured__column featured__column--big">
                    <div class="entry" style="background-image:url({{ asset('/storage/exercise/'. $cocktail->pics) }});">

                        <div class="entry__content">
                            <span class="entry__category"><a href="/">{!! $cocktail->category->name !!}</a></span>

                            <h1><a href="/exercises/{!! $cocktail->id !!}" title="">{!! $cocktail->title !!}</a></h1>

                            <div class="entry__info">
                                <a href="/profiles/{!! $cocktail->user->id !!}" class="entry__profile-pic">
                                    <img class="avatar" src="{{ asset('/storage/user/'. $cocktail->user->pics) }}" alt="{!! $cocktail->user->fullName !!}" >
                                </a>

                                <ul class="entry__meta">
                                    <li><a href="/profiles/{!! $cocktail->user->id !!}">{!! $cocktail->user->fullName !!}</a></li>
                                    <li>{!! date_format($cocktail->created_at, 'M d, Y') !!}</li>
                                </ul>
                            </div>
                        </div> <!-- end entry__content -->

                    </div> <!-- end entry -->
                </div> <!-- end featured__big -->
                @empty
                    <p>
                        Noting To Show
                    </p>
                @endforelse
                <div class="featured__column featured__column--small">
                @forelse($recipes as $recipe)
                    <div class="entry" style="background-image:url({{ asset('/storage/exercise/'. $recipe->pics) }});">

                        <div class="entry__content">
                            <span class="entry__category"><a href="/">{!! $recipe->category->name !!}</a></span>

                            <h1><a href="/exercises/{!! $recipe->id !!}" title="">{!! $recipe->title !!}</a></h1>

                            <div class="entry__info">
                                <a href="/profiles/{!! $recipe->user->id !!}" class="entry__profile-pic">
                                    <img class="avatar" src="{{ asset('/storage/user/'. $recipe->user->pics) }}" alt="{!! $recipe->user->fullName !!}" >
                                </a>

                                <ul class="entry__meta">
                                    <li><a href="/profiles/{!! $recipe->user->id !!}">{!! $recipe->user->fullName !!}</a></li>
                                    <li>{!! date_format($recipe->created_at, 'M d, Y') !!}</li>
                                </ul>
                            </div>
                        </div> <!-- end entry__content -->

                    </div> <!-- end entry -->
                @empty
                    <p>
                        Noting To Show
                    </p>
                @endforelse
                </div> <!-- end featured__small -->
            </div> <!-- end featured -->

        </div> <!-- end col-full -->
    </div> <!-- end pageheader-content row -->

</section> <!-- end s-pageheader -->
