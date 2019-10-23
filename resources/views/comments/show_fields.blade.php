<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    <p>{!! $comment->body !!}</p>
</div>

<!-- Commentable Id Field -->
<div class="form-group">
    {!! Form::label('commentable_id', 'Commentable Id:') !!}
    <p>{!! $comment->commentable_id !!}</p>
</div>

<!-- Commentable Type Field -->
<div class="form-group">
    {!! Form::label('commentable_type', 'Commentable Type:') !!}
    <p>{!! $comment->commentable_type !!}</p>
</div>

