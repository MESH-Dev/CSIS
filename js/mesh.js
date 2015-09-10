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

 



 
  //GOOGLE MAP
 initialize();
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

});