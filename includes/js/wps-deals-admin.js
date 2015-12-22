jQuery(document).ready(function($) {
	
	jQuery( '.wps-deals-content-section select, .wps-deals-edit-sale select, .wps-deals-form select' ).each(function () {
	  	jQuery(this).chosen();
	});
	//code for plugin settings tabs
	
	//set selected tab for reports page default first tab will be selected
	$( '.wps-deals-reports-content .nav-tab-wrapper a:first' ).addClass( 'nav-tab-active' );
	$( '.wps-deals-reports-content .wps-deals-content div:first' ).show();
	
	//  When user clicks on tab, this code will be executed
	$( document ).on( 'click', '.nav-tab-wrapper a', function() {
  	
        //  First remove class "active" from currently active tab
        $(".nav-tab-wrapper a").removeClass('nav-tab-active');
 
        //  Now add class "active" to the selected/clicked tab
        $(this).addClass("nav-tab-active");
 
        //  Hide all tab content
        $(".wps-deals-tab-content").hide();
 
        //  Here we get the href value of the selected tab
        var selected_tab = $(this).attr("href");
 
        //  Show the selected tab content
        $(selected_tab).show();
        
        var selected = selected_tab.split('-');
        $(".wps-deals-tab-content").removeClass('wps-deals-selected-tab');
 		$( '#wps_deals_selected_tab' ).val( selected[3] );
 
        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });
    
    //call on click reset options button from settings page
    $( document ).on( 'click', '#wps_deals_reset_settings', function() {
	
		var ans;
		ans = confirm('Click OK to reset all options. All settings will be lost!');

		if(ans){
			return true;
		} else {
			return false;
		}
	});
	
	// added for quickedit
	jQuery('.inline-editor').livequery(function() {
			var id = jQuery(this).attr('id');
			id = id.replace(/^edit-/, '');
	
			if (!id || !parseInt(id)) {
				return;
			}
	
			var avail = jQuery('#inline_' + id + '_avail_total').text(),
				normal_price = jQuery('#inline_' + id + '_normal_price').text(),
				sale_price = jQuery('#inline_' + id + '_deal_price').text(),
				start_date = jQuery('#inline_' + id + '_start_date').text(),
				end_date = jQuery('#inline_' + id + '_end_date').text(),
				digital = jQuery('#inline_' + id + '_digital').text();
				featured_deal = jQuery('#inline_' + id + '_featured_deal').text();
				
			jQuery(this).find('.wps_deals_quick_avail_total').val(avail);
			jQuery(this).find('.wps_deals_quick_normal_price').val(normal_price);
			jQuery(this).find('.wps_deals_quick_sale_price').val(sale_price);
			jQuery(this).find('.wps_deals_quick_start_date').val(start_date);
			jQuery(this).find('.wps_deals_quick_end_date').val(end_date);
			
			jQuery(this).find('.wps_deals_quick_start_date').attr('id','wps_deals_quick_start_date-'+id);
			jQuery(this).find('.wps_deals_quick_end_date').attr('id','wps_deals_quick_end_date-'+id);
			
			
			if(featured_deal != '') {
				jQuery(this).find('.wps_deals_quick_featured_deal').attr('checked',true);
			} else {
				jQuery(this).find('.wps_deals_quick_featured_deal').attr('checked',false);
			}
			
			if(digital != '') {
				jQuery(this).find('.wps_deals_quick_digital').attr('checked',true);
			} else {
				jQuery(this).find('.wps_deals_quick_digital').attr('checked',false);
			}
			
	});
	
	//for delete confirm box
	$( document ).on( 'click', 'a.wps-deals-sales-delete', function() {
		
		var ans = confirm("Are you sure want to delete sales order?");
    	
    	if(ans) {
    		return true;
    	} else {
    		return false;
    	}
	});
	
	
	// Reporting
	jQuery( '#wps-deals-graphs-date-options' ).change( function() {
		var $this = jQuery(this);
		if( $this.val() == 'other' ) {
			jQuery( '#wps-deals-date-range-options' ).show();
		} else {
			jQuery( '#wps-deals-date-range-options' ).hide();
		}
	});
	
	//Code for optin form settings metabox
	jQuery('#wps_deals_auto_form').blur(function(event) {
		var self = $(this);
		var dep = $('.wps-deals-code-dep');
		var parent = self.parents('td');
		var code = $.trim(self.val());
				
		parent.find('.wps-deals-form-fields').remove();
		
		if(code == '') {
			dep.hide();
		} else {
			dep.show();
			parse_code = $(code);
			
			var frm = parse_code.find('form');
			
			if(frm.size() == 0) {
				frm = parse_code.filter('form');
			}
			if(frm.size() == 0) {
				$('#wps-deals-email-field').html('<option value=""></option>');
				$('#wps-deals-email-field').val('');
				
				dep.hide();
				alert('Sorry but Deals Engine could not find any form elements within the code you entered in to the optin form box. Please copy the complete HTML code only without any Java Script.');
				return false;
			}
			
			var hiddens = {};
			var other_inputs = [];
			var lowercased = '';
			var email_name = '';
			var name = '';
			
			var inputs = parse_code.find('input[type!="submit"]').each(function(index, input) {
				var input = $(input);
				var name_input = input.attr('name');
				var type_input = input.attr('type');
				var value_input = input.val();
				
				
					//hidden_inputs[name_input] = input_value;
				if(type_input != 'hidden') {
					
					other_inputs.push(name_input);
						
					lowercased = name_input.toLowerCase();
					
					if(-1 < lowercased.indexOf('email')) {
						email_name = name_input;
					} else if(-1 < lowercased.indexOf('name')) {
						name = name_input;
					}
				}
			});
			
			$.each(other_inputs,function(index, ot_input) {
				var ot_input = $('<input class="wps-deals-form-fields" type="hidden" name="wps_deals_options[auto_form_field][]" />').val(ot_input).appendTo(parent);
			});
			
				
			$('.wps-deals-form-field').each(function(index, select) {
				var select = $(select);
				var previous_value = select.val();
				var splash_field = select.attr('wps-deals-data-field');
				
				select.empty();
				$.each(other_inputs, function(other_inputs_index, ot_input) {
					select.append($('<option></option>').attr('value', ot_input).text(ot_input));
				});
				
				if(previous_value != '' && $.inArray(previous_value, other_inputs) <  -1  ) {
					select.val(previous_value);
				} else {
					
					if(splash_field == 'email' && email_name != '') {
						select.val(email_name);
					} else if(splash_field == 'name' && name != '') {
						select.val(name);
					}
				}
			});
		}
		
	});
	
	$('#wps-deals-form-disabled-name').bind('change click', function(event) {
		var $this = $(this);
		var name_field = $('#wps-deals-name-field');
		
		if($this.is(':checked')) {
			name_field.attr('disabled', 'disabled');
		} else {
			name_field.removeAttr('disabled');
		}
	}).change();
	
	//Media Uploader
	$( document ).on( 'click', '.wps-deals-image-upload', function() {
	
		var imgfield,showfield;
		imgfield = jQuery(this).prev('input').attr('id');
		showfield = jQuery(this).parents('td').find('.wps-deals-img-view');
    	 
		if(typeof wp == "undefined" || WpsDealsSettings.new_media_ui != '1' ){// check for media uploader
				
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	    	
			window.original_send_to_editor = window.send_to_editor;
			window.send_to_editor = function(html) {
				
				if(imgfield)  {
					
					var mediaurl = $('img',html).attr('src');
					$('#'+imgfield).val(mediaurl);
					showfield.html('<img src="'+mediaurl+'" />');
					tb_remove();
					imgfield = '';
					
				} else {
					
					window.original_send_to_editor(html);
					
				}
			};
	    	return false;
			
		      
		} else {
			
			var file_frame;
			//window.formfield = '';
			
			//new media uploader
			var button = jQuery(this);
	
			//window.formfield = jQuery(this).closest('.file-input-advanced');
		
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
				//title: button.data( 'uploader_title' ),
				/*button: {
					text: button.data( 'uploader_button_text' ),
				},*/
				multiple: false  // Set to true to allow multiple files to be selected
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
				var selected_size = $('.attachment-display-settings .size').val();
				
				var selection = file_frame.state().get('selection');
				selection.each( function( attachment, index ) {
					attachment = attachment.toJSON();
					
					// Selected attachment url from media uploader
					var attachment_url = attachment.sizes[selected_size].url;
					
					if(index == 0){
						// place first attachment in field
						$('#'+imgfield).val(attachment_url);
						showfield.html('<img src="'+attachment_url+'" />');
						
					} else{
						$('#'+imgfield).val(attachment_url);
						showfield.html('<img src="'+attachment_url+'" />');
					}
				});
			});
	
			// Finally, open the modal
			file_frame.open();
			
		}
		
	});
	
	//issue refund transaction confirm alert
	$( document ).on( 'click', '.wps-deals-issue-refund', function() {
		
		if( WpsDealsSettings.paypalapi != '' && WpsDealsSettings.paypalapi == '1' ) {
			alert(WpsDealsSettings.paypalapierror);
			return false;
		} else {
			
			var bool = confirm( WpsDealsSettings.issue_refund_msg );
			
			if( bool ) {
				return true;
			} else {
				return false;
			}
		}
	});
	
	//send test email from email settings
	$( document ).on( 'click', '.wps-deals-send-test-email', function() {
		
		$( '.wps-deals-loader' ).show();
		var email_template = $('.wps-deals-email-template').val();
		var data = {
						action	:	'deals_test_email',
						template:	email_template
					};
		$('.wps-deals-send-email-msg').html('').hide();		
		$.post(ajaxurl,data,function(response) {
			//alert(response);
			$( '.wps-deals-loader' ).hide();
			if( response == 'success' ) {
				$('.wps-deals-send-email-msg').removeClass('wps-deals-email-error').addClass('wps-deals-email-success');
				$('.wps-deals-send-email-msg').html( WpsDealsSettings.testemailsuccess ).show();
				setTimeout(function(){
					$(".wps-deals-send-email-msg").fadeOut("slow", function () {
					});
				}, 2000);
			} else {
				$('.wps-deals-send-email-msg').removeClass('wps-deals-email-success').addClass('wps-deals-email-error');
				$('.wps-deals-send-email-msg').html( WpsDealsSettings.testemailerror ).show();
				setTimeout(function(){
					$(".wps-deals-send-email-msg").fadeOut("slow", function () {
					});
				}, 2000);
			}
		});
	});
	
	//Show Hide Un-force SSL setting based on click of force SSL Setting
	$( document ).on( 'click', '.wps_deals_force_ssl_setting', function() {
	
		var unforcerow = $( this ).parents( 'tr' ).next( 'tr' );
		
		if( $( this ).is( ':checked' ) ) {
			//show un-force ssl setting
			unforcerow.show();
		} else {
			//hide un-force ssl setting
			unforcerow.hide();
		}
	});
	
	// Show Error if Deal price is greater then Normal price
	$( document ).on( 'blur', '#_wps_deals_sale_price[type=text] , .wps_deals_quick_sale_price[type=text] ', function() {				
		$('.wps-error-tip').fadeOut('100', function(){ $(this).remove(); } );		
	});	
	
	$("body").click(function(){
		$('.wps-error-tip').fadeOut('100', function(){ $(this).remove(); } );
	});	
	
	$( document ).on( 'keyup focus change', '#_wps_deals_sale_price[type=text]', function(){		
		var deal_price_field = $(this);
		var normal_price_field = $('#_wps_deals_normal_price');
		
		var normal_price = parseFloat(normal_price_field.val());
		var deal_price = parseFloat(deal_price_field.val());
		
		if(deal_price >= normal_price) {
			deal_price_field.val( normal_price_field.val() );						
			$(this).after( '<div class="wps-error-tip">' + WpsDealsSettings.deal_price_less_than_normal_price_error + '</div>' );								
		} else {
			$('.wps-error-tip').fadeOut('100', function(){ $(this).remove(); } );
		}			
	});
	
	// Quick box in Show Error if Deal price is greater then Normal price 
	$( document ).on( 'keyup focus change', '.wps_deals_quick_sale_price[type=text]', function(){		
		var deal_price_field = $(this);
		var normal_price_field = $('.wps_deals_quick_normal_price');
		
		var normal_price = parseFloat(normal_price_field.val());
		var deal_price = parseFloat(deal_price_field.val());
		
		if(deal_price >= normal_price) {
			deal_price_field.val( normal_price_field.val() );						
			$(this).after( '<div class="wps-error-tip">' + WpsDealsSettings.deal_price_less_than_normal_price_error + '</div>' );								
		} else {
			$('.wps-error-tip').fadeOut('100', function(){ $(this).remove(); } );
		}			
	});
	
	// numeric validation
	$( document ).on( 'keyup change', '#_wps_deals_sale_price[type=text], #_wps_deals_normal_price[type=text], .wps_deals_quick_normal_price[type=text], .wps_deals_quick_sale_price[type=text] ', function(){		
		var value    = $(this).val();
		var regex    = new RegExp( "[^\-0-9\%.\\" + WpsDealsSettings.decimal_seperator + "]+", "gi" );
		var newvalue = value.replace( regex, '' );
		
		if ( value !== newvalue ) {
			$(this).val( newvalue );
			$(this).after( '<div class="wps-error-tip">' + WpsDealsSettings.deal_price_numeric_error + '</div>' );									
		} else {
			$('.wps-error-tip').fadeOut('100', function(){ $(this).remove(); } );
		}	
	});
	
	// Date picker for start date and end date on deals sales page
	if ( $( '.wps_deals_datepicker' ).length > 0 ) {
		
		var dateFormat = 'mm/dd/yy'; // date format
  		$( '.wps_deals_datepicker' ).datepicker( {
	   		dateFormat: dateFormat
  		} );
	}
	// Date picker for start date and end date validation on deals sales page
	jQuery('.wps-deals-meta-datetime').each( function() {
		 
      var jQuerythis  = jQuery(this),
        //  format = jQuerythis.attr('rel'),
          id = jQuerythis.attr('id');

      //	if( format == "" || format == undefined )
       		format = "dd-mm-yy";
        		 
		if( id == "_wps_deals_start_date" ) { // for start date    					
        	  	
	      	jQuerythis.datetimepicker({
	      		ampm: true,
	      		dateFormat : format,
	      		onSelect: function (selectedDateTime){
					jQuery("#_wps_deals_end_date").datetimepicker('option', 'minDate', jQuerythis.datetimepicker('getDate') );
				}
			});
	      		
      	} else if( id == "_wps_deals_end_date" ) { // for end date
	      	      		
	    	jQuerythis.datetimepicker({
	      		ampm: true,
	      		dateFormat : format,
	      		onSelect: function (selectedDateTime){
					jQuery("#_wps_deals_start_date").datetimepicker('option', 'maxDate', jQuerythis.datetimepicker('getDate') );
				}
			});
	      	
      	} else {
			jQuerythis.datetimepicker({ampm: true,dateFormat : format});//,timeFormat:'hh:mm:ss',showSecond:true
		}
	});
	
	// Datetime picker for start date and end date on deals list page
	/*jQuery( document ).on( 'focus click', '.wps_deals_quick_edit_datetime', function() {
		
		var jQuerythis  = jQuery(this),
		format = jQuerythis.attr('rel');
		
		var deals_id = jQuerythis.attr('id');
		start_id = deals_id.replace(/^wps_deals_quick_start_date-/, '');
		end_id = deals_id.replace(/^wps_deals_quick_end_date-/, '');
        
		if( deals_id == 'wps_deals_quick_start_date-'+start_id ) { // for start date
	      	jQuerythis.datetimepicker({
	      		ampm: true,
	      		dateFormat : format,
	      		onSelect: function (selectedDateTime){
					jQuery('#wps_deals_quick_end_date-'+start_id).datetimepicker('option', 'minDate', jQuerythis.datetimepicker('getDate') );
				}
			});
      	} else if( deals_id == 'wps_deals_quick_end_date-'+end_id ) { // for end date
	    	jQuerythis.datetimepicker({
	      		ampm: true,
	      		dateFormat : format,
	      		onSelect: function (selectedDateTime){
					jQuery('#wps_deals_quick_start_date-'+end_id).datetimepicker('option', 'maxDate', jQuerythis.datetimepicker('getDate') );
				}
			});
      	} else {
			jQuerythis.datetimepicker({ampm: true,dateFormat : format});//,timeFormat:'hh:mm:ss',showSecond:true
		}
	});*/
	
	
});