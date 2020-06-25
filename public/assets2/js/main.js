$(document).ready(function () {
  $('body').css('paddingTop', $('.navigation-bar').innerHeight());

  $(window).resize(function () {
    $('body').css('paddingTop', $('.navigation-bar').innerHeight());
  });
  /*  01 -- Menu Setting On Mobile */
    $('.menu').click(function () {
      $('.pop-setting').fadeIn();
      TweenMax.from(".menu-setting", 1, {
        scale:0.7,
        opacity:0,
        ease: Expo.easeInOut
      });
    });
    $('.pop-setting').click(function () {
      $(this).fadeOut();
    });
    $('.pop-setting .closer').click(function(e) {
      e.preventDefault();
      $('.pop-setting').fadeOut();
    });
    $('.pop-setting .menu-setting').click(function (e) {
      e.stopPropagation();
    });
    $(document).keydown(function (e) {
      if (e.keyCode == 27) {
        $('.pop-setting').fadeOut();
      }
    });

    /*02 -- */
    $('.modes').click(function (e) {
        e.preventDefault();
       if ($('.modes').html() === "Disable dark theme") {
           $('.modes').html($(this).data('content'));
           $('link[href*="theme"]').attr('href', 'assets2/css/white-theme.css');
       } else {
           $('.modes').html('Disable dark theme');
           $('link[href*="theme"]').attr('href', 'assets2/css/dark-theme.css');
       }
    });

    $('.title-action').click(function () {
        $(this).addClass('active').siblings().removeClass('active');
    });

    /*3*/
    $('.changed-btn.action').click(function () {
       $('.pop-up-setting').fadeIn();
        $('.' + $(this).data('named')).fadeIn();
    });
    $('.pop-up-setting').click(function () {
        $(this).fadeOut();
        $('.edit-user').fadeOut();
    });
    $('.pop-up-setting .edit-user').click(function (e) {
       e.stopPropagation();
    });
    $('.pop-up-setting .closer, .cancel-btn').click(function(e) {
      e.preventDefault();
      $('.pop-up-setting').fadeOut();
        $('.edit-user').fadeOut();
    });


    $(document).keydown(function (e) {
      if (e.keyCode == 27) {
        $('.pop-up-setting').fadeOut();
          $('.edit-user').fadeOut();
      }
    });

    /*4*/
    $('.reply-button .btn-answer').click(function (e) {
        e.preventDefault();
       $(this).parents('.actions').next().fadeToggle();
    });
    /*5*/
    $('.nav-item').click(function () {
       $(this).addClass('active').siblings().removeClass('active');
    });
    /*6*/
    $('.options .clips').click(function (e) {
      e.preventDefault();
      if ($(this).parent().hasClass() === 'active') {
        $('.options').parent().removeClass('active');
      } else {
        $(this).parent().toggleClass('active');
      }
    });


    $('.follow-him a').click(function (e) {
      e.preventDefault();
      let Request = new XMLHttpRequest();
      Request.open("get" , this.href);
      Request.send();

      Request.onreadystatechange = () => {
      if(Request.readyState == 4 && Request.status == 200)
      {
        if ($(this).hasClass('active')) {
            $(this).html('UnFollow');
            $(this).removeClass('active');
            $(this).addClass('unfollow');
            var follow = $(this).attr('href').replace('follow','unfollow');
            $(this).attr('href', follow);
          } else {
            $(this).html('Follow');
            $(this).removeClass('unfollow');
            $(this).addClass('active');
            var un = $(this).attr('href').replace('unfollow','follow');
            $(this).attr('href', un);
          }
      }
    }
    });

    function taps(name) {
      $('.tapcontent').css('display', 'none');
      $('.title-action').removeClass('active');
      $(name).css('display', 'block');
    }

    $('#profile-action').click(function () {
      taps('.profile-user');
      $('.title-action').removeClass('active');
      $(this).addClass('active');
    });
    $('#account-action').click(function () {
      taps('.account-user');
      $('.title-action').removeClass('active');
      $(this).addClass('active');
    });

});
