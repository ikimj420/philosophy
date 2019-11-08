@extends('layouts.site')
@section('content')
<!-- styles
    ================================================== -->
<section id="styles" class="s-styles">
    <div class="row narrow">
        <div class="col-full s-content__header" data-aos="fade-up">
            <h1>Add ToDo</h1>
        </div>
    </div>
    <div class="row add-bottom">
        <div class="row">
            <div class="col-full s-content__main">
                {!! Form::open(['route' => 'assignments.store']) !!}
                    @include('assignments.fields')
                {!! Form::close() !!}
            </div>
        </div> <!-- end row -->
        <hr>
        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1>Your's ToDo List</h1>
            </div>
        </div>
        <div class="col-twelve">
            <div class="table-responsive">
                <table>
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Time</th>
                        <th>Mark As Done</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($assignments as $assignment)
                    <tr>
                        <td><a href="{!! route('assignments.edit', [$assignment->id]) !!}">{!! $assignment->body !!}</a></td>
                        <td> @if($assignment->date) {!! $assignment->date->format('M d, Y') !!} @endif </td>
                        <td>
                            @if($assignment->isDone)
                                <s>{!! $assignment->body !!}</s>
                            @else
                                {!! Form::open(['route' => ['assignments.done', $assignment->id], 'method' => 'patch']) !!}
                                {!! Form::hidden('body', $assignment->body) !!}
                                {!! Form::hidden('date', $assignment->date) !!}
                                <div class='btn-group'>
                                    {!! Form::button('', ['type' => 'submit', 'class' => 'btn--stroke fa fa-check-square-o full-width']) !!}
                                </div>
                                {!! Form::close() !!}
                            @endif
                        </td>
                        <td>
                            {!! Form::open(['route' => ['assignments.destroy', $assignment->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                {!! Form::button('', ['type' => 'submit', 'class' => 'btn--primary full-width fa fa-trash', 'onclick' => "return confirm('Are you sure?')"]) !!}
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
