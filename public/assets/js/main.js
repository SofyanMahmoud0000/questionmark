$(document).ready(function () {
  $('.sign-up-btn').click(function () {
    $('.pop-sign').fadeIn();
    TweenMax.from(".sign-box", 2, {
      scale:0.7,
      opacity:0,
      ease: Expo.easeInOut
    });
  });
  $('.log-in-btn').click(function () {
    $('.pop-login').fadeIn();
    TweenMax.from(".login-box", 2, {
      scale:0.7,
      opacity:0,
      ease: Expo.easeInOut
    });
  });
  $('.pop-sign, .pop-login').click(function () {
    $(this).fadeOut();
  });
  $('.pop-sign .closer').click(function() {
    $('.pop-sign').fadeOut();
  });
  $('.pop-login .closer').click(function() {
    $('.pop-login').fadeOut();
  });
  $('.pop-sign .sign-box, .pop-login .login-box').click(function (e) {
    e.stopPropagation();
  });
  $(document).keydown(function (e) {
    if (e.keyCode == 27) {
      $('.pop-sign, .pop-login').fadeOut();
    }
  });

  $('.sign-up .pop-sign').css('paddingTop', $('.navigation-bar').innerHeight());

  TweenMax.staggerFrom(".social-media ul li", 2, {
    scale:0.7,
    x:-20,
    opacity:0,
    ease: Expo.easeInOut
  }, 0.5);

});
