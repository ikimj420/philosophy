@extends('layouts.site')
@section('content')
    <!-- styles
        ================================================== -->
    <section id="styles" class="s-styles">
        <div class="row add-bottom">
            <div class="row">

                <div class="col-full s-content__main">
                    {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        {!! Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn--primary full-width', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                    <h3 class="add-bottom">Category</h3>

                    {!! Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}

                    @include('categories.fields')

                    {!! Form::close() !!}
                </div>
            </div> <!-- end row -->
        </div> <!-- end row -->
    </section> <!-- end styles -->
@endsection
