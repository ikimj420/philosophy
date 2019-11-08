@extends('layouts.site')
@section('content')
    <!-- styles
        ================================================== -->
    <section id="styles" class="s-styles">
        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1>Edit ToDo</h1>
            </div>
        </div>
        <div class="row add-bottom">
            <div class="row">

                <div class="col-full s-content__main">
                    {!! Form::model($assignment, ['route' => ['assignments.update', $assignment->id], 'method' => 'patch']) !!}
                        @include('assignments.fields')
                    {!! Form::close() !!}
                </div>
            </div> <!-- end row -->
        </div> <!-- end row -->
    </section> <!-- end styles -->
@endsection
