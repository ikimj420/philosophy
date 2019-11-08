<!-- Category Id Field -->
<div class="full-width">
    <label for="category_id">Select Category</label>
    <div class="clearfix"></div>
    <select name="category_id" class="full-width">
        <option value="">Select Category</option>
        @foreach ($categories as $category)
            @isset($blog->category_id)
                @if($category->id == $blog->category_id)<option value="{{ $category->id }} " selected >{{ $category->name }}@continue</option>
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
<!-- Body Field -->
<div class="full-width">
    {!! Form::label('body', 'Text') !!}
    {!! Form::textarea('body', null, ['class' => 'full-width']) !!}
</div>
<!-- Code Field -->
<div class="full-width">
    {!! Form::label('code', 'Code') !!}
    {!! Form::textarea('code', null, ['class' => 'full-width']) !!}
</div>
<!-- Audio Field -->
<div class="full-width">
    {!! Form::label('audio', 'Audio') !!}
    {!! Form::text('audio', null, ['class' => 'full-width', 'placeholder' => 'Web Address']) !!}
</div>
<!-- Video Field -->
<div class="full-width">
    {!! Form::label('video', 'Video') !!}
    {!! Form::text('video', null, ['class' => 'full-width', 'placeholder' => 'Only Embed Code https://www.youtube.com/embed/hn3wJ1_1Zsg']) !!}
</div>
<!-- Tags Field -->
<div class="full-width">
    {!! Form::label('blog_tag', 'Tags') !!}
    {!! Form::text('blog_tag', $blog->tagList ?? null, ['class' => 'full-width', 'placeholder' => 'After Each Tag A Comma Is Required']) !!}
</div>
<!-- Pics Field -->
<div class="full-width">
    {!! Form::label('pics', 'Picture') !!}
    {!! Form::file('pics', null, ['class' => 'full-width']) !!}
    @if(!empty($blog))
        {!! Form::hidden('pics', null, ['class' => 'full-width']) !!}
        <img src="/storage/blog/{!! $blog->pics !!}" style="width: 10%" alt="{!! $blog->title !!}">
    @endif
</div>
<!-- Submit Field -->
<div class="full-width">
    {!! Form::submit('Save', ['class' => 'btn full-width']) !!}
    <a href="{!! route('blogs.index') !!}" class="btn btn--stroke full-width">Cancel</a>
</div>
