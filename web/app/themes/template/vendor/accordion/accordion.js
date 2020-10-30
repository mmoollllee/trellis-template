jQuery(document).ready(function() {
	
	var wrapper = jQuery(".accordion");

	var hash = window.location.hash;
	if ( hash ) {
	  setTimeout(function() {
			jQuery(hash).toggleClass("active").toggleClass("inactive");
	  }, 10)
	};

	wrapper.each(function() {
		if ( !jQuery(this).hasClass("active")) {
			jQuery(this).addClass("inactive");
		}

		jQuery(this).find('header h2').click(function(){

			parent = jQuery(this).parents('.accordion');
			
			if (parent.hasClass("inactive")) {
				var hash = parent.attr("id");
				history.pushState({}, '', "#" + hash);
				scrollto("#" + hash)
			}

			//Expand or collapse this panel
			parent.toggleClass("active").toggleClass("inactive");
	
			//Hide the other panels
			//wrapper.find(".inner").not(jQuery(this).next()).slideUp('fast').parent().removeClass("active");
	
		 });
	});

});
