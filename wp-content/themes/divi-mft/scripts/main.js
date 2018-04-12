jQuery(document).ready(function($) {
  // Accordion mobile menu
  $('#mobile_menu li.menu-item-has-children').each(function() {
    $(this).children('a').on('click', function(e) {
      $this_menu = $(this).closest('li.menu-item-has-children');
      if ($this_menu.hasClass('opened')) {
        $this_menu.removeClass('opened');
      } else {
        $this_menu.addClass('opened');
      }
    });
  });

  // Show mobile nav
  $('.mobile_menu_toggle').on('click', function(e) {
    e.preventDefault();
    $mobile_nav = $('.mobile_nav');
    if ($mobile_nav.hasClass('closed')) {
      $('.mobile_nav').removeClass('closed').addClass('opened');
    } else {
      $('.mobile_nav').addClass('closed').removeClass('opened');
    }
  });

});
