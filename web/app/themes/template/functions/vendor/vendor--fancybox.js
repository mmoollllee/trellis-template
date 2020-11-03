jQuery(document).ready(function () {
   jQuery(
      '[data-fancybox], a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]',
   )
      .unbind('click')
      .fancybox({
         afterShow: function (instance, current) {
            current.opts['$orig']
               .closest('.flickity-enabled')
               .flickity('select', current.index, false, true)
         },
         caption: function (instance, item) {
            if (jQuery(this).closest('figure').find('figcaption').html()) {
               return jQuery(this).closest('figure').find('figcaption').html()
            } else {
               var caption = jQuery(this).attr('title') || ''
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

   setTimeout(function () {
      jQuery('.flickity-enabled').on('dragStart.flickity', function () {
         jQuery('.flickity-slider figure').css('pointer-events', 'none')
      })
      jQuery('.flickity-enabled').on('dragEnd.flickity', function () {
         jQuery('.flickity-slider figure').css('pointer-events', 'all')
      })
   }, 200)

   Flickity.defaults.pageDots = false
   Flickity.defaults.setGallerySize = false
   Flickity.defaults.imagesLoaded = false
   Flickity.defaults.contain = true
   Flickity.defaults.adaptiveHeight = false
})
