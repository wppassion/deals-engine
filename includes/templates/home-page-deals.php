<?php 

/**
 * Deals Home Page Template
 *
 * This displays all the content for the deals home page.
 * 
 * Override this template by copying it to yourtheme/deals-engine/deals-home.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wps_deals_options;
	
// get deal size
$deal_size = $wps_deals_options['deals_size'];
	
?>

<div class="deals-container deals-clearfix">

	<div class="deals-home <?php echo $deal_size; ?>">

		<?php	
			/**
			 * wps_deals_home_page_content hook
			 *
			 * @hooked wps_deals_home_page_header - 5 (outputs the top placed deal)
			 * @hooked wps_deals_home_page_content - 10 (outputs the additional deals)
			 */
			do_action( 'wps_deals_home_page_content' );
		?>
		
	</div>
	
</div>