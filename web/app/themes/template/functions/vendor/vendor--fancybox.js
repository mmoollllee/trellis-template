jQuery(document).ready(function () {
   jQuery(
      '[data-fancybox], a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]',
   )
      .unbind('click')
      .fancybox({
         afterShow: function (instance, current) {
            var swiper = current.opts['$orig'].closest('.swiper-container')
            if(swiper.length > 1) {
               swiper.get(0).swiper.slideTo(current.index - 1);
            }
         },
         caption: function (instance, item) {
            if (jQuery(this).closest('figure').find('figcaption').html()) {
               return jQuery(this).closest('figure').find('figcaption').html()
            } else {
               var caption = jQuery(this).attr('data-caption') || jQuery(this).attr('title') || ''
               if (jQuery(this).attr('data-caption') == "") {
                  caption = ''
               }
               caption = caption.length ? caption : ''
               return caption
            }
         },
      })

   jQuery('a[href*="youtube.com/watch?v"]').fancybox()
   jQuery('a[href*="vimeo.com/"]').fancybox()

   jQuery(
      '.wp-block-gallery figure a[href$=".jpg"], .wp-block-gallery figure a[href$=".jpeg"],.wp-block-gallery figure a[href$=".png"],.wp-block-gallery figure a[href$=".gif"] , .wp-block-image a[href$=".jpg"], .wp-block-image a[href$=".jpeg"], .wp-block-image a[href$=".png"], .wp-block-image figure a[href$=".gif"]',
   )
      .fancybox()
      .attr('data-fancybox', 'gallery')

})
