
@php(var_dump(auth()->user()->notifications))

@foreach (auth()->user()->unreadNotifications as $notification)
    {{$notification->data["content"]}}
    <br>
    {{$notification->data["Url"] . $notification->id}}
    <br>
@endforeach