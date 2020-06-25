@component('mail::message')

Now you can click here to confirm your account

@component('mail::button', ['url' => $Url])
Confirmation
@endcomponent

Thanks,<br>
{{ app("AppName") }}
@endcomponent
