@extends('layouts.site')
@section('content')
    <style type="text/css" media="screen">
        .s-styles {
            background: #f2f2f2;
            padding-top: 12rem;
            padding-bottom: 12rem;
        }

        .s-styles .section-intro h1 {
            margin-top: 0;
        }
    </style>
    <!-- pageheader
    ================================================== -->
    <section class="s-pageheader s-pageheader--home">

        @include('include.menu')

    </section> <!-- end s-pageheader -->

    <!-- styles
        ================================================== -->
    <section id="styles" class="s-styles">
        <div class="row add-bottom">
            @include('flash::message')
            <div class="row">

                <div class="col-full s-content__main">

                    <h3 class="add-bottom">To-Do</h3>

                    {!! Form::model($assignment, ['route' => ['assignments.update', $assignment->id], 'method' => 'patch']) !!}

                    @include('assignments.fields')

                    {!! Form::close() !!}
                </div>
            </div> <!-- end row -->
        </div> <!-- end row -->
    </section> <!-- end styles -->
@endsection
