<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/data.css')}}">
</head>
<body>

    <div><button> <a href = "{{asset('adminlogout')}}">Log out</a> </button></div>

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
    </table>
</body>
</html>

