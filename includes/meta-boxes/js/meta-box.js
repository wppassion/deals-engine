/**
 * All Types Meta Box Class JS
 *
 * JS used for the custom metaboxes and other form items.
 *
 * Copyright 2011 Ohad Raz (admin@bainternet.info)
 * @since 1.0
 */

//var jQuery =jQuery.noConflict();
function wps_deals_update_repeater_fields(){
    
      
    /**
     * Datepicker Field.
     *
     * @since 1.0
     */
    jQuery('.wps-deals-meta-date').each( function() {
      
      var jQuerythis  = jQuery(this),
          format = jQuerythis.attr('rel');
  
      jQuerythis.datepicker( { showButtonPanel: true, dateFormat: format } );
      
    });
    
    jQuery('.wps-deals-meta-datetime').each( function() {
      
      var jQuerythis  = jQuery(this),
          format = jQuerythis.attr('rel');
      jQuerythis.datetimepicker({ampm: true,dateFormat : format});//
      
    });
  
    /**
     * Timepicker Field.
     *
     * @since 1.0
     */
    jQuery('.wps-deals-meta-time').each( function() {
      
      var jQuerythis   = jQuery(this),
          format   = jQuerythis.attr('rel'),
          aampm    = jQuerythis.attr('data-ampm');
      if ('true' == aampm)
        aampm = true;
      else
        aampm = false;

      jQuerythis.timepicker( { showSecond: true, timeFormat: format, ampm: aampm } );
      
    });
  
    /**
     * Colorpicker Field.
     *
     * @since 1.0
     */
    /*
    
    
    
    /**
     * Select Color Field.
     *
     * @since 1.0
     */
    jQuery('.wps-deals-meta-color-select').click( function(){
      var jQuerythis = jQuery(this);
      var id = jQuerythis.attr('rel');
      jQuery(this).siblings('.wps-deals-meta-color-picker').farbtastic("#" + id).toggle();
      return false;
    });
  
    /**
     * Add Files.
     *
     * @since 1.0
     */
    jQuery('.wps-deals-meta-add-file').click( function() {
      var jQueryfirst = jQuery(this).parent().find('.file-input:first');
      jQueryfirst.clone().insertAfter(jQueryfirst).show();
      return false;
    });
    
     jQuery('.wps-deals-meta-add-fileadvanced').click( function() {
      var jQueryfirst = jQuery(this).parent().find('.file-input-advanced:first');
      jQueryfirst.clone().insertAfter(jQueryfirst).show();
      return false;
    });
  
    /**
     * Delete File.
     *
     * @since 1.0
     */
    jQuery( document ).on( 'click', '.wps-deals-meta-upload .wps-deals-meta-delete-file', function() {
      var jQuerythis   = jQuery(this),
          jQueryparent = jQuerythis.parent(),
          data     = jQuerythis.attr('rel');
          
      jQuery.post( ajaxurl, { action: 'at_delete_file', data: data }, function(response) {
        response == '0' ? ( alert( 'File has been successfully deleted.' ), jQueryparent.remove() ) : alert( 'You do NOT have permission to delete this file.' );
      });
      
      return false;
    
    });
  
    /**
     * Reorder Images.
     *
     * @since 1.0
     */
    jQuery('.wps-deals-meta-images').each( function() {
      
      var jQuerythis = jQuery(this), order, data;
      
      jQuerythis.sortable( {
        placeholder: 'ui-state-highlight',
        update: function (){
          order = jQuerythis.sortable('serialize');
          data   = order + '|' + jQuerythis.siblings('.wps-deals-meta-images-data').val();
  
          jQuery.post(ajaxurl, {action: 'at_reorder_images', data: data}, function(response){
            response == '0' ? alert( 'Order saved!' ) : alert( "You don't have permission to reorder images." );
          });
        }
      });
      
    });
    
    /**
     * Thickbox Upload
     *
     * @since 1.0
     */
    jQuery('.wps-deals-meta-upload-button').click( function() {
      
      var data       = jQuery(this).attr('rel').split('|'),
          post_id   = data[0],
          field_id   = data[1],
          backup     = window.send_to_editor; // backup the original 'send_to_editor' function which adds images to the editor
          
      // change the function to make it adds images to our section of uploaded images
      window.send_to_editor = function(html) {
        
        jQuery('#wps-deals-meta-images-' + field_id).append( jQuery(html) );
  
        tb_remove();
        
        window.send_to_editor = backup;
      
      };
  
      // note that we pass the field_id and post_id here
      tb_show('', 'media-upload.php?post_id=' + post_id + '&field_id=' + field_id + '&type=image&TB_iframe=true');
  
      return false;
    });
  
    /**
     * repeater sortable
     * @since 2.1
     */
    jQuery('.repeater-sortable').sortable();
	
	/**
     * enable select2
     */
    wpsDealsFancySelect();
  
  }
