<!-- Favoriteable Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('favoriteable_type', 'Favoriteable Type:') !!}
    {!! Form::text('favoriteable_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Favoriteable Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('favoriteable_id', 'Favoriteable Id:') !!}
    {!! Form::number('favoriteable_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('favorites.index') !!}" class="btn btn-default">Cancel</a>
</div>
