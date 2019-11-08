@extends('layouts.site')
@section('content')
    <!-- styles
        ================================================== -->
    <section id="styles" class="s-styles">
        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1>Add Recipe</h1>
            </div>
        </div>
        <div class="row add-bottom">
            <div class="row">
                <div class="col-full s-content__main">
                    {!! Form::open(['route' => 'exercises.store', 'enctype' => 'multipart/form-data']) !!}
                        @include('exercises.fields')
                    {!! Form::close() !!}
                </div>
            </div> <!-- end row -->
        </div> <!-- end row -->
    </section> <!-- end styles -->
@endsection
