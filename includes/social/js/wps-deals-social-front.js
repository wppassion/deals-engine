jQuery(document).ready( function($) {
	
	// login with facebook
	$( document ).on( 'click', 'a.deals-social-login-facebook', function() {
	
		var object = $(this);
		var errorel = $(this).parents('.deals-social-container').find('.deals-social-error');
		
		errorel.hide();
		errorel.html('');
		
		if( WpsDealsSocial.fberror == '1' ) {
			errorel.show();
			errorel.html( WpsDealsSocial.fberrormsg );
			return false;
		} else {
			
			FB.login(function(response) {
				//alert(response.status);
			  if (response.status === 'connected') {
			  	//creat user to site
			  	wps_deals_social_connect( 'facebook', object );
			  }
			}, {scope:'email'});	
		}
	});	
	
	// login with google+
	$( document ).on( 'click', 'a.deals-social-login-gplus', function() {
	
		var object = $(this);
		var errorel = $(this).parents('.deals-social-container').find('.deals-social-error');
		
		errorel.hide();
		errorel.html('');
		
		if( WpsDealsSocial.gperror == '1' ) {
			errorel.show();
			errorel.html( WpsDealsSocial.gperrormsg );
			return false;
		} else {
			
			var googleurl = $(this).parent().find('.wps-deals-social-gp-redirect-url').val();
			
			if(googleurl == '') {
				alert( WpsDealsSocial.urlerror );
				return false;
			}
				
			var googleLogin = window.open(googleurl, "google_login", "scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,height=400,width=600");			
			var gTimer = setInterval(function () { //set interval for executing the code to popup
				try {
					if (googleLogin.location.hostname == window.location.hostname) { //if login domain host name and window location hostname is equal then it will go ahead
						clearInterval(gTimer);
						googleLogin.close();
						wps_deals_social_connect( 'googleplus', object );
					}
				} catch (e) {}
			}, 500);
		}
		
	});
		
	// login with twitter
	$( document ).on( 'click', 'a.deals-social-login-twitter', function() {
	
		var errorel = $(this).parents('.deals-social-container').find('.deals-social-error');
		
		errorel.hide();
		errorel.html('');
		
		if( WpsDealsSocial.twerror == '1' ) {
			errorel.show();
			errorel.html( WpsDealsSocial.twerrormsg );
			return false;
		} else {
		
			var twitterurl = $(this).parent().find('.wps-deals-social-tw-redirect-url').val();
			
			if( twitterurl == '' ) {
				alert( WpsDealsSocial.urlerror );
				return false;
			}
				
			var twLogin = window.open(twitterurl, "twitter_login", "scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,height=400,width=600");			
			var tTimer = setInterval(function () { //set interval for executing the code to popup
				try {
					if (twLogin.location.hostname == window.location.hostname) { //if login domain host name and window location hostname is equal then it will go ahead
						clearInterval(tTimer);
						twLogin.close();
						window.parent.location = WpsDealsSocial.socialtwitterloginredirect;
					}
				} catch (e) {}
			}, 300);
		}
		
	});
	
	// login with linkedin
	$( document ).on( 'click', 'a.deals-social-login-linkedin', function() {
	
		var object = $(this);
		var errorel = $(this).parents('.deals-social-container').find('.deals-social-error');
		
		errorel.hide();
		errorel.html('');
		
		if( WpsDealsSocial.lierror == '1' ) {
			errorel.show();
			errorel.html( WpsDealsSocial.lierrormsg );
			return false;
		} else {
		
			var linkedinurl = $(this).parent().find('.wps-deals-social-li-redirect-url').val();
			
			if(linkedinurl == '') {
				alert( WpsDealsSocial.urlerror );
				return false;
			}
			var linkedinLogin = window.open(linkedinurl, "linkedin", "scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,height=400,width=600");			
			var lTimer = setInterval(function () { //set interval for executing the code to popup
				try {
					if (linkedinLogin.location.hostname == window.location.hostname) { //if login domain host name and window location hostname is equal then it will go ahead
						clearInterval(lTimer);
						linkedinLogin.close();
						wps_deals_social_connect( 'linkedin', object );
					}
				} catch (e) {}
			}, 300);
		}
	});
	
	// login with yahoo
	$( document ).on( 'click', 'a.deals-social-login-yahoo', function() {
	
		var object = $(this);
		var errorel = $(this).parents('.deals-social-container').find('.deals-social-error');
		
		errorel.hide();
		errorel.html('');
		
		if( WpsDealsSocial.yherror == '1' ) {
			errorel.show();
			errorel.html( WpsDealsSocial.yherrormsg );
			return false;
		} else {
		
			var yahoourl = $(this).parent().find('.wps-deals-social-yh-redirect-url').val();
			
			if(yahoourl == '') {
				alert( WpsDealsSocial.urlerror );
				return false;
			}
			var yhLogin = window.open(yahoourl, "yahoo_login", "scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,height=400,width=600");			
			var yTimer = setInterval(function () { //set interval for executing the code to popup
				try {
					if ( yhLogin.location.hostname == window.location.hostname) { //if login domain host name and window location hostname is equal then it will go ahead
						clearInterval(yTimer);
						//yhLogin.close();
						wps_deals_social_connect( 'yahoo', object );
					}
				} catch (e) {}
			}, 300);
		}
	});
	
	// login with foursquare
	$( document ).on( 'click', 'a.deals-social-login-foursquare', function() {
	
		var object = $(this);
		var errorel = $(this).parents('.deals-social-container').find('.deals-social-error');
		
		errorel.hide();
		errorel.html('');
		
		if( WpsDealsSocial.fserror == '1' ) {
			errorel.show();
			errorel.html( WpsDealsSocial.fserrormsg );
			return false;
		} else {
		
			var foursquareurl = $(this).parent().find('.wps-deals-social-fs-redirect-url').val();
			
			if(foursquareurl == '') {
				alert( WpsDealsSocial.urlerror );
				return false;
			}
			var fsLogin = window.open(foursquareurl, "foursquare_login", "scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,height=400,width=600");			
			var fsTimer = setInterval(function () { //set interval for executing the code to popup
				try {
					if (fsLogin.location.hostname == window.location.hostname) { //if login domain host name and window location hostname is equal then it will go ahead
						clearInterval(fsTimer);
						fsLogin.close();
						wps_deals_social_connect( 'foursquare', object );
					}
				} catch (e) {}
			}, 300);
		}
	});
	
	// login with windowslive
	$( document ).on( 'click', 'a.deals-social-login-windowslive', function() {
	
		var object = $(this);
		var errorel = $(this).parents('.deals-social-container').find('.deals-social-error');
		
		errorel.hide();
		errorel.html('');
		
		if( WpsDealsSocial.wlerror == '1' ) {
			errorel.show();
			errorel.html( WpsDealsSocial.wlerrormsg );
			return false;
		} else {
		
			var windowsliveurl = $(this).parent().find('.wps-deals-social-wl-redirect-url').val();
			
			if(windowsliveurl == '') {
				alert( WpsDealsSocial.urlerror );
				return false;
			}
			var windowsliveLogin = window.open(windowsliveurl, "linkedin", "scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,height=400,width=600");			
			var wlTimer = setInterval(function () { //set interval for executing the code to popup
				try {
					if (windowsliveLogin.location.hostname == window.location.hostname) { //if login domain host name and window location hostname is equal then it will go ahead
						clearInterval(wlTimer);
						windowsliveLogin.close();
						wps_deals_social_connect( 'windowslive', object );
					}
				} catch (e) {}
			}, 300);
		}
	});
	
});
// Social Connect Process
function wps_deals_social_connect( type, object ) {
	
	var data = { 
					action	:	'wps_deals_social_login',
					type	:	type
				};
				
	//show loader
	jQuery('.deals-social-loader').show();
	jQuery('.deals-social-wrap').hide();
	
	jQuery.post( WpsDealsSocial.ajaxurl,data,function(response){
		//alert( response );
		// hide loader
		jQuery('.deals-social-loader').hide();
		jQuery('.deals-social-wrap').show();
		
		var redirect_url = object.parents('.deals-social-container').find('.deals-login-redirect-url').val();
		
		if( response != '' ) {
			
			var result = jQuery.parseJSON( response );
			//if redireection is passed then redirect user to specific location
			if( result.redirect != '' && result.redirect != undefined ) {
				//redirect to specific url
				window.location = result.redirect;
				//wps_deals_reload( result.redirect );
				
			} else if ( result.success == '1' ){
				
				//alert( redirect_url );
				
				if( redirect_url != '' ) {
					
					window.location = redirect_url;
					
				} else {
					
					//if user created successfully then reload the page
					window.location.reload();
					//wps_deals_reload();
				}
				
			} else {
				//reload same page if any error occureed
				window.location.reload();
				//wps_deals_reload();
			}
		}
	});
	
}