<?php
/**
 * Admin View: Notice - Theme Support
 * 
 * @package Social Deals Engine
 * @since 2.0.6
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div id="message" class="updated wps-deals-message wc-connect">
	<p><?php _e( '<strong>Your theme does not declare Social Deals Engine support</strong> &#8211; if you encounter layout issues please read our integration guide or choose a Social Deals theme :)', 'wpsdeals' ); ?></p>
	<p class="submit"><a target="_blank" href="<?php echo esc_url( apply_filters( 'wps_deals_docs_url', 'https://kaxy.freshdesk.com/support/solutions/articles/4000038009-third-party-custom-theme-compatibility', 'theme-compatibility' ) ); ?>" class="button-primary"><?php _e( 'Theme Integration Guide', 'wpsdeals' ); ?></a> <a class="skip button-primary" href="<?php echo esc_url( add_query_arg( 'hide_sde_theme_support_notice', 'true' ) ); ?>"><?php _e( 'Hide this notice', 'wpsdeals' ); ?></a></p>
</div>