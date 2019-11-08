@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert-box alert-box--error hideit">
            <p>{{ $error }}</p>
            <i class="fa fa-times alert-box__close"></i>
        </div> <!-- end error -->
    @endforeach
@endif
@if ($message = Session::get('success'))
    <div class="alert-box alert-box--success hideit">
        <p>{{ $message }}</p>
        <i class="fa fa-times alert-box__close"></i>
    </div> <!-- end success -->
@endif
@if ($message = Session::get('error'))
    <div class="alert-box alert-box--error hideit">
        <p>{{ $message }}</p>
        <i class="fa fa-times alert-box__close"></i>
    </div> <!-- end error -->
@endif
@if ($message = Session::get('warning'))
    <div class="alert-box alert-box--notice hideit">
        <p>{{ $message }}</p>
        <i class="fa fa-times alert-box__close"></i>
    </div> <!-- end notice -->
@endif
@if ($message = Session::get('info'))
    <div class="alert-box alert-box--info hideit">
        <p>{{ $message }}</p>
        <i class="fa fa-times alert-box__close"></i>
    </div> <!-- end info -->
@endif
{{--@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Please check the form below for errors
    </div>
@endif--}}
