<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>?</title>
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
    <link href="https://fonts.googleapis.com/css?family=Bangers|Luckiest+Guy&amp;display=swap" rel="stylesheet"/>
    <!-- Bootstrap-->
    <link rel="stylesheet" href='{{asset("assets/css/bootstrap.min.css")}}'/>
    <!-- Normalize-->
    <link rel="stylesheet" href='{{asset("assets/css/normalize.css")}}'/>
    <!-- Main Source-->
    <link rel="stylesheet" href='{{asset("assets/css/main.css")}}'/>
  </head>
  <body>
    <main>
      <header class="navigation-bar"><a class="text-center upper" href="/">{{app("AppName")}}<span>?</span></a></header>
      <section class="sign-up">
        <div class="container">
          <div class="pop-sign">
              <div class="sign-box">
                <button class="closer" type="button"><i class="fas fa-times">       </i></button>
                <h4><span>Sign up with</span></h4><a class="google-btn" href="redirect"><i class="fab fa-google"></i>Sign up with Google</a>
                <h4><span>Or</span></h4>
                <form method="POST" action="signup">
                  <label>Name:*</label>
                  <input class="form-control" type="text" placeholder="" name="name"/>
                  <label>Email:*</label>
                  <input class="form-control" type="email" placeholder="" name="email"/>
                  <label>Password:*</label>
                  <input class="form-control" type="password" placeholder="" name="password"/>
                  <label>Confirm Password:*</label>
                  <input class="form-control" type="password" placeholder="" name="password_confirmation"/>
                  <button class="submit-btn" type="submit">Register</button>
                </form>
              </div>
            </div>
          <div class="pop-login">
            <div class="login-box">
              <button class="closer" type="button"><i class="fas fa-times"></i></button>
              <h4><span>Sign up with</span></h4><a class="google-btn" href="redirect"><i class="fab fa-google"></i>Continue with google</a>
              <h4><span>Or</span></h4>
              <form method="POST" action="signin">
                <label>Username or Email:*</label>
                <input class="form-control" type="email" placeholder="" name="email"/>
                <label>Password:*</label>
                <input class="form-control" type="password" placeholder="" name="password"/>
                <button class="submit-btn" type="submit">Log In</button>
              </form>
            </div>
          </div>
          <div class="first-page">
            <div class="cat"><img class="img-fluid" src="https://d1muxuiltlupn6.cloudfront.net/assets/owlcat-look-c5bf218fe8bfef6e2d2c1232ead722230299cc78789c2642fd6bb39de0a3bb92.gif"/></div>
            <p class="wel">Curious? Just ask!<br> Openly or anonymously.</p>
            <div class="login-form">
              <button class="sign-up-btn" type="button">Sign Up</button>
              <button class="log-in-btn" type="button">Log In</button>
            </div>
          </div>
          <!--success Box    -->
          @if(session()->has("message"))
          <div class="success-box"><i class="fas fa-check"></i>
            <p>{{session()->get("message")}}</p>
          </div>
          @endif
          <!--False Box-->
          @if(session()->has("error"))
          <div class="false-box"><i class="fas fa-times"></i>
            <p>{{session()->get("error")}}</p>
          </div>
          @endif
          <div class="social-media">
            <ul class="list-unstyled">
              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
              <li><a href="#"><i class="fab fa-instagram"></i></a></li>
              <li><a href="#"><i class="fab fa-youtube"></i></a></li>
            </ul>
          </div>
        </div>
      </section>
    </main>
    <!-- jQuery v3.4.0-->
    <script src='{{asset("assets/js/jquery-3.4.0.min.js")}}'></script>
    <!-- BootsTrap v4.3.1-->
    <script src='{{asset("assets/js/bootstrap.min.js")}}'></script>
    <!-- TweenMax-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
    <!-- Main Soruce-->
    <script src='{{asset("assets/js/main.js")}}'></script>
  </body>
</html>
