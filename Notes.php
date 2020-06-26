<?php

/*

[1] in the route it's [User\create] not [User.create]

[2] when you use queue and jobs with mysql it cause error because of the length of a column but when you use the sqlite
    it don't make any error

    Solotion : to solve that in (mysql) make the length of the (queue column) be (100)

**** login with google 
**** adv
**** ignore some route in apidoc
**** if i want to chagne the password but furst i must check the current password, will i check the current password by the function (attempt) using (id) and (password)
**** must i use the function of attempt to check if the password is wrong or no

[3] when you use a directory (Models) to put all ur models in it , you will face a problem in a file i don't remember it's name 
    but the problem will occur when you use the funciton of (attempt) and the problem will be that there is a class that 
    return (App\<model>) not (App\Modles\<model>), so you will go to the constructor and change this value from 
    (App\<model>) to (App\Models\<modle>) by the functio of repalce or anything else

[4] in C++ if you pass an array be value you can change the value in the indecies but here in php if you want to make 
    change in the value of push a new data you must pass it by refrenece

[5] You can pass the request from function to another

[6] when i use the function (auth()->user()) it return only one user but when i use the functio (get) with this only one user
    it will converted to collection so you must user the function (first) if you used the function (get) with this only one user

        
[7] when i get the user by (auth()->user()) i can add any property i want like tht ($User["imageLink"] = <value>;)

    Note : remember how we treat with the data which reaturned from (User::all())

[8] You can use the object with session to put an array with the session (put) in this method 
        session()->put("name" , (object)<ur associative array>)
    and then you can access the valus in this method 
        session()->get("name")->name of property

**** The best way to use session to carry the informaiton of the authenticated user

**** The best way to select the best code 

**** What is the difference between login and attempt

[9] boolean is used to assign (0 or 1) in the migration 

[10] longText is used to assign(long text) in the migration

[11] when you upload ur project in the server you will find a problem to use the command (php artisan storage:link)
    and to solve this problem there are two methods
        [1] to save ur image in public not in storage 
            * you can do that by changing the (storage_path) to (public_path) in the public disk in (config/filesystem)

        [2] to use the method in the point [12]

[12] if you want to run a command and the server dosen't support (SSH) you can use (Artisan::call) as you do in the 
    file of (myCommand) like this
    Route::get("<route>" , function(){
        Artisan::call("<ur command>");
    });

[13] in the config/filesystem in the disk (public) there are two thing you must know
    [1] root : the directory which you will use 
    [2] url : the public path will you use to access this disk 

[14] the commmand (truncate) which is used to delete all rows in the table, you can use it if you used (sqlite)
    but when you use (mysql or phpmyadmin) it will cause an error so you can use 
    (DB::table('<name of table>')->delete()); instead of (\App\Models\User::truncate();)
        Note : name of table will be (users) not (User)

[14] when you use the factory like that (factory(App\Models\Question::class , 10)->create();)
        You must write all path of the model (App\Models\Question) and you can't use (use App\Models\Question) and then write only (Question) 

[15] The idea of the profile, that i will use the segment to get the last piece of the pathname which will contain the id of the 
    use then get this user then get all thing about this uesr, and now you won't use a session cuase here you may get profile 
    for non-authenticated user, so you will get the user and get all information about this user to send them to the view 
    without useing session


[16] if you used (<a href = "test"> Link </a>), it will replace the last piece of the pathname with (test)
    and if you used (<a href = {{asset("test)}}> Link </a>), it will go to (<protocol>://<host>/test)


[17] many to many : 
        [1] if you have many to many relatoin between (user , role) then you will have a pivot table name it (user_role)
        [2] to use belongsToMany in user model => belongsToMany("App\User" , "user_role" , "<name of forieng key>" , "<another key>");
        
        EX: if you have a user table and you want to create a many to many relatoinship for followings 
            Then the user will have two role (followings and followee), and you will create a pivot table which will point to 
            the id of the user 

            when you get the people who you follow you (followeds), you will write this function in the (user) model
            belongsToMany("App\User" , "name of pivot table" , "following_id" , "followed_id")

            Note : when you get the people who you follow, then you are followings, then the foriegn key is named (following_id)
            and the other key is (followed_id)

            Note : you can see this relation in the project 

[18] if you want to use many primary key => $table->primary(['followed_id','following_id']);

[19] when you use (where) you must use (get)
        EX: User::where("id" , 1)           => output will be null
        EX: User::where("id" , 1)->get()    => output will be good 

[20] The idea of the authentication is that i save the information of the authonticated user and save which table this user belongs
    to use it in the middleware and use the other information in the area of project

[21] The idea of notification: that i create a table which has the id of the user who own the notification and also has the type of th
    notificatoin and also has a column to carry the data which i need to use inthe notification and so on...

[22] Schema::defaultStringLength(191); 

[23] How to add multiply primay key and define them in model

[24] How to prevent the uesr to follow himself
        You must make the (following_id) differ from (followed_id) and it can be done by (different:field)
        EX: "followed_id" => "required|exists:users,id|different:following_id",

        Note : both followed_id and following_id must be the same type (string or integer or etc...) or they will be always different


[25] To use (created_at and updated_at) you will make (public $timestamp = true)
    and you can make it equal false -as we know- to ignore them


[26] to get data from database is (ordered)  
        [1] sortBy(<name of column>) : to sort the rows
        [2] sortByDesc(<name of column>) : to sort the rows (inverse)

[27] There is a problem with (update)
        If you want to use (update) you must put the column which you will update in the (fillalbe)

[28] when you define a default value in the database, you easily can assign another value when you create a new model


[29] when i needed to get the information of users at any area in the project i used (singleton) and put all information i need in it 
    like (number of notifications , number of inbox , name of user , id , etc..)

[30] Str::startsWith(String, "http") : to check if the string start with (http) or no

[31] no one can follow him self and the following row can't be repeat

[32] Even the code of 
        if(auth()->user())
            auth()->logout();
        DB::table('users')->delete();
        Artisan::call("migrate:fresh");
        Artisan::call("db:seed");
        $Users = \App\Models\User::all();
    You can put it in a job

[33] if you want to get the size of the array => count(<array>)

[34] if you want to check if the property is exists in the object or no => (property_exists(<object> , <name of property in string>))

[35] if you want to check if the property is null or no => (isset(<property>) e.g : isset($Message->Url);

[36] if you want to know the size of the object => count((array)$object)

[37] Adding a parameter to the object withotu changing the database **

[38] u can mark the notification as read by it's id 
        auth()->user()->notifications->find(<id of the notification>)->markAsRead();

[39] u can delete all notifications of the user => auth()->user()->notirications->each->delete();

[40] u can easily delete one notification as you delete every thing

[41] You can make a model for the notifications

[42] if you want to get a notification concerned with specific data in the (data column), you can do that 
        $Notification = Notification::where("data" , "like" , '%"user_id":1%')
                                    ->where("notifiable_id" , $Notifiable_id)
                                    ->where("data" , "like" , "%follow%")->get()->first();
        
        Note : the most imporant part here is ('%"user_id":1%') and there is no space between ("user_id" and %), so if you write 
                ('% "user_id":1 %') => it will be wrong

[43] Knowing more about (token) in socialite

[44] Listeners don't work (really shit)
        I just removed the cash from (bootstrap) and runed (composer install)

[45] How to make the notification which you get by using model be readed 
        You can update the column of (read_at) and make its value to be (now()), cuz when i get the notification using modle
        i can't use the functin markAsRead() but remember that you can delete the notification which you get by model

[46] Even if there is an increment column, you can insert the id by ur self

[47] remove an element from the array => (unset($Array[<key>]))

[48] check the path of the model in the (guards)

[49] Multi guard  
        - The idea of the milty guard => there are some roles which can be accessed by all guards(user , admin , etc..)
        such as (signup , login) and every thing of the guest so in this routes we will use only one middleware(guest)
        and in this middleware we will path all our guards and check if all guards are null(not logged in) they can go to those routes  
        and there are some routes that only one guard can access 

        - How to think about middlewares : you will have more routes, those routes you will devided according to who can access them
        and then make middlewares to can control all division of the routes

        - How to pass more guard to the route :
            [1] in the route : Route::get(...)->middleware(<name of middleware> :<guard_1>,<guard_2>,etc..)
                    Note : there is no space in the guards => [:guard_1,guard_2] not [: guard_1 , guard_2]
                    Note: if you want to pass null in the guard => (<name of middleware> :, <guard_2> , etc..) => [:,] not [: ,]


            [2] in the middleware :  public function handle($request, Closure $next , $guard_1 , $guard_2 , ttc.. )
                                    {
                                        code
                                    }
                Note : it's better to take default value for the parameters the ($guard_1 = null , $guard_2 = null , etc..) and you know why

[50] Some problem when i upload in (000webhost) 
    
        [1] in 000webhost if you write (return redirect("home")) and the name of view is called ("Home"), it will be error and 
            it will tell you that there is not view("home"), which mean any name of file must be (sensitive)
            but in local, it's not sensitive [but it's recomended to make all work be sensitive]

        [2] You can't use any thing of Artisan when you use a hosting that it will tell you that (putenv() is disabled or any thing like that)
            and to solve this problem, you will go to the file of the problem -which will be disable in the error page- and make the line 
            of the problem be command [it may be different from version to another but this error appread in 
            (/vendor/symfony/console/Application.php) in the lines (899 , 116 , 117)] 



[34]  
    white theme

    likes 
    forgot password 
    policies => the following can't be repeat and also likes
    Check if you record the notifications or no


[20] Finishing project
[21] js 
[23] project of js
[24] prepare acm
[25] english
[26] chat 

[27] event of facebook
[28] edit the cv

[29] missed parts 
        [1] policies , can , etc... 
        [2] rule 
        [3] resource 


*/

?>