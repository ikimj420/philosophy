@extends('layouts.site')
@section('content')
<!-- styles
    ================================================== -->
<section id="styles" class="s-styles">
    <div class="row add-bottom">
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="row">

            <div class="col-full s-content__main">
                <h1 class="pull-right">
                    <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('categories.create') !!}">Add New</a>
                </h1>
            </div>

        </div> <!-- end row -->

        <div class="col-twelve">

            <div class="table-responsive">

                <table>
                    <thead>
                    <tr>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td><a href="{!! route('categories.edit', [$category->id]) !!}">{!! $category->name !!}</a></td>
                            <td>{!! $category->desc !!}</td>
                            <td>
                                {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    {!! Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @empty
                        <p>No</p>
                    @endforelse
                    </tbody>
                </table>

                <div class="col-full">
                    <nav class="pgn">
                        <ul>
                            {!! $categories->links() !!}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div> <!-- end row -->
</section> <!-- end styles -->
@endsection

