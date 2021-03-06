/* Used to show and hide the admin tabs for UPCP */
function ShowTab(TabName) {
		jQuery(".OptionTab").each(function() {
				jQuery(this).addClass("HiddenTab");
				jQuery(this).removeClass("ActiveTab");
		});
		jQuery("#"+TabName).removeClass("HiddenTab");
		jQuery("#"+TabName).addClass("ActiveTab");
		
		jQuery(".nav-tab").each(function() {
				jQuery(this).removeClass("nav-tab-active");
		});
		jQuery("#"+TabName+"_Menu").addClass("nav-tab-active");
}

/* This code is required to make changing the FAQ order a drag-and-drop affair */
jQuery(document).ready(function() {
	jQuery('.ewd-ufaq-list').sortable({
		items: '.ewd-ufaq-item',
		opacity: 0.6,
		cursor: 'move',
		axis: 'y',
		update: function() {
			var order = jQuery(this).sortable('serialize') + '&action=UFAQ_update_order';
			jQuery.post(ajaxurl, order, function(response) {});
		}
	});
});

function ShowOptionTab(TabName) {
	jQuery(".ufaq-option-set").each(function() {
		jQuery(this).addClass("ufaq-hidden");
	});
	jQuery("#"+TabName).removeClass("ufaq-hidden");
	
	// var activeContentHeight = jQuery("#"+TabName).innerHeight();
	// jQuery(".ufaq-options-page-tabbed-content").animate({
	// 	'height':activeContentHeight
	// 	}, 500);
	// jQuery(".ufaq-options-page-tabbed-content").height(activeContentHeight);

	jQuery(".options-subnav-tab").each(function() {
		jQuery(this).removeClass("options-subnav-tab-active");
	});
	jQuery("#"+TabName+"_Menu").addClass("options-subnav-tab-active");
}

jQuery(document).ready(function() {
	jQuery('.ewd-ufaq-spectrum').spectrum({
		showInput: true,
		showInitial: true,
		preferredFormat: "hex",
		allowEmpty: true
	});

	jQuery('.ewd-ufaq-spectrum').css('display', 'inline');

	jQuery('.ewd-ufaq-spectrum').on('change', function() {
		if (jQuery(this).val() != "") {
			jQuery(this).css('background', jQuery(this).val());
			var rgb = EWD_UFAQ_hexToRgb(jQuery(this).val());
			var Brightness = (rgb.r * 299 + rgb.g * 587 + rgb.b * 114) / 1000;
			if (Brightness < 100) {jQuery(this).css('color', '#ffffff');}
			else {jQuery(this).css('color', '#000000');}
		}
		else {
			jQuery(this).css('background', 'none');
		}
	});

	jQuery('.ewd-ufaq-spectrum').each(function() {
		if (jQuery(this).val() != "") {
			jQuery(this).css('background', jQuery(this).val());
			var rgb = EWD_UFAQ_hexToRgb(jQuery(this).val());
			var Brightness = (rgb.r * 299 + rgb.g * 587 + rgb.b * 114) / 1000;
			if (Brightness < 100) {jQuery(this).css('color', '#ffffff');}
			else {jQuery(this).css('color', '#000000');}
		}
	});
});

function EWD_UFAQ_hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}