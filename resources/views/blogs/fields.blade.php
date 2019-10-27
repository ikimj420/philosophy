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
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'full-width']) !!}
</div>

<!-- Body Field -->
<div class="full-width">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['class' => 'full-width']) !!}
</div>

<!-- Video Field -->
<div class="full-width">
    {!! Form::label('video', 'Video:') !!}
    {!! Form::text('video', null, ['class' => 'full-width']) !!}
</div>

<!-- Pics Field -->
<div class="full-width">
    {!! Form::label('pics', 'Pics:') !!}
    {!! Form::file('pics', null, ['class' => 'full-width']) !!}
    @if(!empty($blog))
        {!! Form::hidden('pics', null, ['class' => 'full-width']) !!}
        <img src="/storage/{!! $blog->pics !!}" style="width: 10%" alt="{!! $blog->name !!}">
    @endif
</div>

<!-- Submit Field -->
<div class="full-width">
    {!! Form::submit('Save', ['class' => 'btn full-width']) !!}
    <a href="{!! route('blogs.index') !!}" class="btn btn--stroke full-width">Cancel</a>
</div>
