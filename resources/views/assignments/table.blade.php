<div class="table-responsive">
    <table class="table" id="assignments-table">
        <thead>
            <tr>
                <th>User Id</th>
        <th>Body</th>
        <th>Date</th>
        <th>Isdone</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($assignments as $assignment)
            <tr>
                <td>{!! $assignment->user_id !!}</td>
            <td>{!! $assignment->body !!}</td>
            <td>{!! $assignment->date !!}</td>
            <td>{!! $assignment->isDone !!}</td>
                <td>
                    {!! Form::open(['route' => ['assignments.destroy', $assignment->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('assignments.show', [$assignment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('assignments.edit', [$assignment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
