@extends('layouts.site')
@section('content')
    <!-- styles
        ================================================== -->
    <section id="styles" class="s-styles">
        <div class="row add-bottom">
            @include('flash::message')
            @include('adminlte-templates::common.errors')
            <div class="row">

                <div class="col-full s-content__main">
                    <h1 class="pull-right">
                        <a class="btn full-width pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('blogs.create') !!}">Add New Blog</a>
                    </h1>
                </div>

            </div> <!-- end row -->

            <div class="col-twelve">

                <div class="table-responsive">

                    <table>
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Video</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($blogs as $blog)
                            <tr>
                                <td>{!! $blog->category->name !!}</td>
                                <td><a href="{!! route('blogs.edit', [$blog->id]) !!}">{!! $blog->title !!}</a></td>
                                <td>{!! Str::limit($blog->body, 20) !!}</td>
                                <td>{!! $blog->video !!}</td>
                            </tr>
                        @empty
                            <p>Noting To Show</p>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="col-full">
                        <nav class="pgn">
                            <ul>
                                {!! $blogs->links() !!}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->
    </section> <!-- end styles -->
@endsection

