<?php

/*
|-------------------------------------------
|                Guest
|-------------------------------------------
*/
Route::group(["middleware" => "guest:web,admin"] , function(){

    // -----------------
    // Front-end
    // -----------------
    Route::get('/', function () {
        return view('index');
    });

    // ---------------
    // Back-end
    // ---------------

    // google
    Route::get("redirect" , "GoogleUser\Create@redirectToProvider");
    Route::get("callback" , "GoogleUser\Create@Create");

    // not google
    Route::post("signin" , "User\SignIn@SignIn");
    Route::post("signup" , "User\Create@SignUp");
    Route::get("confirmationcheck" , "User\ConfirmationController@TokenCheck");

    // Forgot password
    Route::get("forgotpassword" , "User\ForgotPasswordController@Email");
    Route::get("forgotpasswordcheck" , "User\ForgotPasswordController@TokenCheck");
    Route::get("resetpassword" , "User\ForgotPasswordController@ResetPassword");

    Route::get("adminlogin" , "Admin\Control@SignIn");
    Route::get("createadmin" , "Admin\Control@CreateAdmin");
});
/*
|-------------------------------------------
|                  User
|-------------------------------------------
*/

Route::group(["middleware" => "user"] , function(){

    // -----------------
    // Front-end
    // -----------------
    Route::get("home" , function(){
        return view("Home");
    });
    Route::get("settings" , function(){
        return view("Settings");
    });


    //-----------------
    // Back-end
    // ---------------

    // Question
    Route::post("createquestion" , "Question\Create@Create");
    Route::get("deletequestion/{id?}" , "Question\Control@Delete");
    Route::get("like/{id?}" , "Question\Control@Like");
    Route::get("unlike/{id?}" , "Question\Control@UnLike");


    // Friend
    Route::get("follow/{id?}" , "Friends\Control@Follow");
    Route::get("unfollow/{id?}" , "Friends\Control@UnFollow");

    // Answer
    Route::post("createanswer" , "Answer\Create@Create");

    // Main
    Route::get("inbox" , "Main\Control@Inbox");
    Route::get("profile/{id?}" , "Main\Control@Profile");
    Route::get("friends" , "Main\Control@Friends");
    Route::get("home" , "Main\Control@Home");
    Route::get("search" , "Main\Control@Search");
    Route::get("notification" , "Main\Control@Notification");
    Route::get("inbox/{id}" , "Main\Control@OneQuestion");
    

    // Image
    Route::post("changeimage" , "User\Image@Change");
    Route::get("deleteimage" , "User\Image@Delete");
    Route::post("changecover" , "User\Cover@Change");

    // Logout
    Route::get("logout" , "User\Control@Logout");

    // Settings
    Route::get("changename" , "User\Control@ChangeName");
    Route::post("changepassword" , "User\Control@ChangePassword");
    Route::get("changeemail" , "User\ChangeEmailController@ChangeEmail");
    Route::get("changeemailcheck" , "User\ChangeEmailController@TokenCheck");
    Route::get("deleteaccount" , "User\Control@Delete");

    // Notifications
    Route::get("notifications" , "Main\Control@Notifications");
    Route::get("notification" , "Notification\Control@Notification");
    Route::get("clearnotifications" , "Notification\Control@Clear");
});



/*
|-------------------------------------------
|              Guest & User
|-------------------------------------------
*/
Route::group(["middleware" => "UserAndGuest:web,admin"] , function(){
    Route::get("test" , "User\Control@test");
    Route::get("event" , function(){
        $Event = event(new \App\Events\SignUp(1));
    });
}); 


/*
|------------------------------------
|              Admin
|------------------------------------
*/


Route::group(["middleware" => "admin"] , function(){
    Route::get("adminlogout" , "Admin\Control@LogOut");
    Route::get("reset" , "Admin\Control@Reset");
    Route::get("data" , "Admin\Control@Data");
    Route::get("seed" , "Admin\Control@Seed");

});

Route::get("asset", function(){
    echo asset("");
});









