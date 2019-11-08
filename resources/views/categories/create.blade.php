@extends('layouts.site')
@section('content')
    <!-- styles
        ================================================== -->
    <section id="styles" class="s-styles">
        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1>Add Category</h1>
            </div>
        </div>
            <div class="row">
                <div class="col-full s-content__main">
                    {!! Form::open(['route' => 'categories.store', 'enctype' => 'multipart/form-data']) !!}
                        @include('categories.fields')
                    {!! Form::close() !!}
                </div>
            </div> <!-- end row -->
        </div> <!-- end row -->
    </section> <!-- end styles -->
@endsection
