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

  $('.media').css('height', height);
  $('.media .video-holder').css('height', height);


  $(window).resize(function() {
    var height = $( window ).width() / 2;

    $('.media').css('height', height);
    $('.media .video-holder').css('height', height);
  })


  $('.network-nav-item').click(function(event) {

     var item = $(this).attr('id');
     $('.network-filter-status').slideDown();
     $('.network-filter').hide(); //Hide all dropdowns
     $('.'+item).slideDown('400'); //Show this dropdowns

  });

  // var center = new google.maps.LatLng(37.4419, -122.1419);
  // var options = {
  //   'zoom': 13,
  //   'center': center,
  //   'mapTypeId': google.maps.MapTypeId.ROADMAP
  // };
  //
  // var map = new google.maps.Map(document.getElementById("map"), options);
  //
  // var markers = [];
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

  $('.banner').parallax("20%", -0.5);

  $('.blog-sidebar-title').click(function() {

    $(this).find('i').toggleClass('fa-caret-right');
    $(this).find('i').toggleClass('fa-caret-down');
    $(this).next().slideToggle();
    $(this).find('blog-sidebar-title-text').toggleClass('active-sidebar-title');
  });

});
