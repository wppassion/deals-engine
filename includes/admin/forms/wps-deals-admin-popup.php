<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Shortocde UI
 *
 * This is the code for the pop up editor, which shows up when an user clicks
 * on the deals engine icon within the WordPress editor.
 *
 * @package Social Deals Engine
 * @since 1.0.0
 * 
 **/

global $wps_deals_model;

?>

<div class="wps-deals-popup-content">

	<div class="wps-deals-header">
		<div class="wps-deals-header-title"><?php _e( 'Add A Social Deals Engine Shortcode', 'wpsdeals' );?></div>
		<div class="wps-deals-popup-close"><a href="javascript:void(0);" class="wps-deals-close-button"><img src="<?php echo WPS_DEALS_URL;?>includes/images/tb-close.png"></a></div>
	</div>
	
	<div class="wps-deals-popup">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label><?php _e( 'Select A Shortcode', 'wpsdeals' );?></label>		
					</th>
					<td>
						<select data-placeholder="<?php _e( '--Select A Shortcode--', 'wpsdeals' ); ?>" id="wps_deals_shortcodes" class="chzn-select">
		      				<option value=""></option>							
							<option value="wps_home_deals"><?php _e( 'Home Page Deals', 'wpsdeals' );?></option>
							<option value="wps_deals_by_status"><?php _e( 'Deals By Status', 'wpsdeals' );?></option>
							<option value="wps_deals_by_category"><?php _e( 'Deals By Category', 'wpsdeals' );?></option>
							<option value="wps_deals_checkout"><?php _e( 'Checkout', 'wpsdeals' );?></option>
							<option value="wps_deals_social_login"><?php _e( 'Social Login', 'wpsdeals' );?></option>
							<option value="wps_deals_by_id"><?php _e( 'Deal By Id', 'wpsdeals' );?></option>
							<option value="wps_deals_by_ids"><?php _e( 'Deals List By Id', 'wpsdeals' );?></option>
							<option value="wps_deals_my_account"><?php _e( 'My Account', 'wpsdeals' );?></option>							
							<?php
									//do action for adding shortcode option for backend popup
									do_action( 'wps_deals_admin_shortcodes_option_after' );
							?>
						</select>
						<input id="wps_deals_shortcodes_hidden" type="hidden" value="" />
					</td>
				</tr>
			</tbody>
		</table>
		
		<div id="wps_deals_home_deals_options" class="wps-deals-shortcodes-options">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row">
							<label><?php _e( 'Number of Deals:', 'wpsdeals' );?></label>		
						</th>
						<td>
							<input type="number" min="1" name="wps_deals_home_deals_options" class="small-text wps_deals_home_deals" id="wps_home_number_of_deals" value="1"><br>
							<span class="description"><?php _e( 'Enter the number of deals you want to display. Leave it blank if you don\'t want to limit deals listing.', 'wpsdeals' );?></span>
						</td>				
					</tr>
				</tbody>
			</table>
		</div><!--wps_home_number_of_deals_options-->
		
		<div id="wps_deals_status_options" class="wps-deals-shortcodes-options">
		
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row">
							<label><?php _e( 'Choose Deals Status:', 'wpsdeals' );?></label>		
						</th>
						<td>
							<input type="checkbox" id="wps_deals_enable_active" class="wps_delas_status" value="active" name="wps_deals_enable_active" checked/>Active<br />
							<span class="description"><?php _e( 'Check this box if you want to display Active deals.', 'wpsdeals' );?></span>
							<br /><br />
							<input type="checkbox" id="wps_deals_enable_ending_soon" class="wps_delas_status" value="ending-soon" name="wps_deals_enable_ending_soon" checked/>Ending Soon<br />
							<span class="description"><?php _e( 'Check this box if you want to display Ending Soon deals.', 'wpsdeals' );?></span>
							<br /><br />
							<input type="checkbox" id="wps_deals_enable_upcoming" class="wps_delas_status" value="upcoming" name="wps_deals_enable_upcoming" checked/>Upcoming<br />
							<span class="description"><?php _e( 'Check this box if you want to display Upcoming deals.', 'wpsdeals' );?></span>
						</td>
					</tr>
				</tbody>
			</table>
			
		</div><!--wps_deals_tab_options-->
		
		<div id="wps_deals_by_category_options" class="wps-deals-shortcodes-options">
		
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row">
							<label><?php _e( 'Select Deals Category:', 'wpsdeals' );?></label>		
						</th>
						<td>
							<?php 
									$catargs = array(
														'type'                     => WPS_DEALS_POST_TYPE,
														'child_of'                 => '0',
														'parent'                   => '',
														'orderby'                  => 'name',
														'order'                    => 'DESC',
														'hide_empty'               => '1',
														'hierarchical'             => '1',
														'exclude'                  => '',
														'include'                  => '',
														'number'                   => '',
														'taxonomy'                 => WPS_DEALS_POST_TAXONOMY,
														'pad_counts'               => false 
													);
									$dealscategories = get_categories( $catargs );
							?>
							<select data-placeholder="<?php _e( '--Select Category--', 'wpsdeals' ); ?>" id="wps_deals_category_id" class="chzn-select">
		      					<option value=""></option>
								<?php
										foreach ( $dealscategories as $cat ) { ?>
											<option value="<?php echo $cat->slug;?>"><?php echo $cat->name;?></option>
								<?php	}
								?>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			
		</div><!--wps_deals_by_category_options-->
		
		<div id="wps_deals_social_login_options" class="wps-deals-shortcodes-options">
		
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row">
							<label for="wps_deals_title"><?php _e( 'Social Login Title:', 'wpsdeals' );?></label>		
						</th>
						<td>
							<input type="text" id="wps_deals_title" class="regular-text" value="<?php _e( 'Prefer to Login with Social Media', 'wpsdeals' );?>" /><br/>
							<span class="description"><?php _e( 'Enter a social login title.', 'wpsdeals' );?></span>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="wps_deals_redirect_url"><?php _e( 'Redirect URL:', 'wpsdeals' );?></label>		
						</th>
						<td>
							<input type="text" id="wps_deals_redirect_url" class="regular-text" value="" /><br/>
							<span class="description"><?php _e( 'Enter a redirect URL for users after they login with social media. The URL must start with http://', 'wpsdeals' );?></span>
						</td>
					</tr>
				</tbody>
			</table>
			
		</div><!--wps_deals_social_login_options-->
		
		<div id="wps_deals_single_deal_options" class="wps-deals-shortcodes-options">
		
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row">
							<label for="wps_deals_single_deal_id"><?php _e( 'Select Deal:', 'wpsdeals' );?></label>		
						</th>
						<td>
							<select data-placeholder="<?php _e( 'Select Deal', 'wpsdeals' ); ?>" id="wps_deals_single_deal_id" class="chzn-select">
		      					<option value=""></option>
							<?php
								$deal_ids = $wps_deals_model->wps_deals_get_data( array( 'fields' => 'ids' ) );
								if( !empty( $deal_ids ) ) {
									foreach ( $deal_ids as $key => $deal_id ) {
										echo '<option value="' . $deal_id . '">' . get_the_title( $deal_id ) . '</option>';	
									}
								}
							?>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			
		</div><!--wps_deals_single_deal_options-->
		
		<div id="wps_deals_multiple_deal_options" class="wps-deals-shortcodes-options">
		
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row">
							<label for="wps_deals_multiple_deal_ids"><?php _e( 'Choose Deals:', 'wpsdeals' );?></label>	
						</th>
						<td>
							<select data-placeholder="<?php _e( 'Choose Deals', 'wpsdeals' ); ?>" id="wps_deals_multiple_deal_ids" class="chzn-select" multiple="multiple">
							<?php
								$deal_ids = $wps_deals_model->wps_deals_get_data( array( 'fields' => 'ids' ) );
								if( !empty( $deal_ids ) ) {
									foreach ( $deal_ids as $key => $deal_id ) {
										echo '<option value="' . $deal_id . '">' . get_the_title( $deal_id ) . '</option>';	
									}
								}
							?>
							</select><br />
							<span class="description"><?php _e( 'Choose that deals you want to display.', 'wpsdeals' );?></span>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="wps_deals_disable_price"><?php _e( 'Disable Price Box:', 'wpsdeals' );?></label>		
						</th>
						<td>
							<input type="checkbox" id="wps_deals_disable_price" name="wps_deals_disable_price"/><br />
							<span class="description"><?php _e( 'Check this box if you want to disable pricing box below deal image.', 'wpsdeals' );?></span>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="wps_deals_disable_timer"><?php _e( 'Disable Timer:', 'wpsdeals' );?></label>		
						</th>
						<td>
							<input type="checkbox" id="wps_deals_disable_timer" name="wps_deals_disable_timer"/><br />
							<span class="description"><?php _e( 'Check this box if you want to disable timer below deal content.', 'wpsdeals' );?></span>
						</td>
					</tr>
				</tbody>
			</table>
			
		</div><!--wps_deals_multiple_deal_options-->
		
		<?php
				//do action for adding shortcode option for backend popup
				do_action( 'wps_deals_admin_shortcodes_option_content_after' );
		?>
		
		<div id="wps_deals_insert_container" >
			<input type="button" class="button-secondary" id="wps_deals_insert_shortcode" value="<?php _e( 'Insert Shortcode', 'wpsdeals' ); ?>">
		</div>
		
	</div><!--.wps-deals-popup-->
	
</div><!--.wps-deals-popup-content-->
<div class="wps-deals-popup-overlay"></div>