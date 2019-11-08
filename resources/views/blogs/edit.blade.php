@extends('layouts.site')
@section('content')
    <!-- styles
        ================================================== -->
    <section id="styles" class="s-styles">
        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1>Edit Blog</h1>
            </div>
        </div>
        <div class="row add-bottom">
            <div class="row">
                <div class="col-full s-content__main">
                    {!! Form::model($blog, ['route' => ['blogs.update', $blog->id], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}
                        @include('blogs.fields')
                    {!! Form::close() !!}
                    {!! Form::open(['route' => ['blogs.destroy', $blog->id], 'method' => 'delete']) !!}
                    <div class='full-width'>
                        {!! Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn--primary full-width', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div> <!-- end row -->
        </div> <!-- end row -->
    </section> <!-- end styles -->
@endsection
