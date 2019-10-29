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

                    <h3 class="add-bottom">Recipes</h3>

                    {!! Form::open(['route' => 'exercises.store', 'enctype' => 'multipart/form-data']) !!}

                    @include('exercises.fields')

                    {!! Form::close() !!}
                </div>
            </div> <!-- end row -->
        </div> <!-- end row -->
    </section> <!-- end styles -->
@endsection
