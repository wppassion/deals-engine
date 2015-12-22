<?php

/**
 * The template for displaying product content in the single-deal.php template
 *
 * Override this template by copying it to yourtheme/deals-engine/content-single-deal.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_options, $post;

$prefix = WPS_DEALS_META_PREFIX;

//today's date time
$today	= wps_deals_current_date();
		
// get the end date & time
$enddate = get_post_meta( $post->ID, $prefix . 'end_date', true );

// get the value for the amount of available deals
$available = get_post_meta( $post->ID, $prefix . 'avail_total', true );

$expired = '';

if( ( !empty( $enddate ) && $enddate <= $today ) || $available == '0' ) {
	$expired = ' deal-expired';
}

// get the size
$deal_size = isset( $wps_deals_options['deals_size_single'] ) ? $wps_deals_options['deals_size_single'] : '';

?>

<?php
	/**
	 * wps_deals_before_single_deal hook
	 */
	 do_action( 'wps_deals_before_single_deal' );

	 if( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="http://schema.org/Product" id="deal-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * wps_deals_before_single_deal_content hook
		 */
		do_action( 'wps_deals_before_single_deal_content' );
	?>

	<div class=" <?php echo $deal_size; ?>">
	
		<div class="deals-container deals-clearfix">
		
			<div id="sde" class="deals-single deals-row<?php echo $expired; ?>">
	
				<?php 
					/**
					 * wps_deals_single_header_content hook
					 *
					 * @hooked wps_deals_breadcrumbs - 5
					 * @hooked wps_deals_single_header_message - 10
					 * @hooked wps_deals_single_header_title - 20
					 * @hooked wps_deals_single_header_left - 30
					 * @hooked wps_deals_single_header_right - 35
					 */
					do_action( 'wps_deals_single_header_content' );
				?>
				
			</div>

			<?php
				/**
				 * wps_deals_single_content hook
				 *
				 * @hooked wps_deals_single_description - 10
				 * @hooked wps_deals_single_business_info - 20
				 * @hooked wps_deals_single_terms_conditions - 30
				 */
				do_action( 'wps_deals_single_content' );
			?>
			<?php
				
				/**
				 * wps_deals_single_content hook
				 *
				 * @hooked wps_deals_single_description - 10
				 * @hooked wps_deals_single_business_info - 20
				 * @hooked wps_deals_single_terms_conditions - 30
				 */
				do_action( 'wps_deals_single_footer_content' );
				
			?>
			
		</div>

	</div><!-- .summary -->

	<?php
		/**
		 * wps_deals_after_single_deal_content hook
		 */
		do_action( 'wps_deals_after_single_deal_content' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #deal-<?php the_ID(); ?> -->

<?php do_action( 'wps_deals_after_single_deal' ); ?>