var Ed_array = Array;
jQuery(document).ready(function(jQuery) {

	wpsDealsShowAndHide();
	
	// Deal Type box
	jQuery('.wps-deals-metabox-type-box').appendTo( '#wps_deals_meta h3.hndle span' );
	
	// Prevent inputs in meta box headings opening/closing contents
	jQuery('#wps_deals_meta h3.hndle').unbind('click.postboxes');

	jQuery('#wps_deals_meta').on('click', 'h3.hndle', function(event){

		// If the user clicks on some form input inside the h3 the box should not be toggled
		if ( jQuery(event.target).filter('input, option, label, select').length )
			return;

		jQuery('#wps_deals_meta').toggleClass('closed');
	});
	
	// Deal Type Specific options
	jQuery('select#wps_deals_type').change(function(){

		jQuery('#metabox-tabs li').removeClass('active'); // Inactive All Tab
		jQuery('.wps-deals-metabox-tabs-div .tab-content').hide(); // Hide All Tab Content
		jQuery('#metabox-tabs .general').addClass('active').show(); // Active General Tab
		jQuery('#general_content').addClass('tab-content').show(); // Show General Tab Content
		
		wpsDealsShowAndHide();
		
	});
 
	//wpsDealsBehaviour();
	// Purchase Behaviour Specific options
	jQuery('select.wps-deals-behavior').change(function(){

		wpsDealsBehaviour();
		
	});
	
	 /**
     * DateTimepicker Field.
     *
     * @since 1.0
     */
 	 
    jQuery('.wps-deals-meta-datetime').each( function() {
      
      var jQuerythis  = jQuery(this),
          format = jQuerythis.attr('rel');
  		
      jQuerythis.datetimepicker({ampm: true,dateFormat : format});//,timeFormat:'hh:mm:ss',showSecond:true
      
    });
    
    
    
  /**
   *  conditinal fields
   *  @since 2.9.9
   */
  jQuery(".conditinal_control").click(function(){
    if(jQuery(this).is(':checked')){
      jQuery(this).next().show('fast');    
    }else{
      jQuery(this).next().hide('fast');    
    }
  });

  /**
   * enable select2
   * @since 2.9.8
   */
  wpsDealsFancySelect();

  /**
   * repeater sortable
   * @since 2.1
   */
  jQuery('.repeater-sortable').sortable(); 
  
  /**
   * repater Field
   * @since 1.1
   */
  //edit
  jQuery( document ).on( 'click', '.wps-deals-meta-re-toggle', function() {
    //jQuery(this).prev().toggle('slow');
    if( jQuery(this).prev().is(':visible') ) {
    	jQuery(this).prev().hide();
    } else {
    	jQuery(this).prev().show();
    }
  });
  
  
  /**
   * Datepicker Field.
   *
   * @since 1.0
   */
  jQuery('.wps-deals-meta-date').each( function() {
    
    var jQuerythis  = jQuery(this),
        format = jQuerythis.attr('rel');

    jQuerythis.datepicker( { showButtonPanel: true, dateFormat: format } );
    
  });

  /**
   * Timepicker Field.
   *
   * @since 1.0
   */
  jQuery('.wps-deals-meta-time').each( function() {
    
    var jQuerythis   = jQuery(this),
          format   = jQuerythis.attr('rel'),
          aampm    = jQuerythis.attr('data-ampm');
      if ('true' == aampm)
        aampm = true;
      else
        aampm = false;

      jQuerythis.timepicker( { showSecond: true, timeFormat: format, ampm: aampm } );
    
  });

  /**
   * Colorpicker Field.
   *
   * @since 1.0
   * better handler for color picker with repeater fields support
   * which now works both when button is clicked and when field gains focus.
   */
  if (jQuery.farbtastic){//since WordPress 3.5
  	jQuery( document ).on( 'focus', '.wps-deals-meta-color', function() {
      load_colorPicker(jQuery(this).next());
    });
	jQuery( document ).on( 'focusout', '.wps-deals-meta-color', function() {
      hide_colorPicker(jQuery(this).next());
    });

    /**
     * Select Color Field.
     *
     * @since 1.0
     */
    jQuery( document ).on( 'click', '.wps-deals-meta-color-select', function() {
      if (jQuery(this).next('div').css('display') == 'none')
        load_colorPicker(jQuery(this));
      else
        hide_colorPicker(jQuery(this));
    });

    function load_colorPicker(ele){
      colorPicker = jQuery(ele).next('div');
      input = jQuery(ele).prev('input');

      jQuery.farbtastic(jQuery(colorPicker), function(a) { jQuery(input).val(a).css('background', a); });

      colorPicker.show();
      //e.preventDefault();

      //jQuery(document).mousedown( function() { jQuery(colorPicker).hide(); });
    }

    function hide_colorPicker(ele){
      colorPicker = jQuery(ele).next('div');
      jQuery(colorPicker).hide();
    }
    //issue #15
    jQuery('.wps-deals-meta-color').each(function(){
      var colo = jQuery(this).val();
      if (colo.length == 7)
        jQuery(this).css('background',colo);
    });
  }else{
    //jQuery('.wps-deals-meta-color-iris').wpColorPicker();
  }
  
  
	/**
	 * Add Bundle Field
	 * 
	 */
	jQuery( document ).on( 'click', '.wps-deals-meta-add-bundle', function() {
		
		var jQueryfirst = jQuery(this).parent().find('.bundle-deal-advanced:last');
		jQueryfirst.clone().insertAfter(jQueryfirst).show();
		
		jQuery(this).parent().find('.bundle-deal-advanced:last select').removeAttr('id');
		jQuery(this).parent().find('.bundle-deal-advanced:last select').removeClass('chzn-done');
		
		jQuery(this).parent().find('.bundle-deal-advanced:last .chzn-container-single').remove();
		
		jQuery(this).parent().find('.bundle-deal-advanced:last select').val('');
		
		wpsDealsFancySelect();
		
		return false;
	});
	
	/**
	 * Delete Bundle Field
	 * 
	 */
	jQuery('.wps-deals-delete-bundel').live('click', function() {
		
		var row = jQuery(this).parent().parent().parent( 'tr' );
		var count =	row.find('.bundle-deal-advanced').length;
		if(count > 1) {
			jQuery(this).parent('.bundle-deal-advanced').remove();
		} else {
			alert( WpsDeals.one_deal_min );
		}
		return false;
	});

	
  /**
   * Add Files.
   *
   * @since 1.0
   */
  jQuery( document ).on( 'click', '.wps-deals-meta-add-file', function() {
    var jQueryfirst = jQuery(this).parent().find('.file-input:first');
    jQueryfirst.clone().insertAfter(jQueryfirst).show();
    return false;
  });
  /*
  *
  * Advanced Add Files
  */
  jQuery( document ).on( 'click', '.wps-deals-meta-add-fileadvanced', function() {
     var jQueryfirst = jQuery(this).parent().find('.file-input-advanced:last');
     jQueryfirst.clone().insertAfter(jQueryfirst).show();
     jQuery(this).parent().find('.file-input-advanced:last .wps-deals-upload-file-link').val('');
     jQuery(this).parent().find('.file-input-advanced:last .wps-deals-upload-file-name').val('');
     return false;
   });
   
  /*
   *
   * Advanced Add Files
   */
  jQuery( document ).on( 'click', '.wps-deals-delete-fileadvanced', function() {
  	var row = jQuery(this).parent().parent().parent( 'tr' );
  	var count =	row.find('.file-input-advanced').length;
	  	if(count > 1) {
	     jQuery(this).parent('.file-input-advanced').remove();
	  	} else {
	  		alert( WpsDeals.one_file_min );
	  	}
     return false;
   });
   
   // WP 3.5+ uploader
	jQuery( document ).on( 'click', '.wps-deals-upload-fileadvanced', function(e) {
	
		e.preventDefault();
		
		if(typeof wp == "undefined" || WpsDeals.new_media_ui != '1' ){// check for media uploader
				
			//Old Media uploader
				
			window.formfield = '';
			e.preventDefault();
			
			window.formfield = jQuery(this).closest('.file-input-advanced');
			
			tb_show('', 'media-upload.php?post_id='+ jQuery('#post_ID').val() + '&type=image&amp;TB_iframe=true');
		      //store old send to editor function
		      window.restore_send_to_editor = window.send_to_editor;
		      //overwrite send to editor function
		      window.send_to_editor = function(html) {
		        attachmenturl = jQuery('a', '<div>' + html + '</div>').attr('href');
		        attachmentname = jQuery('a', '<div>' + html + '</div>').html();
		        
		        window.formfield.find('.wps-deals-upload-file-link').val(attachmenturl);
	        	window.formfield.find('.wps-deals-upload-file-name').val(attachmentname);
		        wps_deals_load_images_muploader();
		        tb_remove();
		        //restore old send to editor function
		        window.send_to_editor = window.restore_send_to_editor;
		      }
	      return false;
		      
		} else {
			
			var file_frame;
			window.formfield = '';
			
			//new media uploader
			var button = jQuery(this);
	
			window.formfield = jQuery(this).closest('.file-input-advanced');
		
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				//file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
				file_frame.open();
			  return;
			}
	
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				frame: 'post',
				state: 'insert',
				title: button.data( 'uploader_title' ),
				button: {
					text: button.data( 'uploader_button_text' ),
				},
				multiple: true  // Set to true to allow multiple files to be selected
			});
	
			file_frame.on( 'menu:render:default', function(view) {
		        // Store our views in an object.
		        var views = {};
	
		        // Unset default menu items
		        view.unset('library-separator');
		        view.unset('gallery');
		        view.unset('featured-image');
		        view.unset('embed');
	
		        // Initialize the views in our view object.
		        view.set(views);
		    });
	
			// When an image is selected, run a callback.
			file_frame.on( 'insert', function() {
	
				// Get selected size from media uploader
				//var selected_size = jQuery('.attachment-display-settings .size').val();
				
				var selection = file_frame.state().get('selection');
				selection.each( function( attachment, index ) {
					attachment = attachment.toJSON();
					
					// Selected attachment url from media uploader
					//var attachment_url = attachment.sizes[selected_size].url;
					
					if(index == 0){
						// place first attachment in field
						window.formfield.find('.wps-deals-upload-file-link').val( attachment.url );
						window.formfield.find('.wps-deals-upload-file-name').val( attachment.name );
						
					} else{
						window.formfield.find('.wps-deals-upload-file-name').val( attachment.name );
						window.formfield.find('.wps-deals-upload-file-link').val( attachment.url );
						
					}
				});
			});
	
			// Finally, open the modal
			file_frame.open();
		}
		
	});

  /**
   * Delete File.
   *
   * @since 1.0
   */
  jQuery( document ).on( 'click', '.wps-deals-meta-upload .wps-deals-meta-delete-file', function() {
    var jQuerythis   = jQuery(this),
        jQueryparent = jQuerythis.parent(),
        data = jQuerythis.attr('rel');
    
    var ind = jQuery(this).index()
    jQuery.post( ajaxurl, { action: 'atm_delete_file', data: data, tag_id: jQuery('#post_ID').val() }, function(response) {
      response == '0' ? ( alert( 'File has been successfully deleted.' ), jQueryparent.remove() ) : alert( 'You do NOT have permission to delete this file.' );
    });
    
    return false;
  
  });

    
  /**
   * Thickbox Upload
   *
   * @since 1.0
   */
  jQuery('.wps-deals-meta-upload-button').click( function() {
    
    var data       = jQuery(this).attr('rel').split('|'),
        post_id   = data[0],
        field_id   = data[1],
        backup     = window.send_to_editor; // backup the original 'send_to_editor' function which adds images to the editor
        
    // change the function to make it adds images to our section of uploaded images
    window.send_to_editor = function(html) {
      
      jQuery('#wps-deals-meta-images-' + field_id).append( jQuery(html) );

      tb_remove();
      
      window.send_to_editor = backup;
    
    };

    // note that we pass the field_id and post_id here
    tb_show('', 'media-upload.php?post_id=' + post_id + '&field_id=' + field_id + '&type=image&TB_iframe=true');

    return false;
  });

    
  /**
   * Helper Function
   *
   * Get Query string value by name.
   *
   * @since 1.0
   */
  function get_query_var( name ) {

    var match = RegExp('[?&]' + name + '=([^&#]*)').exec(location.href);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
      
  }
  
  //new image upload field
  function wps_deals_load_images_muploader(){
    jQuery(".mupload_img_holder").each(function(i,v){
      if (jQuery(this).next().next().val() != ''){
        if (!jQuery(this).children().size() > 0){
          jQuery(this).append('<img src="' + jQuery(this).next().next().val() + '" style="height: 150px;width: 150px;" />');
          jQuery(this).next().next().next().val("Delete Image");
          jQuery(this).next().next().next().removeClass('wps-deals-meta-upload_image_button').addClass('wps-deals-meta-delete_image_button');
        }
      }
    });
  }
  
  wps_deals_load_images_muploader();
  //delete img button
  
  jQuery( document ).on( 'click', '.wps-deals-meta-delete_image_button', function() {
  	jQuery(this).prev().val('');
  	jQuery(this).prev().prev().val('');
  	jQuery(this).prev().prev().prev().html('');
  	jQuery(this).val("Upload Image");
    jQuery(this).removeClass('wps-deals-meta-delete_image_button').addClass('wps-deals-meta-upload_image_button');
  });
 
  //editor resize fix
  jQuery(window).resize(function() {
    jQuery.each(Ed_array, function() {
      var ee = this;
      jQuery(ee.getScrollerElement()).width(100); // set this low enough
      width = jQuery(ee.getScrollerElement()).parent().width();
      jQuery(ee.getScrollerElement()).width(width); // set it to
      ee.refresh();
    });
  });
  
  
  // WP 3.5+ uploader
	
	var formfield1;
    var formfield2;
    
    jQuery( document ).on( 'click', '.wps-deals-meta-upload_image_button', function(e) {
	
		e.preventDefault();
		formfield1 = jQuery(this).prev();
		formfield2 = jQuery(this).prev().prev();
		var button = jQuery(this);
			
		if(typeof wp == "undefined" || WpsDeals.new_media_ui != '1' ){// check for media uploader//
			 
			  tb_show('', 'media-upload.php?post_id='+ jQuery('#post_ID').val() + '&type=image&amp;TB_iframe=true');
		      //store old send to editor function
		      window.restore_send_to_editor = window.send_to_editor;
		      //overwrite send to editor function
		      window.send_to_editor = function(html) {
		      	
		        imgurl = jQuery('img',html).attr('src');
		        
		        if(jQuery('img',html).attr('class')) {
		        	
			        img_calsses = jQuery('img',html).attr('class').split(" ");
			        att_id = '';
			        jQuery.each(img_calsses,function(i,val){
			          if (val.indexOf("wp-image") != -1){
			            att_id = val.replace('wp-image-', "");
			          }
			        });
			
			        jQuery(formfield2).val(att_id);
		        }
		        
		        jQuery(formfield1).val(imgurl);
		        wps_deals_load_images_muploader();
		        tb_remove();
		        //restore old send to editor function
		        window.send_to_editor = window.restore_send_to_editor;
		      }
		      return false;
		      
		} else {
			
			
			var file_frame;
			
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				//file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
				file_frame.open();
			  return;
			}
	
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				frame: 'post',
				state: 'insert',
				title: button.data( 'uploader_title' ),
				button: {
					text: button.data( 'uploader_button_text' ),
				},
				multiple: true  // Set to true to allow multiple files to be selected
			});
	
			file_frame.on( 'menu:render:default', function(view) {
		        // Store our views in an object.
		        var views = {};
	
		        // Unset default menu items
		        view.unset('library-separator');
		        view.unset('gallery');
		        view.unset('featured-image');
		        view.unset('embed');
	
		        // Initialize the views in our view object.
		        view.set(views);
		    });
	
			// When an image is selected, run a callback.
			file_frame.on( 'insert', function() {
	
				var selection = file_frame.state().get('selection');
				selection.each( function( attachment, index ) {
					attachment = attachment.toJSON();
					if(index == 0){
						// place first attachment in field
						jQuery(formfield2).val(attachment.id);
	        			jQuery(formfield1).val(attachment.url);
	        			wps_deals_load_images_muploader();
					
					} else{
						
						jQuery(formfield2).val(attachment.id);
	        			jQuery(formfield1).val(attachment.url);
	        			wps_deals_load_images_muploader();
					}
				});
			});
	
			// Finally, open the modal
			file_frame.open();
		}
		
	});
  
  
  //added for tabs in metabox
  // tab between them
	jQuery('.metabox-tabs li a').each(function(i) {
		var thisTab = jQuery(this).parent().attr('class').replace(/active /, '');
		
		if ( 'active' != jQuery(this).attr('class') )
			jQuery('div.' + thisTab).hide();

		jQuery('div.' + thisTab).addClass('tab-content');
 
		jQuery(this).click(function(){
			// hide all child content
			jQuery(this).parent().parent().parent().children('div').hide();
 
			// remove all active tabs
			jQuery(this).parent().parent('ul').find('li.active').removeClass('active');
 
			// show selected content
			jQuery(this).parent().parent().parent().find('div.'+thisTab).show();
			jQuery(this).parent().parent().parent().find('li.'+thisTab).addClass('active');
		});
	});

	jQuery('.metabox-tabs').show();
	
	jQuery('select.chzn-select').chosen();
	
});

