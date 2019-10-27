<!-- Body Field -->
<div class="full-width">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::text('body', null, ['class' => 'full-width']) !!}
</div>

<!-- Date Field -->
<div class="full-width">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::date('date', null, ['class' => 'full-width','id'=>'date']) !!}
</div>

<!-- Isdone Field -->
<div class="full-width">
    {!! Form::label('isDone', 'Isdone:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('isDone', 0) !!}
        {!! Form::checkbox('isDone', '1', null) !!}
    </label>
</div>


<!-- Submit Field -->
<div class="full-width">
    {!! Form::submit('Save', ['class' => 'btn full-width']) !!}
    <a href="{!! route('assignments.index') !!}" class="btn btn--stroke full-width">Cancel</a>
</div>
