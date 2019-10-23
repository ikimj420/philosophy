<li class="{{ Request::is('categories*') ? 'active' : '' }}">
    <a href="{!! route('categories.index') !!}"><i class="fa fa-edit"></i><span>Categories</span></a>
</li>

<li class="{{ Request::is('assignments*') ? 'active' : '' }}">
    <a href="{!! route('assignments.index') !!}"><i class="fa fa-edit"></i><span>Assignments</span></a>
</li>

<li class="{{ Request::is('blogs*') ? 'active' : '' }}">
    <a href="{!! route('blogs.index') !!}"><i class="fa fa-edit"></i><span>Blogs</span></a>
</li>

<li class="{{ Request::is('exercises*') ? 'active' : '' }}">
    <a href="{!! route('exercises.index') !!}"><i class="fa fa-edit"></i><span>Exercises</span></a>
</li>

<li class="{{ Request::is('comments*') ? 'active' : '' }}">
    <a href="{!! route('comments.index') !!}"><i class="fa fa-edit"></i><span>Comments</span></a>
</li>

<li class="{{ Request::is('tags*') ? 'active' : '' }}">
    <a href="{!! route('tags.index') !!}"><i class="fa fa-edit"></i><span>Tags</span></a>
</li>

<li class="{{ Request::is('favorites*') ? 'active' : '' }}">
    <a href="{!! route('favorites.index') !!}"><i class="fa fa-edit"></i><span>Favorites</span></a>
</li>


