<?php 

/**
 * Social Template
 *
 * To handles some small HTML content for social login
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/content/social.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-social-container">
	
	<?php if( !empty( $title ) ) { ?>
		<h2><?php echo apply_filters( 'wps_deals_social_login_title_lable', $title );?></h2>
	<?php } ?>
	
	<div class="deals-social-wrap">
		<?php 	
			/**
			 * wps_deals_checkout_social_login hook
			 *
			 * @hooked wps_deals_social_login_facebook - 5
			 * @hooked wps_deals_social_login_twitter - 10
			 * @hooked wps_deals_social_login_google - 15
			 * @hooked wps_deals_social_login_linkedin - 20
			 * @hooked wps_deals_social_login_yahoo - 25
			 */
			do_action( 'wps_deals_checkout_social_login' );
		?>
	</div>

	<div class="deals-social-error"></div>
	
	<div class="deals-social-loader">
		<img src="<?php echo WPS_DEALS_SOCIAL_URL;?>/images/social-loader.gif" alt="<?php _e( 'Social Loader', 'wpsdeals');?>"/>
	</div>
		
	<input type="hidden" class="deals-login-redirect-url" value="<?php echo $login_redirect_url;?>" />
		
</div>