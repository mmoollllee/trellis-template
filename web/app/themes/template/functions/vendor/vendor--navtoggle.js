var slideout = new Slideout({
  'panel': document.getElementById('wrapper'),
  'menu': document.getElementById('responsivemenu'),
  'padding': 260,
  'tolerance': 70,
  'touch': false,
  'side' : 'right'
});

jQuery("#navtoggle").click(function() {
  if ( jQuery(window).width() >= 1200 ) {
    jQuery(this).parent().toggleClass("active");
  } else {
    slideout.toggle();
  }
});

slideout.on('open', function() {
  jQuery("#wrapper").click(function() {
    slideout.close();
  })
});

slideout.on('close', function() {
  jQuery("#wrapper").unbind('click');
});

jQuery("#responsivemenu a").click(function() {
  slideout.close();
})
