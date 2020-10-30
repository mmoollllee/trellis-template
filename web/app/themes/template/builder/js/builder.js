var didLoadSortable = false;

function adjust(elements, offset, min, max) {
    // Initialize parameters
    offset = offset || 0;
    min    = min    || 0;
    max    = max    || Infinity;
    elements.each(function() {
        var element = jQuery(this);

        // Add element to measure pixel length of text
        var id = btoa(Math.floor(Math.random() * Math.pow(2, 64)));
        var tag = jQuery('<span id="' + id + '">' + element.val() + '</span>').css({
            'display': 'none',
            'font-family': element.css('font-family'),
            'font-size': element.css('font-size'),
        }).appendTo('body');

        // Adjust element width on keydown
        function update() {

            // Give browser time to add current letter
            setTimeout(function() {

                // Prevent whitespace from being collapsed
                tag.html(element.val().replace(/ /g, '&nbsp'));

                // Clamp length and prevent text from scrolling
                var size = Math.max(min, Math.min(max, tag.width() + offset));
                if (size < max)
                    element.scrollLeft(0);

                // Apply width to element
                element.width(size);
            }, 0);
        };
        update();
        element.keydown(update);
    });
}

// Apply to our element
//adjust(jQuery('.adjust'), 10, 100, 500);

jQuery(window).ready(function() {

    jQuery("#acf-pagebuilder .values")
        .find(".layout")
        .each(function() {
            mg_acf_title_insert(jQuery(this));

            mg_acf_hierarchie(jQuery(this));

            mg_acf_hide_fields(jQuery(this));

            mg_acf_options(jQuery(this));

			jQuery(this).addClass("-collapsed");

        });

    setTimeout(function() {

        jQuery(".mg_acf_span_title").on("click", function(e) {
            jQuery(this).parent().find(".mg_acf_input_title").focusTextToEnd();;

        });
        jQuery("#acf-pagebuilder .values").arrive(".layout", function() {

            mg_acf_title_insert(jQuery(this));

            mg_acf_hierarchie(jQuery(this));

            mg_acf_options(jQuery(this));

            mg_acf_hide_fields(jQuery(this));

        });

        jQuery(".block-editor-block-list__layout").arrive(".acf-builder-title .values .layout", function() {
            mg_acf_title_insert(jQuery(this));

            mg_acf_hide_fields(jQuery(this));
        });


        jQuery(".ui-sortable").on("sortstart", function(event, ui) {
            console.log("sortabel")

            if (!didLoadSortable) {
                jQuery("#acf-pagebuilder").find(".ui-sortable").sortable("option", "grid", [20, 10]);
                didLoadSortable = true;

                jQuery("#acf-pagebuilder").find(".ui-sortable").on("sortactivate", function(event, ui) {
                    ui.item.on("mousemove", function(event, x) {

                        if (event.which == 1) {

                            var hiera = (parseInt(jQuery(this).css('left').replace(/px/g, '')) + parseInt(Math.round(jQuery(this).css('margin-left').replace(/px/g, '')))) / 20; //

                            if (hiera >= 0 && hiera <= parseInt(jQuery(this).prev().find(".hierarchie input").val()) + 1) {

                                ui.item.find(".hierarchie input").val(hiera);
                            }

                        }

                    });

                    ui.item.on('mouseup', function(event) {

                        jQuery(this).attr({"data-hierarchie":parseInt(ui.item.find(".hierarchie input").val())});

                    });
                });
            }
        });

    }, 100);
});





function mg_acf_title_insert(e) {

    e = jQuery(e);
    titleinput = e.find(".title input");
    if (!titleinput.length) {
        return false;
    }

    title = titleinput.val();

    titlearea = e.find(".acf-fc-layout-handle");

    if (e.find(".mg_acf_input_title").length) {
        e.find(".mg_acf_input_title").val(title);
    } else {
        jQuery("<div class='mg_acf_top_title_field'><input type='text' class='mg_acf_input_title adjust' value='" + title + "'></div>").insertBefore(titlearea);

        //jQuery("<span class='mg_acf_title'>" + title + "</span>").insertAfter(".afc-layout-order");
        // titlearea.find(".acf-fc-layout-order").;

    }

    e.find(".mg_acf_input_title").on('input', function(event) {

        jQuery(this).parents(".layout").find('.title input').val(jQuery(this).val());

    });

		adjust(jQuery('.adjust'), 10, 100, 500);

}

function mg_acf_options(e) {

    e = jQuery(e);

	elements = e.find('[data-name="aktiv"], [data-name="redaktionell"]');

	elements.each(function() {
		value = jQuery(this).find(".acf-input [id^='acf-field']");
		i = "data-" + jQuery(this).attr("data-name");

		//e.attr(i, value.prop( "checked" ) );

		value.change( function() {
			i = "data-" + jQuery(this).parents("[data-name]").attr("data-name");

			jQuery(this).parents(".layout").attr(i, jQuery(this).prop( "checked" ) );

		}).change();
	})
}

function mg_acf_hierarchie(e) {

    e = jQuery(e);

    hierinput = e.find(".hierarchie input")

    hier = parseInt(hierinput.val());

    e.attr({"data-hierarchie":hier});

    hierinput.on('input', function() {

        mg_acf_hierarchie_change(jQuery(this));

    })

}

function mg_acf_title_change(e) {

    e = jQuery(e);

    title = e.val();

    e.parents(".layout").find(".mg_acf_input_title").val(title);

}

function mg_acf_hierarchie_change(e) {

    e = jQuery(e);

    hier = e.val();

    e.parents(".layout").attr({"data-hierarchie":hier});

}

function mg_acf_hide_fields(e) {

    e = jQuery(e);

    var hierarchie = e.find(".hierarchie");
    hierarchie.css("display", "none");


    var title = e.find(".title");
    title.css("display", "none");
}

(function($) {
    $.fn.focusTextToEnd = function() {
        this.focus();
        var $thisVal = this.val();
        this.val('').val($thisVal);
        return this;
    }
}(jQuery));
