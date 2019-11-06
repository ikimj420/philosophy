@extends('layouts.site')
@section('content')
    <!-- styles
        ================================================== -->
    <section id="styles" class="s-styles">
        <div class="row add-bottom">
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
