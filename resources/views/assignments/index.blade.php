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

                <h3 class="add-bottom">Add To-Do</h3>

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
                        <th>To Do</th>
                        <th>Done</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($assignments as $assignment)
                    <tr>
                        <td><a href="{!! route('assignments.edit', [$assignment->id]) !!}">{!! $assignment->body !!}</a></td>
                        <td>{!! $assignment->date->format('M d, Y') !!}</td>
                        <td>@if ( $assignment->isDone)  Done @endif</td>
                        <td>
                            {!! Form::open(['route' => ['assignments.destroy', $assignment->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                {!! Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn--primary full-width', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @empty
                        <p>Noting To Show</p>
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
