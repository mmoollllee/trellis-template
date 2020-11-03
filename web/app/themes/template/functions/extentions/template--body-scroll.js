jQuery(window).scroll(function () {
   if (jQuery(window).scrollTop() > 100) {
      jQuery('body').addClass('scrolled')
      jQuery('#header .main_navi').removeClass('active')
   } else {
      jQuery('body').removeClass('scrolled')
      jQuery('#header .main_navi').addClass('active')
   }
})

jQuery('body,html').bind(
   'scroll mousedown DOMMouseScroll mousewheel keyup',
   function (e) {
      if (e.which > 0 || e.type === 'mousedown' || e.type === 'mousewheel') {
         jQuery('html,body').stop()
      }
   },
)
