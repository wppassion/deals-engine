<?php

/**
 * Home page social button google plus
 * 
 * Handles to show google plus button
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/social-buttons/google.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
?>

<div class="wps-deals-connect-buttons">
	<div class="wps-deals-gp-button">
		<g:plusone href="<?php echo $dealurl;?>" size="medium" annotation="bubble" onendinteraction="wps_deals_gp_share_<?php echo $dealid;?>"></g:plusone>
	</div><!--wps-deals-gp-button-->
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
</div><!--wps-deals-connect-buttons-->