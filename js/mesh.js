jQuery(document).ready(function($){
 
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


  if ( $('.side-menu').length ) {
    $('.side-menu').css('top', $('.intro').position().top - 60);
  }

  $('.menu-toggle').click(function() {
    $('.main-navigation').slideToggle();
    $('.fa').toggleClass('fa-chevron-up');
    $('.fa').toggleClass('fa-chevron-down');
  });

  if( $(window).width() <= 768){
    $('.banner').css("background-attachment", "scroll");
    $('.banner').css("background-position", "50% 0px");
  };

  //Don't think this is doing anything
  //var side = [];

  // $('.side-menu ul li').each(function(index) {

  //   $(this).find('a').attr('href');

  //   var $tabValue = $(this).find('a').attr('href');

  //   //console.log("Tab value " + $tabValue);
  //   var $withoutHash = $tabValue.substring(1);
  //   //console.log("Without Hash " + $withoutHash);
  //   side.push($withoutHash);

  //   var _push = side.push($withoutHash);
  //   //console.log("Side array = " + _push);

  // });

  // var sections = [];
  // var data_section = [];
  // var _in_menu = $('section').attr('data-menu');

  // console.log(_in_menu);

  // //function section_array(){
  // $('section').each(function(index) {
  //   if ((index != 0) && ($(this).attr('id') != 'apply') &&  ($(this).attr('id') != 'buttons')) { //&& ($(this).attr('data-menu') != '')
  //     var st = sections.push($(this).position().top);
  //     console.log("Sections push " + st);

  //     var _top = $(this).offset().top;
  //     var ds = $(this).attr('data-section', _top);

  //     data_section.push($(this).data('section'));
  //     console.log("Data sections are " + data_section);
  //     return ds;
  //     return _top;
  //     //for(i=0; i<sections.length; i++){
  //     //  $('.side-menu ul li').each(function(){
  //     //   //i++;
  //     //   //$(this).eq(i).attr('data-section', data_section[i]);
  //     //   $(this).attr('data-section', _top);
  //     //   $(this).addClass('data-section');
  //     // })
  //    //}
  //     //var _top = sections.push($(this).position().top);
  //     //console.log("Top positions " + _top);
  //   }
  // });
//}

//Only run the onScroll function if .side-menu exists
if($('.side-menu').length > 0){

  $(document).scroll(onScroll);

}

function onScroll(event){
    var scrollPos = $(document).scrollTop();
    $('.page-template-product .side-menu .list a').each(function () {
        
        console.log('Scrolling!');
        //var refElement = "";
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        //console.log(refElement);
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('.side-menu .list ul li').removeClass("scrolled-item");
            currLink.parent('li').addClass("scrolled-item");
        }
        else{
            currLink.parent('li').removeClass("scrolled-item");
        
        }
    });

    //Sroll the side menu after the window has scrolled past 300px
      if ($('.side-menu').length != 0 && scrollPos > 300) {
        $('.side-menu').css('position', 'fixed');
        $('.side-menu').css('top', 50);
      // Stop scrolling if the window has returned to top
      } else {
        $('.side-menu').css('position', 'absolute');
        $('.side-menu').css('top', $('.intro').position().top - 60);
      }
}



// section_array();

//   for(i=0; i<sections.length; i++){
//    $('.side-menu ul li').each(function(){
//         //var _top = $(this).offset().top;
//         section_array();
//         $(this).eq(i).attr('data-section', _top);
//   })
//   }

  // $(document).scroll(function () {
  //   var y = $(this).scrollTop();
  //   console.log("This scrolltop: " + y);
  //   if ( $('.side-menu').length ) {

  //     //Sroll the side menu after the window has scrolled past 300px
  //     if (y > 300) {
  //       $('.side-menu').css('position', 'fixed');
  //       $('.side-menu').css('top', 50);
  //     // Stop scrolling if the window has returned to top
  //     } else {
  //       $('.side-menu').css('position', 'absolute');
  //       $('.side-menu').css('top', $('.intro').position().top - 60);
  //     }

  //     //$('section').attr('data-top', $(this).offset().top);

  //     //i=0;
  //     //Sections[i] : The top position of the first section
  //     //Sections[i + 1] : The top position of the immediately following section
  //     // console.log("Sections[i] = " + sections[i]);
  //     // console.log('Sections[i + 1]' + sections[i + 1]); 

  //     for (i = 0; i < sections.length; i++) {

  //       console.log("Sections[i] = " + sections[i]);
  //       console.log('Sections[i + 1]' + sections[i + 1]); 
  //       console.log(sections);
  //       //console.log(sections.val);
  //       //console.log($('.side-menu li a').text())

  //       if (y > sections[i] && y < sections[i + 1] ) {//&& y < sections[i + 1]
          
  //         $('.side-menu ul li').removeClass('scrolled-item');
  //         $('.side-menu ul li').eq(i).addClass('scrolled-item');
  //       }else if(y <= 300){
  //         $('.side-menu ul li').removeClass('scrolled-item');
  //       }
  //     }


  //   }

  // });







  $(window).resize(function() {

    if ($(window).width() > 700) {
      if ($('.wp-video').length) {
        $('.wp-video').each(function() {
          if ($(this).height() > 1000) {
            $(this).css('margin-top', '-40%');
          } else {
            $(this).css('margin-top', '20%');
          }
        });
      }
    } else {
      if ($('.wp-video').length) {
        $('.wp-video').each(function() {
          if ($(this).height() > 1000) {
            $(this).css('margin-top', '0');
          } else {
            $(this).css('margin-top', '0');
          }
        });
      }
    }
  });


  if ($('.wp-video').length) {

    $('.wp-video').each(function() {

      if ($(window).width() > 700) {
        if ($(this).height() > 1000) {
          $(this).css('margin-top', '-40%');
        } else {
          $(this).css('margin-top', '20%');
        }
      }
    });
  }

//Resizes the media continers listed on load and on resize
function media_resize() {
  var height_r = $(window).width();
  var height = $( window ).width() / 2;
  //console.log(height_r);

  if(height_r > 767){ //if window is 767px wide or greater use half the window width
  $('.media-video').css('height', height); //height_r
  $('.media-video .video-holder').css('height', height); //height_r
  $('.media-image').css('height', height); //height_r
  $('.media-video .video-holder .su-responsive-media-yes').css('height', height);
  }else{  //If window is less than 767px, resize to the window height
    $('.media-video').css('height', height_r);
    $('.media-video .video-holder').css('height', height_r);
    $('.media-image').css('height', height_r);
    $('.media-video .video-holder .su-responsive-media-yes').css('height', height_r);
  }
} //end media resize


  $('.media-item').matchHeight();
  
  media_resize();

  //Sniff for window size
  $(window).resize(function() {
    var height = $( window ).width() / 2;

    $('.media-item').matchHeight();

    if ($(window).width() > 300 ){
      //console.log("Window is "+$(window).width())
      media_resize();       
    }
  });

 

  //$(window).load(media_resize);

// if ($(window).width() < 767){
//   $('.media-video').css('height', '400');
//   $('.media-video .video-holder').css('height', '400');
//   $('.media-image').css('height', '400');
// }



  // $('form#general-email').submit(function(e) {
  //   e.preventDefault();
  //
  //   var email = $( "input#email" ).val();
  //   if (email !== "" ) {
  //
  //     console.log(email);
  //     AddGeneralEmail(email);
  //   }
  //   else{
  //     alert("Please Enter a Valid Email!");
  //   }
  //
  // });

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

  // $('.form-text .submit-buttons').click(function(e) {
  //   e.preventDefault();
  //
  //   var email = $( "input#email" ).val();
  //   var firstname = $( "input#first-name" ).val();
  //   var lastname = $( "input#last-name" ).val();
  //   if (email !== "" && firstname!=="" && lastname!=="" ) {
  //     AddProductEmail(email,firstname,lastname);
  //   }
  //   else{
  //     alert("Please Enter All Fields");
  //   }
  //
  // });
  //
  // $('form#productEmail').submit(function(e) {
  //   e.preventDefault();
  //
  //   var email = $( "input#email" ).val();
  //   var firstname = $( "input#first-name" ).val();
  //   var lastname = $( "input#last-name" ).val();
  //   if (email !== "" && firstname!=="" && lastname!=="" ) {
  //     AddProductEmail(email,firstname,lastname);
  //   }
  //   else{
  //     alert("Please Enter All Fields");
  //   }
  //
  // });

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
  //$('.blog-post-small').matchHeight();
  $('.blog-section').matchHeight();
  $('.blog-sidebar').matchHeight();
  $('.information-holder').matchHeight();
  $('.icon-box').matchHeight();


  if( $(window).width() >= 900){
    $('.banner').parallax("center", 0.1);
  };


  $('.blog-sidebar-title').click(function() {

    $(this).find('i').toggleClass('fa-caret-right');
    $(this).find('i').toggleClass('fa-caret-down');
    $(this).next().slideToggle();
    $(this).find('blog-sidebar-title-text').toggleClass('active-sidebar-title');
  });

  $('.next.page-numbers').click(function(e) {
      e.preventDefault();

      var page = $('.page-numbers.current').html();
      page = parseInt(page);
      page = page+1;
      console.log(page);
      loadPosts(page);
  });



  function loadPosts(page) {
      var is_loading = false;
      if (is_loading == false) {
        is_loading = true;

        $('#loader').show();

        var data = {
            action: 'loadPosts',
            query_vars: ajaxpagination.query_vars,
            page: page
        };

        jQuery.post(ajaxurl, data, function(response) {
            // append: add the new statments to the existing data
            if(response != 0){
              //$('.profile-content').empty();
              //console.log(response);
              $('#loadmore-posts').remove();
              $('.blog-content').append(response);
              //$('.blog-content').css('opacity',1);
              is_loading = false;
              $('.blog-section').matchHeight();


            }
            else{
              $('#loader').hide();
              is_loading = false;

            }
        });
      }
  }

$('.callout-panel h2').hover(function () {
    $test = $(this).parent().parent().parent();
    $arrow = $test.find(".cta-big");
    $arrow.css("opacity","0.7");

}, function () {
    $arrow.css("opacity","1");
});




// New tabs

  /* ==========
     Variables
   ========== */
   var url = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');

  /* ==========
      Utilities
    ========== */
   function beginsWith(needle, haystack){
     return (haystack.substr(0, needle.length) == needle);
   };


  /* ==========
     Anchors open in new tab/window
   ========== */
   $('a').each(function(){

     if(typeof $(this).attr('href') != "undefined") {
      var test = beginsWith( url, $(this).attr('href') );
      //if it's an external link then open in a new tab
      if( test == false && $(this).attr('href').indexOf('#') == -1){
        $(this).attr('target','_blank');
      }
     }
   });


});
