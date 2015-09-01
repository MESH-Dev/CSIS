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

  if ( $('.side-menu').length )
  {
    $('.side-menu').css('top', $('.intro').position().top);
  }

  $('.network-nav-item').click(function(event) {
     var item = $(this).attr('id');
     $('.network-filter-status').slideDown();
     $('.network-filter').hide(); //Hide all dropdowns
     $('.'+item).slideDown('400'); //Show this dropdowns

  });

});
