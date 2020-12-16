$('.collapsible-button').on('click triggerCollapse', function() {

   var parent = $(this).parents('.collapsible')
   var inner = parent.find(".inner").first();
   var oldheight = inner.height();
   parent.addClass("preactive");
   var height = inner.height();
   parent.removeClass("preactive");

   if (!parent.hasClass("active")) {
      parent.attr("data-original-height", oldheight);
      inner.animate({
         height: height
      }, {
         queue: false,
         duration: 500
      });

      parent.find('.collapsible-button:button').text('Weniger anzeigen');
   } else {
      inner.animate({
         height: (parent.attr("data-original-height") + "px")
      }, {
         queue: false,
         duration: 500
      });

      parent.find('.collapsible-button:button').text('Mehr anzeigen');
   }
   parent.toggleClass('active');
   $(this).toggleClass('active');

   if (self.hasClass('active') && self.is("button")) {
      self.text('Weniger anzeigen');
   } else if (jQuery(this).is("button")) {
      self.text('Mehr anzeigen');
   }
});
