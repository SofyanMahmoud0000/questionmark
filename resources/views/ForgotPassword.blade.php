@component('mail::message')

Now, you can reset your password by clicking here 

@component('mail::button', ['url' => $Url])
Button Text
@endcomponent

Thanks,<br>
{{ app('AppName') }}
@endcomponent
