<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use App\Http\Controllers\User\Image;
use App\Http\Controllers\User\Cover;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public' , function() {return base_path('public');});
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->singleton("AppName" , function(){
            // return "Question mark?"; 
            return "Question mark?";
        });


        app()->singleton("User" , function(){
            $Image = new Image;
            $Cover = new Cover;
            return (object)array(
                "id"        => auth()->user()->id,
                "name"      => auth()->user()->name,
                "email"     => auth()->user()->email,
                "username"  => auth()->user()->username,
                "image"     => $Image->ReturnImage(),
                "cover"     => $Cover->ReturnCover(),
                "inbox"     => auth()->user()->OtherQuesions->where("has_answer" , 0)->where("read" , 0)->count(),
                "notifications" => auth()->user()->unreadNotifications->count(),
            );
        });

        app()->singleton("Team" , function(){
            return User::find(1);
        });


        
        Schema::defaultStringLength(191); 
    }
}
