<?php 

/**
 * Available Downloads Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/my-account/available-downloads.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<h3><?php echo apply_filters( 'wps_deals_available_download_title', __( 'Available Downloads', 'wpsdeals' ) ) ?></h3>
	
<ul class="deals-downloads">
	<?php 
		foreach( $downloadfiles as $download ) {
			echo '<li>' . $download . '</li>';
		}
	?>
</ul>