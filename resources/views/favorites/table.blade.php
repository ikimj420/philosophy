<div class="table-responsive">
    <table class="table" id="favorites-table">
        <thead>
            <tr>
                <th>Favoriteable Type</th>
        <th>Favoriteable Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($favorites as $favorite)
            <tr>
                <td>{!! $favorite->favoriteable_type !!}</td>
            <td>{!! $favorite->favoriteable_id !!}</td>
                <td>
                    {!! Form::open(['route' => ['favorites.destroy', $favorite->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('favorites.show', [$favorite->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('favorites.edit', [$favorite->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
