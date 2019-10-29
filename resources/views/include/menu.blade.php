<header class="header">
    <div class="header__content row">

        <div class="header__logo">
            <a class="logo" href="/">
                <img src="/storage/site/logo.svg" alt="Homepage">
            </a>
        </div> <!-- end header__logo -->

        <ul class="header__social">
            <div class="flex-center position-ref full-height">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            <li>
                                {!! Auth::user()->username; !!}
                            </li>
                        @else
                            <a href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </ul> <!-- end header__social -->

        <a class="header__search-trigger" href="#0"></a>

        <div class="header__search">

            <form role="search" method="get" class="header__search-form" action="#">
                <label>
                    <span class="hide-content">Search for:</span>
                    <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="Search for:" autocomplete="off">
                </label>
                <input type="submit" class="search-submit" value="Search">
            </form>

            <a href="#0" title="Close Search" class="header__overlay-close">Close</a>

        </div>  <!-- end header__search -->


        <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

        <nav class="header__nav-wrap">

            <h2 class="header__nav-heading h6">Site Navigation</h2>

            <ul class="header__nav">
                <li><a href="/" title="">Home</a></li>
                @auth()
                    <li><a href="/profiles/{!! Auth::user()->id !!}" title="">Profile</a></li>
                    <li><a href="/categories" title="">Categories</a></li>
                @endauth
                <li><a href="/assignments" title="">To-Do</a></li>
                <li class="has-children">
                    <a href="/" title="">Blog</a>
                    <ul class="sub-menu">
                        <li><a href="/blogs">All Blogs</a></li>
                        <li><a href="/blogs/blog/4">Code</a></li>
                        <li><a href="/blogs/blog/3">Audio Post</a></li>
                        <li><a href="/blogs/blog/2">Video Post</a></li>
                        <li><a href="/blogs/blog/1">Standard Post</a></li>
                    </ul>
                </li>
                <li class="has-children">
                    <a href="/" title="">Make</a>
                    <ul class="sub-menu">
                        <li><a href="/exercises">All Recipes</a></li>
                        <li><a href="/exercises/exercise/6">Food</a></li>
                        <li><a href="/exercises/exercise/5">Cocktail</a></li>
                    </ul>
                </li>
                <li><a href="/" title="">Contact</a></li>
            </ul> <!-- end header__nav -->

            <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

        </nav> <!-- end header__nav-wrap -->

    </div> <!-- header-content -->
</header> <!-- header -->
