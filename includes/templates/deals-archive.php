<?php 

/**
 * Deals Archive Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/deals-archive.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// get deal size
$deal_size = $wps_deals_options['deals_size_archive'];
	
// get the header
get_header( 'deals' );

?>

	<?php
		/**
		 * wps_deals_before_main_content hook
		 *
		 * @hooked wps_deals_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked wps_deals_breadcrumb - 20
		 */
		do_action( 'wps_deals_before_main_content' );
	?>
	
	<?php if( apply_filters( 'wps_deals_show_page_title', true ) ) : ?>

		<h1 class="page-title"><?php wps_deals_page_title(); ?></h1>

	<?php endif; ?>
	
	<div class="deals-archive <?php echo $deal_size; ?> deals-row">
	
		<?php do_action( 'wps_deals_archive_description' ); ?>
		
		<?php do_action( 'wps_deals_archive_deals' ); ?>
		
	</div>
	
	<?php
		/**
		 * wps_deals_after_main_content hook
		 *
		 * @hooked wps_deals_output_content_wrapper_end - 30 (outputs closing divs for the content)
		 */
		do_action( 'wps_deals_after_main_content' );
	?>

	<?php
		/**
		 * wps_deals_sidebar hook
		 *
		 * @hooked wps_deals_sidebar - 10
		 */
		do_action( 'wps_deals_sidebar' );
	?>

<?php get_footer( 'deals' ); ?>