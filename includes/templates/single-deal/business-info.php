<?php

/**
 * The template for displaying the business info after the content.
 *
 * Override this template by copying it to yourtheme/deals-engine/single-deal/business-info.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="deals-row">

	<div class="deals-business-single deals-col-12">

		<p class="deals-business-title">
			<?php echo $businesstitle; ?>
		</p>
		
		<?php if( !empty( $mapaddpress ) ) : ?>
		<div class="deals-google-map-single">		
		
			<div class="deals-map" id="map"></div>
						
		</div>
		<?php endif; ?>
		
		<?php if( !empty( $imgurl ) ) : ?>
		<div class="deals-business-logo-single deals-col-6">

			<img src="<?php echo $imgurl; ?>" alt="<?php _e( 'Logo', 'wpsdeals' ); ?>" />
			
		</div>
		<?php endif; ?>
		
		<div class="business-address-single deals-col-6">

			<?php if( !empty( $address ) ) : ?>
			<p class="business-address">
				<?php echo nl2br( $address );?>								
			</p>
			<?php endif; ?>
			
			<?php if( !empty( $businesslink ) ) : ?>
			<p>
				<a class="business-link" href="<?php echo $businesslink; ?>" target="_blank">
					<?php echo $businesslink; ?>
				</a>
			</p>							
			<?php endif; ?>			
			
		</div>
		
	</div>

</div>