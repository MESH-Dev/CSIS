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
    }

  });


$('.topic-list li').click(function(event) {
    var section = $(this).attr('data-id');
    $('form#Filters fieldset').hide();
    $('form#Filters fieldset[name=' + section+']').show();

});


  $('.network-nav-item').click(function(event) {

     var item = $(this).attr('id');
     $('.network-filter-status').slideDown();
     $('.network-filter').hide(); //Hide all dropdowns
     $('.'+item).slideDown('400'); //Show this dropdowns

  });

    //Live Search Global Network
   $("input#network-search").keyup(function(){
        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val();
 
        // Loop through grid items
        $(".network-grid .network-grid-item").each(function(){
 
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
 
            // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).fadeIn();
   
            }
        });
 
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

});
