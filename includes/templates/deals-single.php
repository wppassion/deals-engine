<?php 

/**
 * Single Deals Template
 *
 * Displays all the content for the single Deal.
 * 
 * Override this template by copying it to yourtheme/deals-engine/single.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
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

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wps_deals_get_template( 'content-single-deal.php' ); ?>

			<?php comments_template( '', true ); ?>
			
		<?php endwhile; // end of the loop. ?>
		
	<?php endif; ?>

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