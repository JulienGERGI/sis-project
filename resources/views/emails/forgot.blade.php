@component('mail::message')
    Hwllo {{$user->name}},
    <p>We understand it happens .</p>
    @component('mail::button',['url'=>url('reset/'.$user->remember_token)])
        Reset Your Password
    @endcomponent

    <p>In case you have any issues recovering ,please contact us .</p>
    shouuukran,<br>
    {{config('app.name')}}
@endcomponent
