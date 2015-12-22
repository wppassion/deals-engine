<?php

/**
 * Google Plus Button Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/social-buttons/google.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
?>

<div class="deals-gplus deals-col-4">

	<div class="deals-gp-button">
		<g:plusone href="<?php echo $dealurl;?>" size="medium" annotation="bubble" onendinteraction="wps_deals_gp_share_<?php echo $dealid;?>"></g:plusone>
	</div>
	
	<script type="text/javascript">
		function wps_deals_gp_share_<?php echo $dealid;?>( res ){
				
			//check user shared deal on google plus or not
			if( res.type == "confirm" ) {	
				var data = { 
							postid	: '<?php echo $dealid;?>',
							action	: "deals_update_social_media_values",
							type	: "gp"
							};
			
				jQuery.post("<?php echo admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) );?>", data, function(response) {
					if(response != "") {
						//window.location.reload();
						wps_deals_reload();
					}
				});
			}
		}
	</script>

</div>