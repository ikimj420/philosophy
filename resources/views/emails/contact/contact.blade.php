@component('mail::message')
    Message :<br>
    {!! $data['message'] !!}<br>
    From <br>
    {!! $data['name'] !!}<br>
    Email <br>
    {!! $data['email'] !!}
@endcomponent
