@component('mail::message')
    Hwllo {{$user->name}},
    <p>We understand it happens .</p>
    @component('mail::button',['url'=>url('admin/reset/'.$$user->remeber_token)])
        Reset Your Password
    @endcomponentClass

    <p>In case you have any issues recovering ,please contact us .</p>
    shouuukran,<br>
    {{config('app.name')}}
@endcomponentClass
