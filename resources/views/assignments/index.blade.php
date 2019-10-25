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

                {!! Form::open(['route' => 'assignments.store']) !!}

                @include('assignments.fields')

                {!! Form::close() !!}

            </div>

        </div> <!-- end row -->
        <hr>
        <div class="col-twelve">

            <div class="table-responsive">

                <table>
                    <thead>
                    <tr>
                        <th>Task</th>
                        <th>To DO</th>
                        <th>Done</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($assignments as $assignment)
                    <tr>
                        <td>{!! $assignment->body !!}</td>
                        <td>{!! $assignment->date->format('M d, Y') !!}</td>
                        <td>@if ( $assignment->isDone)  Done @endif</td>
                        <td>
                            {!! Form::open(['route' => ['assignments.destroy', $assignment->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{!! route('assignments.edit', [$assignment->id]) !!}" class='btn btn-default'>Edit</a>
                                {!! Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @empty
                        <p>No</p>
                    @endforelse
                    </tbody>
                </table>

                    <div class="col-full">
                        <nav class="pgn">
                            <ul>
                                {!! $assignments->links() !!}
                            </ul>
                        </nav>
                    </div>
            </div>
        </div>
    </div> <!-- end row -->
</section> <!-- end styles -->
@endsection
