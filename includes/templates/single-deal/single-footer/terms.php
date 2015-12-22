<?php 

/**
 * Template Terms & Conditions
 * 
 * Handles to show terms & conditions
 * 
 * Override this template by copying it to 
 * yourtheme/deals-engine/single-deal/single-footer/terms.php
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<p><a href="#myModal" role="button" data-toggle="modal"><?php _e('Terms & Condition','wpsdeals' );?></a></p>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel"><?php _e('Terms & Condition','wpsdeals');?></h3>
	</div>
	<div class="modal-body">
		<?php echo wpautop( $termsconditions );?>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true"><?php _e( 'Close','wpsdeals');?></button>
	</div>
</div><!--#myModal-->