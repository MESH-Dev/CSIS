
  //-------GLOBAL NETWORK JS-----------//
var $ =jQuery.noConflict();


//Control Nav Dropdown/Active Section
$('.network-nav-item').click(function(event) {

  var item = $(this).attr('id');

  if(item == 'network-filter-topics'){
    $('.network-filter-status').slideDown();
  }
  else{
    $('.network-filter-status').hide();
  }

  

  $('.network-filter').hide(); //Hide all dropdowns
  $('.'+item).slideDown('400'); //Show this dropdowns
  if(item == 'network-map'){
    initialize();
  }

});



//Clost all filter sections
$('.close-filter').click(function(e) {
  e.preventDefault();
   $('.network-filter').hide(); //Hide all dropdowns
  
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


//Show Appropriate topic List on title click
$('.topic-list li').click(function(event) {
    var section = $(this).attr('data-id');
    $('form#Filters fieldset').hide();
    $('form#Filters fieldset[name=' + section+']').show();

});


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
  $('.profile-content').css('opacity',0);
  loadProfile(profile_id);
});




//AJAX in profile data from json file
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
              console.log(response);

              $('.profile-content').append(response);
              $('.profile-content').css('opacity',1);
              is_loading = false;


            }
            else{
              $('#loader').hide();
              is_loading = false;

            }
        });
      }
  }





// ------------------------------------------------------
// ------------------ Filters----------------------------
// ------------------------------------------------------



//Update active filters and display
function GetActiveString(){
  var active = [];
  $('.checkbox input:checked').each(function() {
      active.push($(this).attr('data-filter'));
  });


  var filtered = active.join(", ");
  if(filtered !== '')
    $('.filtered-list').html(filtered);
  else{
    $('.filtered-list').html('All');
  }

}


//========= PLUGIN ADD ON FOR MIXITUP =====================
// To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "checkboxFilter".
var checkboxFilter = {

  // Declare any variables we will need as properties of the object

  $filters: null,
  $reset: null,
  groups: [],
  outputArray: [],
  outputString: '',

  // The "init" method will run on document ready and cache any jQuery objects we will need.

  init: function(){
    var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "checkboxFilter" object so that we can share methods and properties between all parts of the object.

    self.$filters = $('#Filters');
    self.$reset = $('.reset');
    self.$container = $('#network-grid');

    self.$filters.find('fieldset').each(function(){
      self.groups.push({
        $inputs: $(this).find('input'),
        active: [],
		    tracker: false
      });
    });

    self.bindHandlers();
  },

  // The "bindHandlers" method will listen for whenever a form value changes.

  bindHandlers: function(){
    var self = this;

    self.$filters.on('change', function(){
      self.parseFilters();
    });

    self.$reset.on('click', function(e){
      e.preventDefault();
      self.$filters[0].reset();
      self.parseFilters();
    });
  },

  // The parseFilters method checks which filters are active in each group:

  parseFilters: function(){
    var self = this;

    // loop through each filter group and add active filters to arrays

    for(var i = 0, group; group = self.groups[i]; i++){
      group.active = []; // reset arrays
      group.$inputs.each(function(){
        $(this).is(':checked') && group.active.push(this.value);
      });
	    group.active.length && (group.tracker = 0);
    }

    self.concatenate();
  },

  // The "concatenate" method will crawl through each group, concatenating filters as desired:

  concatenate: function(){
    var self = this,
		  cache = '',
		  crawled = false,
		  checkTrackers = function(){
        var done = 0;

        for(var i = 0, group; group = self.groups[i]; i++){
          (group.tracker === false) && done++;
        }

        return (done < self.groups.length);
      },
      crawl = function(){
        for(var i = 0, group; group = self.groups[i]; i++){
          group.active[group.tracker] && (cache += group.active[group.tracker]);

          if(i === self.groups.length - 1){
            self.outputArray.push(cache);
            cache = '';
            updateTrackers();
          }
        }
      },
      updateTrackers = function(){
        for(var i = self.groups.length - 1; i > -1; i--){
          var group = self.groups[i];

          if(group.active[group.tracker + 1]){
            group.tracker++;
            break;
          } else if(i > 0){
            group.tracker && (group.tracker = 0);
          } else {
            crawled = true;
          }
        }
      };

    self.outputArray = []; // reset output array

	  do{
		  crawl();
	  }
	  while(!crawled && checkTrackers());

    self.outputString = self.outputArray.join();

    // If the output string is empty, show all rather than none:

    !self.outputString.length && (self.outputString = 'all');

    //console.log(self.outputString);

    // ^ we can check the console here to take a look at the filter string that is produced

    // Send the output string to MixItUp via the 'filter' method:

	  if(self.$container.mixItUp('isLoaded')){
    	self.$container.mixItUp('filter', self.outputString);
	  }
  }
};
//=======END FILTER BY CHECKBOX PLUGIN





jQuery(document).ready(function($){

  // Initialize checkboxFilter code

  checkboxFilter.init();

  // Instantiate MixItUp

  $('#network-grid').mixItUp({
    controls: {
      enable: false // we won't be needing these
    },
    animation: {
      easing: 'cubic-bezier(0.86, 0, 0.07, 1)',
      duration: 600
    },
    callbacks: {
      onMixEnd: GetActiveString
    }

  });



  //URL FILTERS
   var filter = getParameterByName('filter');
 
  //check if url filter is present - initialize mixitup and prefilter 
  if(filter !==''){
    $("input[value='" + filter + "']").prop('checked', true);
    $('#network-grid').mixItUp('filter', filter, GetActiveString);
    $(".network-filter-status").slideDown();
  }

  // //Show profile from url
  // var profile_id = getParameterByName('profile');
  // if(profile_id !==''){
  //   var itemOffset = $('#22').offset().top;
  //   console.log(itemOffset);
  //   $('.profile-container').css('top',itemOffset+'px');
  //   $('.profile-container').fadeIn('slow');
  //   $('.profile-content').css('opacity',0);
  //   loadProfile(profile_id);

  //   $('html, body').animate({
  //       scrollTop: itemOffset
  //   }, 1000);

  // }
 

});


//funciton to easily retrieve URL Params
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


//Google Map Initilize
function initialize() {

  var center = new google.maps.LatLng(40.00, -75.2);
  var options = {
    'zoom': 3,
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
      var address = data[i]['City'] + ', ' + data[i]["State (USA only)"] + ' ' + data[i]["Country"];
      var contentString = '<img src="'+data[i]["Profile Picture"] +'" style="width: 100px; display: inline; float: left; padding-right: 10px;"><div style="display: inline; float: left;"><a href="#" class="map-link" data-id='+ i + '>'+ data[i]["Name | First"] + ' '+ data[i]["Name | Last"] + '</a><br>' + address+"</div>";
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

  var $selector = 'a.map-link'; //class for your infobox buttons list
    $(document).on('click', $selector, function(e){
     e.preventDefault();
     //var itemOffset = $(this).offset().top;
    var profile_id = $(this).attr('data-id');
    var itemOffset = $('.mix[data-id='+profile_id+']').offset().top;

    $('.profile-container').css('top',itemOffset+'px');
    $('.profile-container').fadeIn('slow');
    $('.profile-content').css('opacity',0);
    loadProfile(profile_id);
    $('html, body').animate({
       scrollTop: itemOffset
     }, 1000);
  });

 





  //var markerCluster = new MarkerClusterer(map, markers);


}
