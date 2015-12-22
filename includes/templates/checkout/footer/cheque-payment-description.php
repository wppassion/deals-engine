<?php 

/**
 * Cheque Payment Description Template
 * 
 * Override this template by copying it to yourtheme/deals-engine/checkout/footer/cheque-payment-description.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div id="deals_cheque_payment_description" class="deals-payment-description <?php echo $enablebankdesc;?>">
	<p>
		<?php echo $description;?>
	</p>
</div>