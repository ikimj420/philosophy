<div class="table-responsive">
    <table class="table" id="exercises-table">
        <thead>
            <tr>
                <th>User Id</th>
        <th>Category Id</th>
        <th>Title</th>
        <th>Ingredients</th>
        <th>Make</th>
        <th>Frommin</th>
        <th>Video</th>
        <th>Pics</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($exercises as $exercise)
            <tr>
                <td>{!! $exercise->user_id !!}</td>
            <td>{!! $exercise->category_id !!}</td>
            <td>{!! $exercise->title !!}</td>
            <td>{!! $exercise->ingredients !!}</td>
            <td>{!! $exercise->make !!}</td>
            <td>{!! $exercise->fromMin !!}</td>
            <td>{!! $exercise->video !!}</td>
            <td>{!! $exercise->pics !!}</td>
                <td>
                    {!! Form::open(['route' => ['exercises.destroy', $exercise->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('exercises.show', [$exercise->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('exercises.edit', [$exercise->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
