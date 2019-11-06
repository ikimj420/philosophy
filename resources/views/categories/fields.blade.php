<!-- Name Field -->
<div class="full-width">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'full-width']) !!}
</div>

<!-- Desc Field -->
<div class="full-width">
    {!! Form::label('desc', 'Desc:') !!}
    {!! Form::text('desc', null, ['class' => 'full-width']) !!}
</div>

<!-- subCategory Field -->
<div class="full-width">
    {!! Form::label('subCategory', 'Sub Category:') !!}
    {!! Form::number('subCategory', null, ['class' => 'full-width']) !!}
</div>

<!-- Pics Field -->
<div class="full-width">
    {!! Form::label('pics', 'Pics:') !!}
    {!! Form::file('pics', null, ['class' => 'full-width']) !!}
    @if(!empty($category))
        {!! Form::hidden('pics', null, ['class' => 'full-width']) !!}
        <img src="/storage/category/{!! $category->pics !!}" style="width: 10%" alt="{!! $category->name !!}">
    @endif
</div>

<!-- Submit Field -->
<div class="full-width">
    {!! Form::submit('Save', ['class' => 'btn full-width']) !!}
    <a href="{!! route('categories.index') !!}" class="btn btn--stroke full-width">Cancel</a>
</div>
