<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Settings</title>
    <!-- fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"/>
    <!-- Roboto Font-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&amp;display=swap" rel="stylesheet"/>
    <!-- Raleway Font-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700,800&amp;display=swap" rel="stylesheet"/>
    <!-- Poppins Font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,900&amp;display=swap" rel="stylesheet"/>
    <!-- Metrophobic Font-->
    <link href="https://fonts.googleapis.com/css?family=Metrophobic&amp;display=swap" rel="stylesheet"/>
    <!-- Luckiest-->
    <link href="https://fonts.googleapis.com/css?family=Bangers|Luckiest+Guy&amp;display=swap" rel="stylesheet"/>
    <!-- Righteous-->
    <link href="https://fonts.googleapis.com/css?family=Righteous&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Amiri:400,700&amp;display=swap" rel="stylesheet"/>
    <!-- Bootstrap-->
    <link rel="stylesheet" href="{{secure_asset('assets2/css/bootstrap.min.css')}}"/>
    <!-- Normalize-->
    <link rel="stylesheet" href="{{secure_asset('assets2/css/normalize.css')}}"/>
    <!-- Main Source-->
    <link rel="stylesheet" href="{{secure_asset('assets2/css/main.css')}}"/>
    <link rel="stylesheet" href="{{secure_asset('assets2/css/dark-theme.css')}}"/>
  </head>
  <body>
    <header class="navigation-bar">
      <div class="container">
        <!-- Navbar-->
        <div class="main-navbar">
          <nav class="navbar navbar-expand-lg"><a class="navbar-brand" href="{{secure_asset('home')}}">{{app("AppName")}}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="{{secure_asset('home')}}"><i class="fas fa-home"></i>Feed</a></li>
                <li class="nav-item"><a class="nav-link" href="{{secure_asset('profile')}}"><i class="fas fa-user"></i>Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="{{secure_asset('friends')}}"><i class="fas fa-user-friends"></i>Friends</a></li>
                <li class="nav-item"><a class="nav-link" href="{{secure_asset('inbox')}}"><i class="fas fa-envelope"></i>inbox
                  @if(app('User')->inbox)
                  <span class="counts-message">{{app('User')->inbox}}</span></a>
                  @else
                  <span class="counts-message" style = "display:none"></span></a>
                  @endif
                </li>
                <li class="nav-item"><a class="nav-link" href="{{secure_asset('notifications')}}"><i class="fas fa-bell"></i>Notifications
                  @if(app('User')->notifications)
                  <span class="counts-notifications">{{app('User')->notifications}}</span></a>
                  @else
                  <span class="counts-notifications" style = "display:none"></span></a>
                  @endif
                </li>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="{{app('User')->image}}"/></a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown"><a class="dropdown-item" href="{{secure_asset('settings')}}">Settings</a><a class="modes dropdown-item" href="#" data-content="Enable dark theme">Disable dark theme</a><a class="dropdown-item" href="{{secure_asset('logout')}}">Log Out</a></div>
                </li>
              </ul>
            </div>
          </nav>
        </div>
        <div class="mobile-nav">
          <nav class="navbar navbar-expand-lg">
            <div class="header"><span class="menu"></span><a class="navbar-brand" href="{{secure_asset('home')}}">{{app("AppName")}}</a></div>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active"><a class="nav-link" href="{{secure_asset('home')}}" title="Feed"><i class="fas fa-home"></i></a></li>
              <li class="nav-item"><a class="nav-link" href="{{secure_asset('friends')}}" title="Friends"><i class="fas fa-user-friends"></i></a></li>
              <li class="nav-item"><a class="nav-link" href="{{secure_asset('profile')}}" title="Profile"><img class="img-fluid" src="{{app('User')->image}}"/></a></li>
              <li class="nav-item"><a class="nav-link" href="{{secure_asset('inbox')}}" title="Inbox"><i class="fas fa-envelope"></i></a></li>
                @if(app("User")->inbox)
                <span class="counts-message">{{app('User')->inbox}}</span>
                @else
                <span class="counts-message" style = "display:none">{{app('User')->inbox}}</span>
                @endif
              
              <li class="nav-item"><a class="nav-link" href="{{secure_asset('notifications')}}" title="Notifications"><i class="fas fa-bell"></i></a></li>
                @if(app("User")->notifications)
                <span class="counts-notifications">{{app('User')->notifications}}</span>
                @else
                <span class="counts-notifications" style = "display:none">{{app('User')->notifications}}</span>
                @endif
            </ul>
          </nav>
        </div>
      </div>
    </header>
    <div class="pop-setting">
      <div class="menu-setting">
        <div class="inner-box">
          <div class="head-title">
            <h2>Menu</h2><a href="#"><i class="fas fa-times closer"></i></a>
          </div>
          <ul class="list-unstyled">
            <li> <a href="{{secure_asset('settings')}}">Settings</a></li>
            <li> <a href="{{secure_asset('logout')}}">Log Out</a></li>
            <li> <a href="#">Help</a></li>
            <li> <a href="#">Terms of use</a></li>
            <li> <a href="#">Privacy policy</a></li>
            <li><a class="modes" href="#" data-content="Enable dark theme">Disable dark theme</a></li>
          </ul>
        </div>
      </div>
    </div>
    <main>
      <div class="container">
        <div class="pop-up-setting">
          <div class="pop-name edit-user username"><a class="exit" href="#"><i class="fas fa-times closer"></i></a>
            <div class="header-title"><span>Change Your Username</span></div>
            <form method="GET" action="{{secure_asset('changename')}}">
              <label>Current name</label>
              <input class="form-control" type="text" value = "{{app('User')->name}}" disabled/>
              <label>New name</label>
              <input class="form-control" type="text" name="name"/>
              <button class="btn-submit" type="submit">Save</button>
            </form>
          </div>
          <div class="pop-email edit-user email"><a class="exit" href="#"><i class="fas fa-times closer"></i></a>
            <div class="header-title"><span>Change Your Email</span></div>
            <form method="GET" action="{{secure_asset('changeemail')}}">
              <label>Current email</label>
              <input class="form-control" type="email" value="{{app('User')->email}}" disabled/>
              <label>New email</label>
              <input class="form-control" type="email" name="email"/>
              <label>Repeat new email</label>
              <input class="form-control" type="email" name="email_confirmation"/>
              <button class="btn-submit" type="submit">Save</button>
            </form>
          </div>
          <div class="pop-password edit-user password"><a class="exit" href="#"><i class="fas fa-times closer"></i></a>
            <div class="header-title"><span>Change Your Password</span></div>
            <form method="POST" action="{{secure_asset('changepassword')}}">
              <label>Current password</label>
              <input class="form-control" type="password" name="currentPassword"/>
              <label>New password</label>
              <input class="form-control" type="password" name="newPassword"/>
              <label>Repeat password</label>
              <input class="form-control" type="password" name="newPassword_confirmation"/>
              <button class="btn-submit" type="submit">Save</button>
            </form>
          </div>
          <div class="pop-photo photochange edit-user">
            <div class="box-photo"><a class="exit" href="#"><i class="fas fa-times closer"></i></a>
              <form method="POST" action="{{secure_asset('changeimage')}}" enctype = "multipart/form-data"><span class="mb-20"><img class="img-fluid" src="{{app('User')->image}}"/>
                  <input class="change-image changed-btn" type="file"/ name = "image">
                  <button class="change-image changed-btn">Change photo</button></span>
                <button class="btn-submit" type="submit">Save</button>
                <button class="btn-submit cancel-btn" type="button">Cancel</button>
              </form>
            </div>
          </div>
          <div class="pop-photo coverchange edit-user">
            <div class="box-photo"><a class="exit" href="#"><i class="fas fa-times closer"></i></a>
              <form method="POST" action="{{secure_asset('changecover')}}" enctype = "multipart/form-data"><span class="mb-20"><img class="img-fluid" src="{{app('User')->cover}}"/>
                  <input class="change-cover changed-btn" type="file"/ name = "cover">
                  <button class="change-image changed-btn">Change cover</button></span>
                <button class="btn-submit" type="submit">Save</button>
                <button class="btn-submit cancel-btn" type="button">Cancel</button>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="settings mt-20 col-lg-8">
            <div class="main-column">
              <section>
                <header class="mb-20"><span class="title-action active" id="account-action">Account</span><span class="title-action" id="profile-action">Profile</span></header>
                @if(session()->has("message"))
                <div class="message-true"><span>{{session()->get("message")}}</span></div>
                @endif
                @if(session()->has("error"))
                <div class="message-false"><span>{{session()->get("error")}}</span></div>
                @endif
                <div class="profile-user tapcontent">
                  <button class="change-image changed-btn action" data-named="photochange">Change image</button>
                  <button class="change-image changed-btn action" data-named="coverchange">Change cover</button><a class="delete-image changed-btn" href="deleteimage">Delete image</a>
                </div>
                <div class="account-user tapcontent">
                  <button class="change-name changed-btn action" data-named="username">Change name</button>
                  @if(Gate::denies("Settings"))
                  <button class="change-email changed-btn action" data-named="email">Change Email</button>
                  <button class="change-password changed-btn action" data-named="password">Change Password</button>
                  @endif
                  <a class="delete-acc changed-btn" href="{{secure_asset('deleteaccount')}}">Delete account</a>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- jQuery v3.4.0-->
    <script src="{{secure_asset('assets2/js/jquery-3.4.0.min.js')}}"></script>
    <!-- BootsTrap v4.3.1-->
    <script src="{{secure_asset('assets2/js/bootstrap.min.js')}}"></script>
    
    <!-- Main Soruce-->
    <script src="{{secure_asset('assets2/js/main.js')}}"></script>
  </body>
</html>
