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




  $(window).resize(function() {
    var height = $( window ).width() / 2;

    $('.media').css('height', height);
    $('.media .video-holder').css('height', height);
  });





  //GOOGLE MAP
 // initialize();
function initialize() {

  var center = new google.maps.LatLng(10, 0);
  var options = {
    'zoom': 2,
    'center': center,
    'mapTypeId': google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById("map"), options);

  var markers = [];
  var profiles = {};

  var infowindow = new google.maps.InfoWindow({
    content: "..loading"
  });


  var templateUrl = profile_json.templateUrl;
  $.getJSON(templateUrl+'/data/user-profiles.json', function(data){
    for (var i = 0; i < data.length; i++) {
      var address = data[i]['City'] + ' ' + data[i]["State (USA only)"] + ' ' + data[i]["Country"];
      var contentString = i + ' ' + data[i]["Name | First"] + ' '+ data[i]["Name | Last"] + '<br><br>' + address;
      var lat =   data[i]["Lat"];
      var lng =   data[i]["Lng"];

      if(lat !='' && lng !=''){
        var latlng = new google.maps.LatLng(lat, lng);
        var marker = new google.maps.Marker({position: latlng, map: map, html: contentString});
        google.maps.event.addListener(marker, "click", function () {
           infowindow.setContent(this.html);
            infowindow.open(map, this);
        });
        markers.push(marker);
      }

    }

  });





  var markerCluster = new MarkerClusterer(map, markers);


}


  //Profile Popup
  $('.close-profile a').click(function(e) {
    e.preventDefault();
    $('.profile-container').fadeOut('slow');
  });

  $('.network-grid-item').click(function(e) {
    var itemOffset = $(this).offset().top;
    $('.profile-container').css('top',itemOffset+'px');
    var profile_id = $(this).parent().attr('data-id');
    $('.profile-container').fadeIn('slow');
    loadProfile(profile_id);


  });

  function loadProfile(profile_id) {
      var is_loading = false;
      if (is_loading == false) {
        is_loading = true;

        $('#loader').show();

        var data = {
            action: 'getSingleProfile',
            profile_id: profile_id
        };

        jQuery.post(ajaxurl, data, function(response) {
            // append: add the new statments to the existing data
            if(response != 0){
              $('.profile-content').empty();
              $('.profile-content').append(response);
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

  $('.banner').parallax("20%", -0.5);

  $('.blog-sidebar-title').click(function() {

    $(this).find('i').toggleClass('fa-caret-right');
    $(this).find('i').toggleClass('fa-caret-down');
    $(this).next().slideToggle();
    $(this).find('blog-sidebar-title-text').toggleClass('active-sidebar-title');
  });

});
