@extends('layouts.site')
@section('content')
    <!-- styles
        ================================================== -->
    <section id="styles" class="s-styles">
        <div class="row add-bottom">
            <div class="row">
                <div class="col-full s-content__main">

                    <h3 class="add-bottom">Blog</h3>

                    {!! Form::open(['route' => 'blogs.store', 'enctype' => 'multipart/form-data']) !!}

                    @include('blogs.fields')

                    {!! Form::close() !!}
                </div>
            </div> <!-- end row -->
        </div> <!-- end row -->
    </section> <!-- end styles -->
@endsection
