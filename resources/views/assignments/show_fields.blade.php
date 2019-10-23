<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $assignment->user_id !!}</p>
</div>

<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    <p>{!! $assignment->body !!}</p>
</div>

<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', 'Date:') !!}
    <p>{!! $assignment->date !!}</p>
</div>

<!-- Isdone Field -->
<div class="form-group">
    {!! Form::label('isDone', 'Isdone:') !!}
    <p>{!! $assignment->isDone !!}</p>
</div>

