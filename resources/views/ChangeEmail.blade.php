@component('mail::message')
# Introduction

Someone has linked his account with this email 
if it's you, just click in the button below

@component('mail::button', ['url' => $Url])
Button Text
@endcomponent

Thanks,<br>
{{app("AppName")}}
@endcomponent
