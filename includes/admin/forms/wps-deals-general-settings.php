<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page General Tab
 *
 * The code for the plugins settings page general tab
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
	//get all pages					
	$get_pages = get_pages(); 
?>
<!-- beginning of the general settings meta box -->
<div id="wps-deals-general" class="post-box-container">
	<div class="metabox-holder">	
		<div class="meta-box-sortables ui-sortable">
			<div id="general" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsdeals' ); ?>"><br /></div>

					<!-- general settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'General Settings', 'wpsdeals' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							<!-- General Settings Start -->
							<tr>
								<th colspan="2" valign="top" scope="row">
									<span class="wps-deals-settings-sep-first"><?php _e( 'General Settings', 'wpsdeals' ); ?></span>
									<input type="submit" id="wps-deals-settings-submit" name="wps-deals-settings-submit" class="button-primary" value="<?php _e('Save Changes','wpsdeals');?>" />
								</th>
							</tr>
							<?php 
									//adding something before general settings	
									do_action('wps_deals_add_general_settings_before');
							?>
							<tr>
								<th scope="row">
									<label for="wps_deals_options[del_all_options]"><?php _e( 'Delete Options:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="checkbox" name="wps_deals_options[del_all_options]" id="wps_deals_options[del_all_options]" value="1" <?php if ( isset( $wps_deals_options['del_all_options'] ) ) { checked( '1', $wps_deals_options['del_all_options'] ); } ?> /><br />
									<span class="description"><?php _e( 'Check this box if you want to delete all options and tables from the database which have been created by the plugin. They will then only be deleted, when you deactivate the plugin.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[enable_testmode]"><?php _e('Enable Test Mode:', 'wpsdeals');?></label>
								</th>
								<td>
									<input type="checkbox" id="wps_deals_options[enable_testmode]" name="wps_deals_options[enable_testmode]" value="1" <?php if(isset($wps_deals_options['enable_testmode'])) { checked('1',$wps_deals_options['enable_testmode']); }?>/><br />
									<span class="description"><?php _e( 'While in test mode no live transactions are processed. To fully use the test mode, you must have a sandbox (test) account for the payment gateway you are testing.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[caching]"><?php _e('Caching:', 'wpsdeals');?></label>
								</th>
								<td>
									<input type="checkbox" id="wps_deals_options[caching]" name="wps_deals_options[caching]" value="1" <?php if( isset( $wps_deals_options['caching'] ) ) { checked('1',$wps_deals_options['caching']); }?>/><br />
									<span class="description"><?php _e( 'Check this box, if you use a caching plugin. For more information visit  our <a href="http://wpsocial.com/knowledgebase/" target="_blank">Knowledge Base</a>', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[disable_twitter_bootstrap]"><?php _e('Disable Twitter Bootstrap:', 'wpsdeals');?></label>
								</th>
								<td>
									<input type="checkbox" id="wps_deals_options[disable_twitter_bootstrap]" name="wps_deals_options[disable_twitter_bootstrap]" value="1" <?php if(isset($wps_deals_options['disable_twitter_bootstrap'])) { checked('1',$wps_deals_options['disable_twitter_bootstrap']); }?>/><br />
									<span class="description"><?php _e( 'Check this box, if your theme does already include the Twitter Bootstrap framework.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[deals_size]"><?php _e( 'Home Page Size:', 'wpsdeals');?></label>
								</th>
								<td>
									<select id="wps_deals_options[deals_size]" name="wps_deals_options[deals_size]">
										<option value="small" <?php selected('small',$wps_deals_options['deals_size'],true);?>><?php _e('Small','wpsdeals');?></option>		
										<option value="medium" <?php selected('medium',$wps_deals_options['deals_size'],true);?>><?php _e('Medium','wpsdeals');?></option>
										<option value="large" <?php selected('large',$wps_deals_options['deals_size'],true);?>><?php _e('Large','wpsdeals');?></option>
									</select><br />
									<span class="description"><?php _e( 'Choose the size for the Deals home/overview page. This will then use different sizes for the fonts and spacing so that they fit in to your theme.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[deals_home]"><?php _e( 'Home Deals:', 'wpsdeals');?></label>
								</th>
								<td>
									<select id="wps_deals_options[deals_home]" name="wps_deals_options[deals_home]">
										<option value="rand" <?php selected( 'rand', $wps_deals_options['deals_home'], true ); ?>><?php _e( 'Random', 'wpsdeals' ); ?></option>		
										<option value="date" <?php selected( 'date', $wps_deals_options['deals_home'], true ); ?>><?php _e( 'Latest', 'wpsdeals' ); ?></option>
									</select><br />
									<span class="description"><?php _e( 'Choose how you want to display the top placed Deal on the Deals home/overview page. Random means, it will randomly display one Deal which is set to display on the home page. Latest means, it will only disaplay the latest Deal.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[deals_size_single]"><?php _e( 'Deals Page Size:', 'wpsdeals');?></label>
								</th>
								<td>
									<select id="wps_deals_options[deals_size_single]" name="wps_deals_options[deals_size_single]">
										<option value="small" <?php selected( 'small', $wps_deals_options['deals_size_single'],  true );?>><?php _e( 'Small', 'wpsdeals' );?></option>		
										<option value="medium" <?php selected( 'medium', $wps_deals_options['deals_size_single'], true );?>><?php _e( 'Medium', 'wpsdeals' );?></option>
										<option value="large" <?php selected( 'large', $wps_deals_options['deals_size_single'], true );?>><?php _e( 'Large', 'wpsdeals' );?></option>
									</select><br />
									<span class="description"><?php _e( 'Choose the size for the Deals page. This will then use different sizes for the fonts and spacing.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[deals_size_archive]"><?php _e( 'Deals Archive Size:', 'wpsdeals');?></label>
								</th>
								<td>
									<select id="wps_deals_options[deals_size_archive]" name="wps_deals_options[deals_size_archive]">
										<option value="small" <?php selected('small',$wps_deals_options['deals_size_archive'],true);?>><?php _e('Small','wpsdeals');?></option>		
										<option value="medium" <?php selected('medium',$wps_deals_options['deals_size_archive'],true);?>><?php _e('Medium','wpsdeals');?></option>
										<option value="large" <?php selected('large',$wps_deals_options['deals_size_archive'],true);?>><?php _e('Large','wpsdeals');?></option>
									</select><br />
									<span class="description"><?php _e( 'Choose the size for the Deals archive pages. This will then use different sizes for the fonts and spacing so that they fit in to your theme.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[deals_btn_color]"><?php _e( 'Button Color:', 'wpsdeals');?></label>
								</th>
								<td>
									<select id="wps_deals_options[deals_btn_color]" name="wps_deals_options[deals_btn_color]">
										<option value="red" <?php selected( 'red', $wps_deals_options['deals_btn_color'],  true );?>><?php _e( 'Red', 'wpsdeals' );?></option>		
										<option value="green" <?php selected( 'green', $wps_deals_options['deals_btn_color'], true );?>><?php _e( 'Green', 'wpsdeals' );?></option>
										<option value="darkgreen" <?php selected( 'darkgreen', $wps_deals_options['deals_btn_color'], true );?>><?php _e( 'Dark Green', 'wpsdeals' );?></option>
										<option value="blue" <?php selected( 'blue', $wps_deals_options['deals_btn_color'],  true );?>><?php _e( 'Blue', 'wpsdeals' );?></option>		
										<option value="darkblue" <?php selected( 'darkblue', $wps_deals_options['deals_btn_color'], true );?>><?php _e( 'Dark Blue', 'wpsdeals' );?></option>
										<option value="orange" <?php selected( 'orange', $wps_deals_options['deals_btn_color'], true );?>><?php _e( 'Orange', 'wpsdeals' );?></option>
										<option value="gray" <?php selected( 'gray', $wps_deals_options['deals_btn_color'], true );?>><?php _e( 'Gray', 'wpsdeals' );?></option>
									</select><br />
									<span class="description"><?php _e( 'Choose a color scheme you want to use for the buttons.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[deals_columns]"><?php _e( 'Columns Deals Home:', 'wpsdeals');?></label>
								</th>
								<td>
									<select id="wps_deals_options[deals_columns]" name="wps_deals_options[deals_columns]">
										<option value="deals-col-6" <?php selected( 'deals-col-6', $wps_deals_options['deals_columns'],  true );?>><?php _e( '2 Columns', 'wpsdeals' );?></option>		
										<option value="deals-col-4" <?php selected( 'deals-col-4', $wps_deals_options['deals_columns'], true );?>><?php _e( '3 Columns', 'wpsdeals' );?></option>
										<option value="deals-col-3" <?php selected( 'deals-col-3', $wps_deals_options['deals_columns'], true );?>><?php _e( '4 Columns', 'wpsdeals' );?></option>
									</select><br />
									<span class="description"><?php _e( 'Choose the amount of columns you want to display for the more Deals on the Deals home page.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[deals_columns_archive]"><?php _e( 'Columns Deals Archive:', 'wpsdeals');?></label>
								</th>
								<td>
									<select id="wps_deals_options[deals_columns_archive]" name="wps_deals_options[deals_columns_archive]">
										<option value="deals-col-6" <?php selected( 'deals-col-6', $wps_deals_options['deals_columns_archive'],  true );?>><?php _e( '2 Columns', 'wpsdeals' );?></option>		
										<option value="deals-col-4" <?php selected( 'deals-col-4', $wps_deals_options['deals_columns_archive'], true );?>><?php _e( '3 Columns', 'wpsdeals' );?></option>
										<option value="deals-col-3" <?php selected( 'deals-col-3', $wps_deals_options['deals_columns_archive'], true );?>><?php _e( '4 Columns', 'wpsdeals' );?></option>
									</select><br />
									<span class="description"><?php _e( 'Choose the amount of columns you want to display on the Deals archive pages.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[disable_more_deals]"><?php _e( 'Disable More Deals:', 'wpsdeals' );?></label>
								</th>
								<td>
									<input type="checkbox" id="wps_deals_options[disable_more_deals]" name="wps_deals_options[disable_more_deals]" value="1" <?php if(isset($wps_deals_options['disable_more_deals'])) { checked('1',$wps_deals_options['disable_more_deals']); }?>/><br />
									<span class="description"><?php _e( 'Check this box, if you don\'t want to display the Ending Soon and Upcomming Deals on your Deals page.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[ending_deals_in]"><?php _e( 'Ending Deals:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" id="wps_deals_options[ending_deals_in]" name="wps_deals_options[ending_deals_in]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['ending_deals_in']);?>" class="small-text"/><br />
									<span class="description"><?php _e('Enter a number of days here. If you enter 2 as example, then all Deals which will end within 2 days will be displayed within the "Ending Soon" tab.','wpsdeals');?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[upcoming_deals_in]"><?php _e( 'Upcoming Deals:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" id="wps_deals_options[upcoming_deals_in]" name="wps_deals_options[upcoming_deals_in]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['upcoming_deals_in']);?>" class="small-text"/><br />
									<span class="description"><?php _e('Enter a number of days here. If you enter 2 as example, then all Deals which will start within 2 days will be displayed within the "Upcoming Deals" tab.','wpsdeals');?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[deals_per_page]"><?php _e( 'Deals Per Page:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" id="wps_deals_options[deals_per_page]" name="wps_deals_options[deals_per_page]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['deals_per_page']);?>" class="small-text"/><br />
									<span class="description"><?php _e( 'Enter the number of Deals you want to display.', 'wpsdeals' );?></span>
								</td>
							</tr>
							
							<?php // Add Field for enable sorting on deals home page. ?>
							<tr>
								<th scope="row">
									<label for="wps_deals_options[enable_deals_orderby]"><?php _e( 'Enable Deals Sorting:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="checkbox" name="wps_deals_options[enable_deals_orderby]" id="wps_deals_options[enable_deals_orderby]" value="1" <?php if ( isset( $wps_deals_options['enable_deals_orderby'] ) ) { checked( '1', $wps_deals_options['enable_deals_orderby'] ); } ?> /><br />
									<span class="description"><?php _e( 'Check this box if you want to enable a sorting drop down on the Deals home page.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<?php // Add Field for enable add to cart button at bottom. ?>
							<tr>
								<th scope="row">
									<label for="wps_deals_options[enable_bottom_button]"><?php _e( 'Enable add to cart Button:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="checkbox" id="wps_deals_options[enable_bottom_button]" name="wps_deals_options[enable_bottom_button]" value="1" <?php if(isset($wps_deals_options['enable_bottom_button'])) { checked('1',$wps_deals_options['enable_bottom_button']); }?>/><br />
									<span class="description"><?php _e( 'Check this box, if you want to display add to cart on bottom of each deals page.', 'wpsdeals' );?></span>
								</td>
							</tr>
							
							<?php // Add field for enable breadcrumb. ?>
							<tr>
								<th scope="row">
									<label for="wps_deals_options[enable_breadcrumb]"><?php _e( 'Enable Breadcrumb:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="checkbox" id="wps_deals_options[enable_breadcrumb]" name="wps_deals_options[enable_breadcrumb]" value="1" <?php if(isset($wps_deals_options['enable_breadcrumb'])) { checked('1',$wps_deals_options['enable_breadcrumb']); }?>/><br />
									<span class="description"><?php _e( 'Check this box, if you want to display breadcrumb.', 'wpsdeals' );?></span>
								</td>
							</tr>
							
							<?php // Add Field for default deals sorting order on deals home page. ?>
							<tr>
								<th scope="row">
									<label for="wps_deals_options[default_deals_orderby]"><?php _e( 'Default Deals Sorting:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<?php 
										$default_orderby = array(
																'date-asc'		=> __( 'Sort by date (asc)','wpsdeals' ),
																'date-desc'		=> __( 'Sort by date (desc)','wpsdeals' ),
																'price-asc'		=> __( 'Sort by price (asc)','wpsdeals' ),
																'price-desc'	=> __( 'Sort by price (desc)','wpsdeals' )
															);
										$default_orderby = apply_filters( 'wps_deals_orderby_settings_options', $default_orderby ); 
									?>
									<select id="wps_deals_options[default_deals_orderby]" name="wps_deals_options[default_deals_orderby]">
										<option value=""><?php _e('--Select A Order--','wpsdeals');?></option>
										<?php foreach ( $default_orderby as $orderby_key => $orderby_value ) { ?>
											<option value="<?php echo $orderby_key;?>" <?php selected( $orderby_key, $wps_deals_options['default_deals_orderby'], true ); ?>><?php echo $orderby_value;?></option>
										<?php } ?>
									</select><br />
									<span class="description"><?php _e('Choose the default sorting for the Deals listing page.','wpsdeals');?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label><?php _e( 'Social Connect Buttons:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<?php 
										$socialbuttons = array(
																'facebook'	=> __( 'Facebook','wpsdeals' ),
																'twitter'	=> __( 'Twitter','wpsdeals' ),
																'google'	=> __( 'Google+','wpsdeals' )
															);
										$socialbuttons = apply_filters('wps_deals_social_settings_options',$socialbuttons); 
										
										foreach ($socialbuttons as $key => $value ) {
									?>
											<input type="checkbox" name="wps_deals_options[social_buttons][]" id="wps_deals_options_<?php echo $key;?>" value="<?php echo $key;?>" <?php if ( isset( $wps_deals_options['social_buttons'] ) && in_array($key,$wps_deals_options['social_buttons']) ) { echo 'checked="checked"';} ?> />
											<label for="wps_deals_options_<?php echo $key;?>"><?php echo $value; ?></label><br />
									<?php } ?>
									<span class="description"><?php _e( 'Choose which social sharing buttons you want to display.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[tw_user_name]"><?php _e( 'Twitter Username:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="text" id="wps_deals_options[tw_user_name]" name="wps_deals_options[tw_user_name]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['tw_user_name']);?>" class="large-text"/><br />
									<span class="description"><?php _e('Enter your Twitter Username.','wpsdeals');?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[enable_lightbox]"><?php _e( 'Enable Lightbox Image Gallery:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="checkbox" id="wps_deals_options[enable_lightbox]" name="wps_deals_options[enable_lightbox]" value="1" <?php if(isset($wps_deals_options['enable_lightbox'])) { checked('1',$wps_deals_options['enable_lightbox']); }?>/><br />
									<span class="description"><?php _e( 'Include Social Deals Engine lightbox. Deals gallery images will open in a lightbox.', 'wpsdeals' );?></span>
								</td>
							</tr>
							
							<?php do_action('wps_deals_add_general_settings_after_socialbuttons');?>
							
							<!-- Page Settings Start -->
							<tr>
								<th colspan="2" valign="top" scope="row">
									<span class="wps-deals-settings-sep-first"><?php _e( 'Pages Settings', 'wpsdeals' ); ?></span>
								</th>
							</tr>
							<tr>
								<th scope="row">
									<label for="wps_deals_options[deals_main_page]"><?php _e( 'Deals Overview / Home Page:', 'wpsdeals' );?></label>
								</th>
								<td>
									<select id="wps_deals_options[deals_main_page]" name="wps_deals_options[deals_main_page]">
										<option value=""><?php _e('--Select A Page--','wpsdeals');?></option>
										<?php foreach ( $get_pages as $page ) { ?>
												<option value="<?php echo $page->ID;?>" <?php selected( $page->ID, $wps_deals_options['deals_main_page'], true ); ?>><?php _e( $page->post_title );?></option>
										<?php } ?>
									</select><br />
									<span class="description"><?php _e( 'This is the Deals Overview / Home Page whcih does show all Deals you enabled to show on the Homepage.<br />Shortcode required on this page: [wps_deals]', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[payment_checkout_page]"><?php _e( 'Checkout Page:', 'wpsdeals' );?></label>
								</th>
								<td>
									<select id="wps_deals_options[payment_checkout_page]" name="wps_deals_options[payment_checkout_page]">
										<option value=""><?php _e('--Select A Page--','wpsdeals');?></option>
										<?php foreach ( $get_pages as $page ) { ?>
												<option value="<?php echo $page->ID;?>" <?php selected( $page->ID, $wps_deals_options['payment_checkout_page'], true );?>><?php _e( $page->post_title );?></option>
										<?php } ?>
									</select><br />
									<span class="description"><?php _e( 'This is the checkout page where buyers will complete their purchases.<br />Shortcode required on this page: [wps_deals_checkout]', 'wpsdeals' ); ?></span>
								</td>
							</tr>														
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[my_account_page]"><?php _e( 'My Account Page:', 'wpsdeals');?></label>
								</th>
								<td>	
									<select id="wps_deals_options[my_account_page]" name="wps_deals_options[my_account_page]">
										<option value=""><?php _e( '--Select A Page--', 'wpsdeals' );?></option>
										<?php foreach ($get_pages as $page) { ?>
												<option value="<?php echo $page->ID;?>" <?php selected( $page->ID, $wps_deals_options['my_account_page'], true );?>><?php _e( $page->post_title );?></option>
										<?php } ?>
									</select><br />
									<span class="description"><?php _e( 'This is the my account page where buyers will see all details for their account.<br />Shortcode required on this page: [wps_deals_my_account]', 'wpsdeals' ); ?></span>
								</td>
							</tr>														
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[shop_page]"><?php _e( 'Deals Shop Page:', 'wpsdeals');?></label>
								</th>
								<td>	
									<select id="wps_deals_options[shop_page]" name="wps_deals_options[shop_page]">
										<option value=""><?php _e( '--Select A Page--', 'wpsdeals' );?></option>
										<?php foreach ($get_pages as $page) { ?>
												<option value="<?php echo $page->ID;?>" <?php selected( $page->ID, $wps_deals_options['shop_page'], true );?>><?php _e( $page->post_title );?></option>
										<?php } ?>
									</select><br />
									<span class="description"><?php _e( 'This is the deals shop page where buyers can see all deals.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							<?php
							
									//do action to add some settings after page settings
									do_action('wps_deals_add_general_settings_pages_after');
							?>
							<!-- Page Settings End-->
							<!-- Currency Settings Start -->
							<tr>
								<th colspan="2" valign="top" scope="row">
									<span class="wps-deals-settings-sep-first"><?php _e( 'Currency Settings', 'wpsdeals' ); ?></span>
								</th>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[currency]"><?php _e( 'Currency:', 'wpsdeals');?></label>
								</th>
								<td>
									<?php $currencies = wps_deals_currency_data();?>
										<select id="wps_deals_options[currency]" name="wps_deals_options[currency]">
											<?php	foreach ( $currencies as $key => $value ) { ?>
														<option value="<?php echo $key;?>" <?php selected( $key, $wps_deals_options['currency'], true );?>><?php echo $value;?></option>		
											<?php	} ?>
										</select><br />
									<span class="description"><?php _e( 'Choose your currency. Note that some payment gateways have currency restrictions.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[currency_position]"><?php _e( 'Currency Sign Position:', 'wpsdeals');?></label>
								</th>
								<td>
									<select id="wps_deals_options[currency_position]" name="wps_deals_options[currency_position]">
										<option value="before" <?php selected( 'before', $wps_deals_options['currency_position'], true );?>><?php _e('Before - $10','wpsdeals');?></option>
										<option value="after" <?php selected( 'after', $wps_deals_options['currency_position'], true );?>><?php _e('After - 10$','wpsdeals');?></option>
									</select><br />
									<span class="description"><?php _e( 'Choose the location of the currency sign.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="wps_deals_options[thounsands_seperator]"><?php _e( 'Thousands Separator:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="text" id="wps_deals_options[thounsands_seperator]" name="wps_deals_options[thounsands_seperator]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['thounsands_seperator']);?>" class="small-text"/><br />
									<span class="description"><?php _e('The symbol (usually , or .) to separate thousands.','wpsdeals');?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[decimal_seperator]"><?php _e( 'Decimal Separator:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="text" id="wps_deals_options[decimal_seperator]" name="wps_deals_options[decimal_seperator]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['decimal_seperator']);?>" class="small-text"/><br />
									<span class="description"><?php _e('The symbol (usually , or .) to separate decimal points.','wpsdeals');?></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[decimal_places]"><?php _e( 'Decimal Places:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="text" id="wps_deals_options[decimal_places]" name="wps_deals_options[decimal_places]" value="<?php echo $model->wps_deals_escape_attr($wps_deals_options['decimal_places']);?>" class="small-text"/><br />
									<span class="description"><?php _e('Number of decimal places.','wpsdeals');?></span>
								</td>
							</tr>
							<!-- Currency Settings End -->
							
							<!-- Endpoints Settings Start -->
							<tr>
								<th colspan="2" valign="top" scope="row">
									<span class="wps-deals-settings-sep-first"><?php _e( 'Deals Endpoints', 'wpsdeals' ); ?></span>
								</th>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[deals_thank_you_page_endpoint]"><?php _e( 'Deals Thank You Page:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[deals_thank_you_page_endpoint]" id="wps_deals_options[deals_thank_you_page_endpoint]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['deals_thank_you_page_endpoint']);?>" class="regular-text" /><br />
									<span class="description"><?php _e( 'Endpoint for the Deals Thank you page', 'wpsdeals' ); ?></span>  
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[deals_cancel_page_endpoint]"><?php _e( 'Deals Cancel Page:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[deals_cancel_page_endpoint]" id="wps_deals_options[deals_cancel_page_endpoint]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['deals_cancel_page_endpoint']);?>" class="regular-text" /><br />
									<span class="description"><?php _e( 'Endpoint for the Deals Cancel Page.', 'wpsdeals' ); ?></span>  
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[edit_account_endpoint]"><?php _e( 'Edit Account:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[edit_account_endpoint]" id="wps_deals_options[edit_account_endpoint]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['edit_account_endpoint']);?>" class="regular-text" /><br />
									<span class="description"><?php _e( 'Endpoint for the Edit Account page.', 'wpsdeals' ); ?></span>  
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="wps_deals_options[edit_address_endpoint]"><?php _e( 'Edit Address:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[edit_address_endpoint]" id="wps_deals_options[edit_address_endpoint]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['edit_address_endpoint']);?>" class="regular-text" /><br />
									<span class="description"><?php _e( 'Endpoint for the Edit Address page.', 'wpsdeals' ); ?></span>  
								</td>
							</tr>							
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[lost_password_endpoint]"><?php _e( 'Lost Password:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[lost_password_endpoint]" id="wps_deals_options[lost_password_endpoint]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['lost_password_endpoint']);?>" class="regular-text" /><br />
									<span class="description"><?php _e( 'Endpoint for the Lost Password page.', 'wpsdeals' ); ?></span>  
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="wps_deals_options[view_orders_endpoint]"><?php _e( 'View Orders:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[view_orders_endpoint]" id="wps_deals_options[view_orders_endpoint]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['view_orders_endpoint']);?>" class="regular-text" /><br />
									<span class="description"><?php _e( 'Endpoint for the View Orders page.', 'wpsdeals' ); ?></span>  
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="wps_deals_options[create_an_account_endpoint]"><?php _e( 'Create an Account:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[create_an_account_endpoint]" id="wps_deals_options[create_an_account_endpoint]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['create_an_account_endpoint']);?>" class="regular-text" /><br />
									<span class="description"><?php _e( 'Endpoint for the Create an Account page.', 'wpsdeals' ); ?></span>  
								</td>
							</tr>
							<!-- Endpoints Settings End-->
							<?php do_action('wps_deals_add_general_settings_after');?>
							<tr>
								<td colspan="2" valign="top" scope="row">
									<input type="submit" id="wps-deals-settings-submit" name="wps-deals-settings-submit" class="button-primary" value="<?php _e('Save Changes','wpsdeals');?>" />
								</td>
							</tr>
							
						</tbody>
					 </table>
					 
				</div><!-- .inside -->
			</div><!-- #general -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #wps-deals-general -->