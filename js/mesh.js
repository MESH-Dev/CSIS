jQuery(document).ready(function($){

  //Are we loaded?
  console.log('New theme loaded!');

  //Let's do something awesome!

  $('a[href^="#"]').on('click', function(event) {

    var target = $( $(this).attr('href') );

    if( target.length ) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: target.offset().top
        }, 1000);
    }

  });


  $(document).scroll(function () {
    var y = $(this).scrollTop();

    if ( $('.side-menu').length ) {

      $('.side-menu').css('top', $('.intro').position().top - 60);

      if (y > 300) {
        $('.side-menu').css('position', 'fixed');
        $('.side-menu').css('top', 50);
      } else {
        $('.side-menu').css('position', 'absolute');
        $('.side-menu').css('top', $('.intro').position().top - 60);
      }


      if (y < $('#0').position().top) {
        $('.side-menu ul li').each(function(index) {
          if (index == 0) {
            $(this).addClass('scrolled-item');
          } else {
            $(this).removeClass('scrolled-item');
          }
        })

      }
      else if (y > $('#0').position().top && y < $('#1').position().top) {
        $('.side-menu ul li').each(function(index) {
          if (index == 0) {
            $(this).addClass('scrolled-item');
          } else {
            $(this).removeClass('scrolled-item');
          }
        })
      }
      else if (y > $('#1').position().top && y < $('#2').position().top) {
        $('.side-menu ul li').each(function(index) {
          if (index == 1) {
            $(this).addClass('scrolled-item');
          } else {
            $(this).removeClass('scrolled-item');
          }
        })
      }
      else if (y > $('#2').position().top && y < $('#3').position().top) {
        $('.side-menu ul li').each(function(index) {
          if (index == 2) {
            $(this).addClass('scrolled-item');
          } else {
            $(this).removeClass('scrolled-item');
          }
        })
      }
      else if (y > $('#3').position().top && y < $('#4').position().top) {
        $('.side-menu ul li').each(function(index) {
          if (index == 3) {
            $(this).addClass('scrolled-item');
          } else {
            $(this).removeClass('scrolled-item');
          }
        })
      }
      else if (y > $('#4').position().top && y < $('#5').position().top) {
        $('.side-menu ul li').each(function(index) {
          if (index == 4) {
            $(this).addClass('scrolled-item');
          } else {
            $(this).removeClass('scrolled-item');
          }
        })
      }
      else if (y > $('#5').position().top && y < $('#6').position().top) {
        $('.side-menu ul li').each(function(index) {
          if (index == 5) {
            $(this).addClass('scrolled-item');
          } else {
            $(this).removeClass('scrolled-item');
          }
        })
      }
      else if (y > $('#6').position().top && y < $('#7').position().top) {
        $('.side-menu ul li').each(function(index) {
          if (index == 6) {
            $(this).addClass('scrolled-item');
          } else {
            $(this).removeClass('scrolled-item');
          }
        })
      }
      else {

      }


    }

  });


  var height = $( window ).width() / 2;


  $('.media-video').css('height', height);
  $('.media-image').css('height', height);
  $('.media-video .video-holder').css('height', height);

  $('.media-item').matchHeight();

  $(window).resize(function() {
    var height = $( window ).width() / 2;

    $('.media-video').css('height', height);
    $('.media-image').css('height', height);
    $('.media-video .video-holder').css('height', height);

    $('.media-item').matchHeight();

  });





  $('form#general-email').submit(function(e) {
    e.preventDefault();
 
    var email = $( "input#email" ).val();
    if (email !== "" ) {
       
      console.log(email);
      AddGeneralEmail(email);
    }
    else{
      alert("Please Enter a Valid Email!");
    }
 
  });

  function AddGeneralEmail(email) {
      var is_loading = false;
      if (is_loading == false) {
        is_loading = true;
       $('form#general-email').fadeOut('slow');
        $('#loader').show();

        var data = {
            action: 'saveGeneralEmail',
            email: email
        };

        jQuery.post(ajaxurl, data, function(response) {
            // append: add the new statments to the existing data
            if(response != 0){
            
              console.log(response);

              $('.email-response').append(response);
              $('.email-response').css('opacity',1);
              is_loading = false;
              

            }
            else{
              $('#loader').hide();
              is_loading = false;

            }
        });
      }
  }

  $('.form-text .submit-buttons').click(function(e) {
    e.preventDefault();
 
    var email = $( "input#email" ).val();
    var firstname = $( "input#first-name" ).val();
    var lastname = $( "input#last-name" ).val();
    if (email !== "" && firstname!=="" && lastname!=="" ) {
      AddProductEmail(email,firstname,lastname);
    }
    else{
      alert("Please Enter All Fields");
    }
 
  });

  $('form#productEmail').submit(function(e) {
    e.preventDefault();
 
    var email = $( "input#email" ).val();
    var firstname = $( "input#first-name" ).val();
    var lastname = $( "input#last-name" ).val();
    if (email !== "" && firstname!=="" && lastname!=="" ) {
      AddProductEmail(email,firstname,lastname);
    }
    else{
      alert("Please Enter All Fields");
    }
 
  });

  function AddProductEmail(email,firstname,lastname) {
      var is_loading = false;
      if (is_loading == false) {
        is_loading = true;
        $('form#productEmail').fadeOut('slow');
        $('#loader').show();
        var pagename = document.title;


        var data = {
            action: 'saveProductEmail',
            email: email,
            firstname: firstname,
            lastname: lastname,
            pagename: pagename

        };

        jQuery.post(ajaxurl, data, function(response) {
            // append: add the new statments to the existing data
            if(response != 0){
            
              console.log(response);

              $('.email-response').append(response);
              $('.email-response').css('opacity',1);
              is_loading = false;
              

            }
            else{
              $('#loader').hide();
              is_loading = false;

            }
        });
      }
  }












  // for (var i = 0; i < 100; i++) {
  //   var latLng = new google.maps.LatLng(data.photos[i].latitude,
  //       data.photos[i].longitude);

  //   var marker = new google.maps.Marker({'position': latLng});
  //   markers.push(marker);
  // }
  // var markerCluster = new MarkerClusterer(map, markers);




  $('.callout').matchHeight();
  $('.listing-text').matchHeight();
  $('.blog-post-small').matchHeight();
  $('.blog-section').matchHeight();
  $('.information-holder').matchHeight();


  $('.banner').parallax("center", 0.1);

  $('.blog-sidebar-title').click(function() {

    $(this).find('i').toggleClass('fa-caret-right');
    $(this).find('i').toggleClass('fa-caret-down');
    $(this).next().slideToggle();
    $(this).find('blog-sidebar-title-text').toggleClass('active-sidebar-title');
  });

});
