@extends('layouts.site')
@section('content')
    <!-- styles
        ================================================== -->
    <section id="styles" class="s-styles">
        <div class="s-content__header col-full">
            <h1 class="s-content__header-title">
                Edit {!! $user->fullName; !!} Profile
            </h1>
        </div>
        <div class="row add-bottom">
            <div class="row">
                <div class="col-full s-content__main">
                    {!! Form::model($user, ['route' => ['profiles.update', $user->id], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}
                    @include('profiles.fields')
                    {!! Form::close() !!}
                    {!! Form::open(['route' => ['profiles.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='full-width'>
                        {!! Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn--primary full-width', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div> <!-- end row -->
        </div> <!-- end row -->
    </section> <!-- end styles -->
@endsection
