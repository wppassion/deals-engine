<?php 

/**
 * Image Template
 * 
 * Override this template by copying it to <ourtheme/deals-engine/single-deal/image.php
 * 
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$image_link	=	wp_get_attachment_url( $dealurl );

?>

<div class="deals-single-image">

	<?php if(!empty( $dealimgsrc )) { ?>
		<a href="<?php echo $dealimgsrc; ?>" rel="prettyPhoto[deals-gallery]" >
			<img class="attachment-wpsdeals-single wp-post-image"  src="<?php echo $dealimgsrc; ?>" >
		</a>
	<?php } elseif (!empty( $dealimg )) { ?>
		<a href="<?php echo $image_link; ?>" rel="prettyPhoto[deals-gallery]" >
			<?php echo $dealimg; ?>
		</a>
	<?php } else  { ?>
			<img class="attachment-wpsdeals-single wp-post-image"  src="<?php echo $dealnoimgsrc; ?>" >
	<?php } ?>
</div>