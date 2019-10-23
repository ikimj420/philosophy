@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Profile
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    <div>
                        {!! $user->fullName; !!}
                    </div>
                    <div>
                        {!! $user->username; !!}
                    </div>
                    <div>
                        {!! $user->email; !!}
                    </div>
                    <div>
                        {!! $user->bio; !!}
                    </div>
                </div>
                    <a href="{!! route('profiles.edit', [$user->id]) !!}"> Edit</a>
            </div>
        </div>
    </div>
@endsection



