jQuery(document).ready(function() {
  jQuery("a[href*='#'][href!='#']").click( function(e) {		var target = jQuery(this).attr("href").split("#");
    if ( target[0] == "" || window.location.href.split("#")[0] == target[0] || window.location.pathname == target[0]) {
      e.preventDefault();
      scrollto("#" + target[1]);
    }
  });

  var hash = window.location.hash;
  if ( hash ) {
    setTimeout(function() {
          window.scrollTo(0, 0), scrollto(hash)
    }, 10)
  };
});

function scrollto( target ) {

  var position = jQuery(target).offset();
  //position = jQuery("[name='"+target.split("#")[1]+"']").offset();

  jQuery(window.opera?'html':'html, body').animate({
    scrollTop : position.top + "px"
  },500);

  jQuery('body').stop().animate({
    scrollTop : position.top + "px"
  },500)
}

jQuery.fn.isOnScreen = function() {

    var win			= jQuery( window );
    var viewport	= {
        top		: win.scrollTop(),
        left	: win.scrollLeft()
    };

    viewport.right	= viewport.left + win.width();
    /* divided 2, to make it only the upper viewport */
    viewport.bottom	= viewport.top + win.height() / 2;

    var bounds		= this.offset();
    bounds.right	= bounds.left + this.outerWidth();
    bounds.bottom	= bounds.top + this.outerHeight();

    return ( ! ( viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom ) );

}
