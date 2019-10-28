<div class="table-responsive">
    <table class="table" id="blogs-table">
        <thead>
            <tr>
                <th>User Id</th>
        <th>Category Id</th>
        <th>Title</th>
        <th>Body</th>
        <th>Code</th>
        <th>Audio</th>
        <th>Video</th>
        <th>Pics</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($blogs as $blog)
            <tr>
                <td>{!! $blog->user_id !!}</td>
            <td>{!! $blog->category_id !!}</td>
            <td>{!! $blog->title !!}</td>
            <td>{!! $blog->body !!}</td>
            <td>{!! $blog->code !!}</td>
            <td>{!! $blog->audio !!}</td>
            <td>{!! $blog->video !!}</td>
            <td>{!! $blog->pics !!}</td>
                <td>
                    {!! Form::open(['route' => ['blogs.destroy', $blog->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('blogs.show', [$blog->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('blogs.edit', [$blog->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
