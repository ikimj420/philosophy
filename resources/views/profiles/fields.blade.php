<!-- Full Name Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fullName', 'Full Name:') !!}
    {!! Form::text('fullName', null, ['class' => 'form-control']) !!}
</div>

<!-- Username Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<!-- Bio Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('bio', 'Biography:') !!}
    {!! Form::textarea('bio', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Pics Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('pics', 'Avatar:') !!}
    {!! Form::file('pics', null, ['class' => 'form-control']) !!}
    @if(!empty($user))
        {!! Form::hidden('pics', null, ['class' => 'form-control']) !!}
        <img src="/storage/user/{!! $user->pics !!}" style="width: 10%" alt="{!! $user->username !!}">
    @endif
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('home') !!}" class="btn btn-default">Cancel</a>
</div>
