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
                    <a class="btn full-width pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('categories.create') !!}">Add New Category</a>
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
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td><a href="{!! route('categories.edit', [$category->id]) !!}">{!! $category->name !!}</a></td>
                            <td>{!! $category->desc !!}</td>
                        </tr>
                    @empty
                        <p>Noting To Show</p>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end row -->
</section> <!-- end styles -->
@endsection

