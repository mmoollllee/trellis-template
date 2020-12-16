jQuery(window).scroll(function () {
   if (jQuery(window).scrollTop() > 50) {
      jQuery('body').addClass('scrolled')
   } else {
      jQuery('body').removeClass('scrolled')
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
