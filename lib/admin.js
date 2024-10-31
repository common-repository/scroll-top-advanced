jQuery(document).ready(function($) {
	$('.color').wpColorPicker();
  // Show Hide Styles
  jQuery('.font_icons').hide();
   var fontIcons = jQuery('.show_on').val();
    if (fontIcons == 'scrol_icon') {
      jQuery('.font_icons').show();
      jQuery('.scroll-text-size, .scroll-font-size, .scroll-height, .btn-styles, .scroll-width, .scroll-icon-color, .scroll-bc-color, .scroll-bc-hover').show();
    }
    jQuery('.show_on').change(function() {
      var thisVal = jQuery(this).val();
      if (thisVal == 'scrol_icon') {
        jQuery('.font_icons').show();
        jQuery('.scroll-text-size, .scroll-font-size, .scroll-height, .btn-styles, .scroll-width, .scroll-icon-color, .scroll-bc-color, .scroll-bc-hover').show();
      } else {
        jQuery('.font_icons').hide();
      }
    });

  jQuery('.scroll_text').hide();
    var ScrollText = jQuery('.show_on').val();
    if (ScrollText == 'scrol_text') {
      jQuery('.scroll_text').show();
    }
    jQuery('.show_on').change(function() {
      var thisVal2 = jQuery(this).val();
      if (thisVal2 == 'scrol_text') {
        jQuery('.scroll_text').show();

      } else {
        jQuery('.scroll_text').hide();
      }
    });

    jQuery('.custom_img').hide();
    var CustomImage = jQuery('.show_on').val();
    if (CustomImage == 'scrol_img') {
      jQuery('.custom_img').show();
      jQuery('.scroll-text-size, .scroll-font-size, .scroll-height, .btn-styles, .scroll-width, .scroll-icon-color, .scroll-bc-color, .scroll-bc-hover').hide();
    }
    jQuery('.show_on').change(function() {
      var thisVal3 = jQuery(this).val();
      if (thisVal3 == 'scrol_img') {
        jQuery('.custom_img').show();
        jQuery('.scroll-text-size, .scroll-font-size, .scroll-height, .btn-styles, .scroll-width, .scroll-icon-color, .scroll-bc-color, .scroll-bc-hover').hide();
      } else {
        jQuery('.custom_img').hide();
      }
    });

    jQuery('.scrol_default').hide();
    var Scrol_Default = jQuery('.show_on').val();
    if (Scrol_Default == 'scrol_default') {
      jQuery('.scrol_default').show();
      jQuery('.scroll-text-size, .scroll-font-size, .scroll-height, .btn-styles, .scroll-width, .scroll-icon-color, .scroll-bc-color, .scroll-bc-hover').hide();
    }
    jQuery('.show_on').change(function() {
      var thisVal4 = jQuery(this).val();
      if (thisVal4 == 'scrol_default') {
        jQuery('.scrol_default').show();
        jQuery('.scroll-text-size, .scroll-font-size, .scroll-height, .btn-styles, .scroll-width, .scroll-icon-color, .scroll-bc-color, .scroll-bc-hover').hide();
      } else {
        jQuery('.scrol_default').hide();
      }
    });

    // Show Hide Styles
	$('#savedata').submit(function(event) {
		$('.nm-saved').hide();
		$('.nm-loading').show();
		event.preventDefault();
		var data = $(this).serialize();
		data = data + '&action=na_save_data';
		$.post(ajaxurl, data, function(resp) {
			$('.nm-loading').hide();
			$('.nm-saved').show();
		});
	});

	var image_caption_hover_plugin;
     
    jQuery('.scrol_image_button').live('click', function( event ){
     
        event.preventDefault();

        var this_widget = jQuery(this).closest('table');
     
     
        // Create the media frame.
        image_caption_hover_plugin = wp.media.frames.image_caption_hover_plugin = wp.media({
          title: jQuery( this ).data( 'title' ),
          button: {
            text: jQuery( this ).data( 'btntext' ),
          },
          multiple: false  // Set to true to allow multiple files to be selected
        });
     
        // When an image is selected, run a callback.
        image_caption_hover_plugin.on( 'select', function() {
          // We set multiple to false so only get one image from the uploader
          attachment = image_caption_hover_plugin.state().get('selection').first().toJSON();
          	jQuery(this_widget).find('.imageurl').val(attachment.url);
        });
     
        // Finally, open the modal
        image_caption_hover_plugin.open();
    });
});