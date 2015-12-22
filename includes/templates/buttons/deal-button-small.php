<?php
/**
 * Small See Deal Button Template
 * 
 * Handles to See Deal Small Button
 * 
 * Override this template by copying it to
 * yourtheme/deals-engine/buttons/deal-button-small.php
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="wps-deals-btn-small">
	<a href="<?php echo $dealurl;?>"><?php echo apply_filters('wps_deals_see_deal_small_button_text',__('See Deal','wpsdeals'));?></a>
</div>