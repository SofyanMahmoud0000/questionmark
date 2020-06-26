<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{secure_asset('css/data.css')}}">
</head>
<body>

    <div><button> <a href = "{{secure_asset('adminlogout')}}">Log out</a> </button></div>

    <h1> Activated accounts </h1>
    <table class="my_table">
    <tr>
        <th>Email</th>
        <th>Name</th>
        <th>Username</th>
    </tr>
    @foreach($Activated as $User)
    <tr> 
        <td>{{$User->email}}</td>
        <td>{{$User->name}}</td>
        <td>{{$User->username}}</td>
    </tr>
    @endforeach
    <tr> 
        <td colspan="2" class="total">Total</td>
        <td class="total">{{$Activated->count()}}</td>
    </tr>
    @if($ActivatedLastTime)
    <tr>
        <td colspan="2" class="increasing">Increasing</td>
        <td class="increasing">{{$ActivatedLastTime}}</td>
    </tr>
    @else 
    <tr>
        <td colspan="2" class="decreasing">Increasing</td>
        <td class="decreasing">{{$ActivatedLastTime}}</td>
    </tr>
    @endif
    </table>



    <h1> Deactivated accounts </h1>
    <table class="my_table">
    <tr>
        <th>Email</th>
        <th>Name</th>
        <th>Username</th>
    </tr>
    @foreach($Deactivated as $User) 
    <tr>
        <td>{{$User->email}}</td>
        <td>{{$User->name}}</td>
        <td>{{$User->username}}</td>    
    </tr>
    
    @endforeach
    <tr> 
        <td colspan="2" class="total">Total</td>
        <td class="total">{{$Deactivated->count()}}</td>
    </tr>
    @if($DeactivatedLastTime)
    <tr>
        <td colspan="2" class="increasing">Increasing</td>
        <td class="increasing">{{$DeactivatedLastTime}}</td>
    </tr>
    @else 
    <tr>
        <td colspan="2" class="decreasing">Increasing</td>
        <td class="decreasing">{{$DeactivatedLastTime}}</td>
    </tr>
    @endif
    </table>
</body>
</html>

