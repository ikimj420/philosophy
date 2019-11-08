<!-- Category Id Field -->
<div class="full-width">
    <label for="category_id">Select Category</label>
    <div class="clearfix"></div>
    <select name="category_id" class="full-width">
        <option value="">Select Category</option>
        @foreach ($categories as $category)
            @isset($exercise->category_id)
                @if($category->id == $exercise->category_id)<option value="{{ $category->id }} " selected >{{ $category->name }}@continue</option>
                @endif
            @endisset
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<!-- Title Field -->
<div class="full-width">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'full-width']) !!}
</div>
<!-- Ingredients Field -->
<div class="full-width">
    {!! Form::label('ingredients', 'Ingredients') !!}
    {!! Form::textarea('ingredients', null, ['class' => 'full-width']) !!}
</div>
<!-- Make Field -->
<div class="full-width">
    {!! Form::label('make', 'How To Make') !!}
    {!! Form::textarea('make', null, ['class' => 'full-width']) !!}
</div>
<!-- Video Field -->
<div class="full-width">
    {!! Form::label('video', 'Video') !!}
    {!! Form::text('video', null, ['class' => 'full-width', 'placeholder' => 'Only Embed Code https://www.youtube.com/embed/hn3wJ1_1Zsg']) !!}
</div>
<!-- Frommin Field -->
<div class="full-width">
    {!! Form::label('fromMin', 'Video To Start From min.') !!}
    {!! Form::number('fromMin', null, ['class' => 'full-width']) !!}
</div>
<!-- Tags Field -->
<div class="full-width">
    {!! Form::label('exercise_tag', 'Tags') !!}
    {!! Form::text('exercise_tag', $exercise->tagList ?? null, ['class' => 'full-width', 'placeholder' => 'After Each Tag A Comma Is Required']) !!}
</div>
<!-- Pics Field -->
<div class="full-width">
    {!! Form::label('pics', 'Picture') !!}
    {!! Form::file('pics', null, ['class' => 'full-width']) !!}
    @if(!empty($exercise))
        {!! Form::hidden('pics', null, ['class' => 'full-width']) !!}
        <img src="/storage/exercise/{!! $exercise->pics !!}" style="width: 10%" alt="{!! $exercise->name !!}">
    @endif
</div>
<!-- Submit Field -->
<div class="full-width">
    {!! Form::submit('Save', ['class' => 'btn full-width']) !!}
    <a href="{!! route('exercises.index') !!}" class="btn btn--stroke  full-width">Cancel</a>
</div>
