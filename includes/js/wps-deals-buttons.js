// JavaScript Document
jQuery(document).ready(function($) {
//Start Shortcode Popup
(function() {
    tinymce.create('tinymce.plugins.wpsdealsengine', {
        init : function(ed, url) {
        	
            ed.addButton('wpsdealsengine', {
                title : 'Social Deals Engine',  
                image : url+'/images/wps-icon.png',
                onclick : function() {
                    
					$( '.wps-deals-popup-overlay' ).fadeIn();
                    $( '.wps-deals-popup-content' ).fadeIn();
                     
                    //$( '#wps_deals_shortcodes' ).val('');
                    $( '#wps_deals_insert_container' ).hide();
                    
                    $( '#wps_deals_by_status_options' ).hide();
                    $( '#wps_deals_by_category_options' ).hide(); 
                    $( '#wps_deals_social_login_options' ).hide();
                    $( '#wps_deals_single_deal_options' ).hide();
                    $( '#wps_deals_multiple_deal_options' ).hide();
                    
                    var select_shortcode = $( '#wps_deals_shortcodes' ).val();
		
					if( select_shortcode != '') {
						$( '#wps_deals_insert_container' ).show();
						$( '.wps-deals-shortcodes-options').hide();
						
						switch ( select_shortcode ) {
							
							case 'wps_home_deals' :
									$( '#wps_deals_home_deals_options' ).show();
									break;
							case 'wps_deals_by_status' :
							
									$( '#wps_deals_status_options' ).show();
									break;
							case 'wps_deals_by_category'	:
									
									$( '#wps_deals_by_category_options' ).show();
									break;
							case 'wps_deals_social_login'	:
									 
									$( '#wps_deals_social_login_options' ).show();
									break;
							case 'wps_deals_by_id'	:
									 
									$( '#wps_deals_single_deal_options' ).show();
									break;
							case 'wps_deals_by_ids'	:
									 
									$( '#wps_deals_multiple_deal_options' ).show();
									break;
						}
					
						//trigger for doing on change for shortcode options select box admin side
						$('body').trigger('wps-deals-admin-shortcodes-options-change', select_shortcode, $(this) );
							
					}
					
 				}
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
 
    tinymce.PluginManager.add('wpsdealsengine', tinymce.plugins.wpsdealsengine);
})();
	
	//close popup window
	$( document ).on( 'click', 'a.wps-deals-close-button, div.wps-deals-popup-overlay', function() {
		
		$( '.wps-deals-popup-overlay' ).fadeOut();
        $( '.wps-deals-popup-content' ).fadeOut();
        
	});
	
	//show insert shortcode buttons
	$( '#wps_deals_shortcodes' ).on( 'change',function() {
		
		var select_shortcode = $( this ).val();
		
		if( select_shortcode != '') {
			$( '#wps_deals_insert_container' ).show();
			$( '.wps-deals-shortcodes-options').hide();
			
			switch ( select_shortcode ) {
				
				case 'wps_home_deals':
						$( '#wps_deals_home_deals_options' ).show();
						break;
				case 'wps_deals_by_status' :
							
						$( '#wps_deals_status_options' ).show();
						break;
				case 'wps_deals_by_category'	:
						
						$( '#wps_deals_by_category_options' ).show();
						break;
				case 'wps_deals_social_login'	:
						 
						$( '#wps_deals_social_login_options' ).show();
						break;
				case 'wps_deals_by_id'	:
						 
						$( '#wps_deals_single_deal_options' ).show();
						break;
				case 'wps_deals_by_ids'	:
						 
						$( '#wps_deals_multiple_deal_options' ).show();
						break;
			}
		
			//trigger for doing on change for shortcode options select box admin side
			$('body').trigger('wps-deals-admin-shortcodes-options-change', select_shortcode, $(this) );
				
		} else {
			
			$( '#wps_deals_insert_container' ).hide();
			$( '.wps-deals-shortcodes-options').hide();
		}
	});
	
	//on click of shortcode insert button in admin shortcode popup
	$( document ).on( 'click', '#wps_deals_insert_shortcode', function() {
		
		var dealsshortcode = $('#wps_deals_shortcodes').val();
		var dealsshortcodestr = '';
			
			if( dealsshortcode  != '' ) {
				
				wpsDealsSwitchDefaultEditorVisual();
				
				switch(dealsshortcode) {
					
					case 'wps_home_deals':
								var options='';
								var no_of_deals = $('#wps_home_number_of_deals').val();
								options += 'num_deals="'+ no_of_deals +'"'; 
								dealsshortcodestr += '['+dealsshortcode+' '+options+'][/'+dealsshortcode+']';
								break;
					case 'wps_deals_by_status'	:
								var options = '';
								if( $( '#wps_deals_enable_active' ).is(":checked") ) {
									options += 'active="true"';
								}
								if( $( '#wps_deals_enable_ending_soon' ).is(":checked") ) {
									options += ' ending_sooon="true"';
								}
								if( $( '#wps_deals_enable_upcoming' ).is(":checked") ) {
									options += ' upcoming="true"';
								}
								
								dealsshortcodestr += '['+dealsshortcode+' '+options+'][/'+dealsshortcode+']';
								break;
					case 'wps_deals_by_category'	:
								var catid = $( '#wps_deals_category_id' ).val();
								dealsshortcodestr	+= '['+dealsshortcode+' category="'+catid+'"][/'+dealsshortcode+']';
								break;
					case 'wps_deals_social_login'	:
								var title = $( '#wps_deals_title' ).val();
								var redirect_url = $( '#wps_deals_redirect_url' ).val();
								dealsshortcodestr	+= '['+dealsshortcode+' title="'+title+'"'+' redirect_url="'+redirect_url+'"][/'+dealsshortcode+']';
								break;
					case 'wps_deals_by_id'	:
								var id = $( '#wps_deals_single_deal_id' ).val();
								dealsshortcodestr	+= '['+dealsshortcode+' id="'+id+'"][/'+dealsshortcode+']';
								break;
					case 'wps_deals_by_ids'	:
								var deal_ids = $( '#wps_deals_multiple_deal_ids' ).val();
								if( deal_ids == null ) {
									deal_ids = ''; 
								}
								var options = '';
								if( $( '#wps_deals_disable_price' ).is(":checked") ) {
									options += ' disable_price="true"';
								}
								if( $( '#wps_deals_disable_timer' ).is(":checked") ) {
									options += ' disable_timer="true"';
								}
								dealsshortcodestr	+= '['+dealsshortcode+' ids="'+deal_ids+'"'+options+'][/'+dealsshortcode+']';
								break;
					case 'wps_deals' 				:
					case 'wps_home_deals'			:
					case 'wps_deals_checkout' 		:					
					
								dealsshortcodestr	+= '['+dealsshortcode+'][/'+dealsshortcode+']';
								break;
					default:
								dealsshortcodestr	+= '['+dealsshortcode+'][/'+dealsshortcode+']';
								break;
				}
				
				jQuery( '#wps_deals_shortcodes_hidden' ).val( dealsshortcodestr );
				
				//trigger for fire when admin click on insert shortcode button in shortcode popup
				$('body').trigger('wps-deals-admin-shortcodes-insert', dealsshortcode, $('#wps_deals_shortcodes') );
			 	
				dealsshortcodestr	= jQuery( '#wps_deals_shortcodes_hidden' ).val();
				
			 	 //send_to_editor(str);
		        //tinymce.get('content').execCommand('mceInsertContent',false, dealsshortcodestr);
		        window.send_to_editor( dealsshortcodestr );
		  		jQuery('.wps-deals-popup-overlay').fadeOut();
				jQuery('.wps-deals-popup-content').fadeOut();
			}
		
	});
	
});
//switch wordpress editor to visual mode
function wpsDealsSwitchDefaultEditorVisual() {
	if (jQuery('#content').hasClass('html-active')) {
		switchEditors.go(editor, 'tinymce');
	}
}