/**
 * Select 2 enable function
 * @since 2.9.8
 */
function wpsDealsFancySelect(){
  /*jQuery(".wps-deals-metabox-tabs-div select").each(function (){
    if(! jQuery(this).hasClass('no-fancy'))
      jQuery(this).select2();
  });*/
  jQuery(".wps-deals-metabox-tabs-div select").each(function (){
      jQuery(this).chosen();
  });
}

/**
 * Show & Hide Based on deal type
 * @since 2.9.8
 */
function wpsDealsShowAndHide() {
	
	// Get deal type
	var deal_type = jQuery('select#wps_deals_type').val();
	
	jQuery('body').trigger('wps_deals_type_change', deal_type, jQuery('select#wps_deals_type') );
	
	if( deal_type == 'bundle' ) { // check deal type is bundle
		
		jQuery('.wps-deals-metabox-tabs-div .purchase').show(); // Show Purchase Tab
		jQuery('.wps-deals-metabox-tabs-div .upload').hide(); // Hide Upload Tab
		jQuery('.wps-deals-metabox-tabs-div .bundle').show(); // Hide Bundle Tab
		
		jQuery('.wps-deals-metabox-tabs-div .purchase.tab-content').hide(); // Hide Purchase Tab Content
		jQuery('.wps-deals-metabox-tabs-div .bundle.tab-content').hide(); // Hide Bundle Tab Content
		
	} else if( deal_type == 'affiliate' ) { // check deal type is affiliate
		
		jQuery('.wps-deals-metabox-tabs-div .upload').hide(); // Hide Upload Tab
		jQuery('.wps-deals-metabox-tabs-div .purchase').hide(); // Hide Purchase Tab
		jQuery('.wps-deals-metabox-tabs-div .bundle').hide(); // Hide Bundle Tab
		
		jQuery('#wps_deals_purchase_link_wrapper').show(); // Show Purchase Link Row
		jQuery('#wps_deals_add_to_cart_wrapper').show(); // Show Add To Cart Text Row
		jQuery('#wps_deals_avail_total_wrapper').hide(); // Hide Total Availables Deals Row
		jQuery('#wps_deals_inc_price_wrapper').hide(); // Hide Increase Price Rows
		jQuery('#wps_deals_available_bought_wrapper').hide(); // Hide Available & Bought Box Row
		jQuery('#wps_deals_behavior_wrapper').hide(); // Hide Purchase Behaviour Button Row
		jQuery('#wps_deals_buy_now_wrapper').hide(); // Hide Buy Now Text Row
		
	} else {
		
		jQuery('#metabox-tabs .upload').show(); // Show Upload Tab
		jQuery('#metabox-tabs .purchase').show(); // Show Upload Tab
		jQuery('#metabox-tabs .bundle').hide(); // Hide Bundle Tab
		
		jQuery('#wps_deals_purchase_link_wrapper').hide(); // Hide Purchase Link Row
		jQuery('#wps_deals_avail_total_wrapper').show(); // Show Total Availables Deals Row
		jQuery('#wps_deals_inc_price_wrapper').show(); // Show Increase Price Rows
		jQuery('#wps_deals_available_bought_wrapper').show(); // Show Available & Bought Box Row
		jQuery('#wps_deals_behavior_wrapper').show(); // Hide Purchase Behaviour Button Row
		jQuery('#wps_deals_buy_now_wrapper').show(); // Hide Buy Now Text Row
		
		wpsDealsBehaviour();
	}
	
}

