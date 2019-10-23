<!-- Body Field -->
<div class="form-group col-sm-6">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::text('body', null, ['class' => 'form-control']) !!}
</div>

<!-- Commentable Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('commentable_id', 'Commentable Id:') !!}
    {!! Form::number('commentable_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Commentable Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('commentable_type', 'Commentable Type:') !!}
    {!! Form::text('commentable_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('comments.index') !!}" class="btn btn-default">Cancel</a>
</div>
