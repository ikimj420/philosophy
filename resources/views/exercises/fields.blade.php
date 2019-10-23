<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category Id:') !!}
    {!! Form::number('category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Ingredients Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('ingredients', 'Ingredients:') !!}
    {!! Form::textarea('ingredients', null, ['class' => 'form-control']) !!}
</div>

<!-- Make Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('make', 'Make:') !!}
    {!! Form::textarea('make', null, ['class' => 'form-control']) !!}
</div>

<!-- Frommin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fromMin', 'Frommin:') !!}
    {!! Form::number('fromMin', null, ['class' => 'form-control']) !!}
</div>

<!-- Video Field -->
<div class="form-group col-sm-6">
    {!! Form::label('video', 'Video:') !!}
    {!! Form::text('video', null, ['class' => 'form-control']) !!}
</div>

<!-- Pics Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pics', 'Pics:') !!}
    {!! Form::text('pics', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('exercises.index') !!}" class="btn btn-default">Cancel</a>
</div>