/**
 * Purchase Behaviour
 * @since 2.9.8
 */
function wpsDealsBehaviour() {
	
	// Get Purchase Behaviour
	var purchase_behaviuor = jQuery('select.wps-deals-behavior').val();
	
	if( purchase_behaviuor == 'direct' ) {
		
		jQuery('#wps_deals_buy_now_wrapper').show();
		jQuery('#wps_deals_add_to_cart_wrapper').hide();
		
	} else {
		
		jQuery('#wps_deals_add_to_cart_wrapper').show();
		jQuery('#wps_deals_buy_now_wrapper').hide();
		
	}
	
}

/**
 * Get Deal Type
 * @since 2.9.8
 */
function wpsDealsGetDealType() {
	
	var wps_deals_deal_type = jQuery('#wps_deals_type').val();
	
	return wps_deals_deal_type;
}

jQuery(document).ready( function($) {
	
// deals gallery file uploads
	var deals_gallery_frame;
	var $image_gallery_ids = $( '#wps_deals_image_gallery' );
	var $deals_images    = $( '#wps_deals_images_container ul.wps_deals_images' );

	$( '.add_wps_deals_images' ).on( 'click', 'a', function( event ) {
		var $el = $( this );

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( deals_gallery_frame ) {
			deals_gallery_frame.open();
			return;
		}

		// Create the media frame.
		deals_gallery_frame = wp.media.frames.deals_gallery = wp.media({
			// Set the title of the modal.
			title: $el.data( 'choose' ),
			button: {
				text: $el.data( 'update' )
			},
			states: [
				new wp.media.controller.Library({
					title: $el.data( 'choose' ),
					filterable: 'all',
					multiple: true
				})
			]
		});

		// When an image is selected, run a callback.
		deals_gallery_frame.on( 'select', function() {
			var selection = deals_gallery_frame.state().get( 'selection' );
			var attachment_ids = $image_gallery_ids.val();

			selection.map( function( attachment ) {
				attachment = attachment.toJSON();

				if ( attachment.id ) {
					attachment_ids   = attachment_ids ? attachment_ids + ',' + attachment.id : attachment.id;
					var attachment_image = attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;

					$deals_images.append( '<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment_image + '" /><ul class="actions"><li><a href="#" class="delete" title="' + $el.data('delete') + '">' + $el.data('text') + '</a></li></ul></li>' );
				}
			});

			$image_gallery_ids.val( attachment_ids );
		});

		// Finally, open the modal.
		deals_gallery_frame.open();
	});

	// Image ordering
	$deals_images.sortable({
		items: 'li.image',
		cursor: 'move',
		scrollSensitivity: 40,
		forcePlaceholderSize: true,
		forceHelperSize: false,
		helper: 'clone',
		opacity: 0.65,
		placeholder: 'wps-metabox-sortable-placeholder',
		start: function( event, ui ) {
			ui.item.css( 'background-color', '#f6f6f6' );
		},
		stop: function( event, ui ) {
			ui.item.removeAttr( 'style' );
		},
		update: function() {
			var attachment_ids = '';

			$( '#wps_deals_images_container ul li.image' ).css( 'cursor', 'default' ).each( function() {
				var attachment_id = $( this ).attr( 'data-attachment_id' );
				attachment_ids = attachment_ids + attachment_id + ',';
			});

			$image_gallery_ids.val( attachment_ids );
		}
	});

	// Remove images
	$( '#wps_deals_images_container' ).on( 'click', 'a.delete', function() {
		$( this ).closest( 'li.image' ).remove();

		var attachment_ids = '';

		$( '#wps_deals_images_container ul li.image' ).css( 'cursor', 'default' ).each( function() {
			var attachment_id = $( this ).attr( 'data-attachment_id' );
			attachment_ids = attachment_ids + attachment_id + ',';
		});

		$image_gallery_ids.val( attachment_ids );

		// remove any lingering tooltips
		$( '#tiptip_holder' ).removeAttr( 'style' );
		$( '#tiptip_arrow' ).removeAttr( 'style' );

		return false;
	});
		
	//repeater field add more
	$( document ).on( "click", ".wps-deals-repeater-add", function() {
		
		var mainObj = jQuery(this).parents('div.wps-deals-meta-repeat');
		var jQueryblog = mainObj.find('div.wps-deals-meta-repater-block:last');
		
		jQueryblog.clone().insertAfter('div.wps-deals-meta-repater-block:last').show();
		
		mainObj.find('div.wps-deals-meta-repater-block:last textarea').val('');
		mainObj.find('div.wps-deals-meta-repater-block:last input').val('');
		mainObj.find('div.wps-deals-meta-repater-block:last .wps-deals-repeater-remove').show();
		
	});
	
	//remove repeater field
	$( document ).on( "click", ".wps-deals-repeater-remove", function() {
	   $(this).parent('.wps-deals-meta-repater-block').remove();
	});
	
});
