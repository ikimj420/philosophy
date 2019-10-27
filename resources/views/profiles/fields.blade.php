<!-- Full Name Type Field -->
<div class="full-width">
    {!! Form::label('fullName', 'Full Name:') !!}
    {!! Form::text('fullName', null, ['class' => 'full-width']) !!}
</div>

<!-- Username Type Field -->
<div class="full-width">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['class' => 'full-width']) !!}
</div>

<!-- Bio Type Field -->
<div class="full-width">
    {!! Form::label('bio', 'Biography:') !!}
    {!! Form::textarea('bio', null, ['class' => 'full-width']) !!}
</div>

<!-- Email Type Field -->
<div class="full-width">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'full-width']) !!}
</div>

<!-- Pics Type Field -->
<div class="full-width">
    {!! Form::label('pics', 'Avatar:') !!}
    {!! Form::file('pics', null, ['class' => 'full-width']) !!}
    @if(!empty($user))
        {!! Form::hidden('pics', null, ['class' => 'full-width']) !!}
        <img src="/storage/user/{!! $user->pics !!}" style="width: 10%" alt="{!! $user->username !!}">
    @endif
</div>

<!-- Submit Field -->
<div class="full-width">
    {!! Form::submit('Save', ['class' => 'btn full-width']) !!}
    <a href="{!! route('welcome') !!}" class="btn btn--stroke full-width">Cancel</a>
</div>
