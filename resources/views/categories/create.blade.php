@extends('layouts.site')
@section('content')
    <!-- styles
        ================================================== -->
    <section id="styles" class="s-styles">
            @include('adminlte-templates::common.errors')
            <div class="row">
                <div class="col-full s-content__main">

                    <h3 class="add-bottom">Category</h3>

                    {!! Form::open(['route' => 'categories.store', 'enctype' => 'multipart/form-data']) !!}

                    @include('categories.fields')

                    {!! Form::close() !!}
                </div>
            </div> <!-- end row -->
        </div> <!-- end row -->
    </section> <!-- end styles -->
@endsection
