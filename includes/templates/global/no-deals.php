<?php

/**
 * No Deals Found template.
 * 
 * Override this template by copying it to yourtheme/deals-engine/global/no-deals.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>	

<div class="deals-col-12">

	<div class="deals-no-deals">

		<h3>
			<?php echo apply_filters( 'wps_deals_home_no_deals_message', __( 'No deals found', 'wpsdeals' ) );?>
		</h3>

	</div>
	
</div>