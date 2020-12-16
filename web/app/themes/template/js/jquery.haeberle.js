$(document).ready(function(){
	buttonbr();
	toggle();
	wpcfTextareaBr();
})

function buttonbr() {
	$('.button br').each(function () {
		$(this.nextSibling).wrap('<span class="second-line"></span>');
	});
}

function toggle() {
	
	jQuery("button[data-toggle]").click(function() {
		
		element = jQuery(this).attr('data-toggle');
		titelid = jQuery(this).attr('data-titel-toggle');
		titel = jQuery(this).attr('data-titel');
		
		if ( titel ) {
			
			jQuery("#" + titelid).text(titel);
			
		}
		
		jQuery(this).siblings().removeClass("active");		
		jQuery(this).addClass("active");
		
		jQuery("#" + element).siblings().removeClass("active");
		jQuery("#" + element).addClass("active");
		
	})
	
}

function wpcfTextareaBr() {
	jQuery(".wpcf7 textarea.wpcf7-textarea").html(function(i, html) {
		return html.replace(/\&lt\;br \/\&gt\;/g,'');
	})
}
