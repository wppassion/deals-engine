<?php

/**
 * Add Social Settings
 * 
 * Handles to add social settings
 * for facebook,twitter,google+,linkedin etc.
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
?>

<!-- beginning of the facebook settings meta box -->
<div id="wps-deals-facebook" class="post-box-container">
	<div class="metabox-holder">	
		<div class="meta-box-sortables ui-sortable">
			<div id="facebook" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsdeals' ); ?>"><br /></div>

					<!-- facebook settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Facebook Settings', 'wpsdeals' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							<?php 
									//action to add settings before facebook settings
									do_action('wps_deals_social_facebook_before');
							?>
							<tr>
								<th scope="row">
									<label for="wps_deals_options[enable_facebook]"><?php _e( 'Enable Facebook:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="checkbox" id="wps_deals_options[enable_facebook]" name="wps_deals_options[enable_facebook]" value="1" <?php if( isset( $wps_deals_options['enable_facebook'] ) ) { checked( '1', $wps_deals_options['enable_facebook'], true ); }?> /><br />
									<span class="description"><?php _e( 'Check to enable Facebook for the social checkout.','wpsdeals' ); ?></span>
								</td>
							</tr>
							
							 <tr valign="top">
								<th scope="row">
									<label><?php _e( 'Facebook App:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<p><strong><?php _e( 'If you already created a Facebook Application for this site, then you can use the same App ID/API Key and App Secret here.', 'wpsdeals' ); ?></strong></p> 
									<p><?php _e( 'You can get a step by step tutorial on how to create a Facebook Application on our <a href="http://wpsocial.com/knowledgebase/" target="_blank">Knowledge Base</a>.', 'wpsdeals' ); ?></p>
								</td>
							</tr> 
							<?php 
									//action to add settings after facebook desc settings
									do_action('wps_deals_social_facebook_after_desc');
							?>
							<tr>
								<th scope="row">
									<label for="wps_deals_options[fb_app_id]"><?php _e( 'Facebook API Key:', 'wpsdeals' ); ?></label>
								</th>
								<td><input type="text" id="wps_deals_options[fb_app_id]" name="wps_deals_options[fb_app_id]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['fb_app_id'] );?>" class="large-text"/>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[fb_app_secret]"><?php _e( 'Facebook App Secret:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[fb_app_secret]" id="wps_deals_options[fb_app_secret]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['fb_app_secret'] ); ?>" class="large-text" />
								</td>
							</tr> 
										
							<tr valign="top">
								<th scope="row"><label for="wps_deals_options[fb_language]"><?php _e( 'Facebook API Locale:', 'wpsdeals' ); ?></label></th>
								<td>
									<select id="wps_deals_options[fb_language]" name="wps_deals_options[fb_language]">
										<?php   												
											$select_fblanguage = array( 'en_US' => __( 'English', 'wpsdeals' ), 'af_ZA' => __( 'Afrikaans', 'wpsdeals' ), 'sq_AL' => __( 'Albanian', 'wpsdeals' ), 'ar_AR' => __( 'Arabic', 'wpsdeals' ), 'hy_AM' => __( 'Armenian', 'wpsdeals' ), 'eu_ES' => __( 'Basque', 'wpsdeals' ), 'be_BY' => __( 'Belarusian', 'wpsdeals' ), 'bn_IN' => __( 'Bengali', 'wpsdeals' ), 'bs_BA' => __( 'Bosanski', 'wpsdeals' ), 'bg_BG' => __( 'Bulgarian', 'wpsdeals' ), 'ca_ES' => __( 'Catalan', 'wpsdeals' ), 'zh_CN' => __( 'Chinese', 'wpsdeals' ), 'cs_CZ' => __( 'Czech', 'wpsdeals' ), 'da_DK' => __( 'Danish', 'wpsdeals' ), 'fy_NL' => __( 'Dutch', 'wpsdeals' ), 'eo_EO' => __( 'Esperanto', 'wpsdeals' ), 'et_EE' => __( 'Estonian', 'wpsdeals' ), 'et_EE' => __( 'Estonian', 'wpsdeals' ), 'fi_FI' => __( 'Finnish', 'wpsdeals' ), 'fo_FO' => __( 'Faroese', 'wpsdeals' ), 'tl_PH' => __( 'Filipino', 'wpsdeals' ), 'fr_FR' => __( 'French', 'wpsdeals' ), 'gl_ES' => __( 'Galician', 'wpsdeals' ), 'ka_GE' => __( 'Georgian', 'wpsdeals' ), 'de_DE' => __( 'German', 'wpsdeals' ), 'zh_CN' => __( 'Greek', 'wpsdeals' ), 'he_IL' => __( 'Hebrew', 'wpsdeals' ), 'hi_IN' => __( 'Hindi', 'wpsdeals' ), 'hr_HR' => __( 'Hrvatski', 'wpsdeals' ), 'hu_HU' => __( 'Hungarian', 'wpsdeals' ), 'is_IS' => __( 'Icelandic', 'wpsdeals' ), 'id_ID' => __( 'Indonesian', 'wpsdeals' ), 'ga_IE' => __( 'Irish', 'wpsdeals' ), 'it_IT' => __( 'Italian', 'wpsdeals' ), 'ja_JP' => __( 'Japanese', 'wpsdeals' ), 'ko_KR' => __( 'Korean', 'wpsdeals' ), 'ku_TR' => __( 'Kurdish', 'wpsdeals' ), 'la_VA' => __( 'Latin', 'wpsdeals' ), 'lv_LV' => __( 'Latvian', 'wpsdeals' ), 'fb_LT' => __( 'Leet Speak', 'wpsdeals' ), 'lt_LT' => __( 'Lithuanian', 'wpsdeals' ), 'mk_MK' => __( 'Macedonian', 'wpsdeals' ), 'ms_MY' => __( 'Malay', 'wpsdeals' ), 'ml_IN' => __( 'Malayalam', 'wpsdeals' ), 'nl_NL' => __( 'Nederlands', 'wpsdeals' ), 'ne_NP' => __( 'Nepali', 'wpsdeals' ), 'nb_NO' => __( 'Norwegian', 'wpsdeals' ), 'ps_AF' => __( 'Pashto', 'wpsdeals' ), 'fa_IR' => __( 'Persian', 'wpsdeals' ), 'pl_PL' => __( 'Polish', 'wpsdeals' ), 'pt_PT' => __( 'Portugese', 'wpsdeals' ), 'pa_IN' => __( 'Punjabi', 'wpsdeals' ), 'ro_RO' => __( 'Romanian', 'wpsdeals' ), 'ru_RU' => __( 'Russian', 'wpsdeals' ), 'sk_SK' => __( 'Slovak', 'wpsdeals' ), 'sl_SI' => __( 'Slovenian', 'wpsdeals' ), 'es_LA' => __( 'Spanish', 'wpsdeals' ), 'sr_RS' => __( 'Srpski', 'wpsdeals' ), 'sw_KE' => __( 'Swahili', 'wpsdeals' ), 'sv_SE' => __( 'Swedish', 'wpsdeals' ), 'ta_IN' => __( 'Tamil', 'wpsdeals' ), 'te_IN' => __( 'Telugu', 'wpsdeals' ), 'th_TH' => __( 'Thai', 'wpsdeals' ), 'tr_TR' => __( 'Turkish', 'wpsdeals' ), 'uk_UA' => __( 'Ukrainian', 'wpsdeals' ), 'vi_VN' => __( 'Vietnamese', 'wpsdeals' ), 'cy_GB' => __( 'Welsh', 'wpsdeals' ), 'zh_TW' => __( 'Traditional Chinese Language', 'wpsdeals' ) );
															
											foreach ( $select_fblanguage as $key => $option ) {											
												?>
												<option value="<?php echo $model->wps_deals_escape_attr( $key ); ?>" <?php selected( $wps_deals_options['fb_language'], $key ); ?>>
													<?php esc_html_e( $option ); ?>
												</option>
												<?php
											}															
										?> 														
									</select><br />
									<span class="description"><?php _e( 'Select the language for Facebook. With this option, you can explicitly tell which language you want to use for communicating with Facebook.', 'wpsdeals' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[fb_icon_url]"><?php _e( 'Custom Facebook Icon:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									
									<input type="text" name="wps_deals_options[fb_icon_url]" id="wps_deals_fb_icon_url" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['fb_icon_url'] ); ?>" class="wps-deals-img-upload-input" />
									<input type="button" name="wps_deals_fb_icon_url_btn" id="wps_deals_icon_url" class="button-secondary wps-deals-image-upload" value="<?php _e( 'Upload Image', 'wpsdeals');?>"/> <br />
									<span class="description"><?php _e( 'If you want to use your own Facebook Icon, upload one here.', 'wpsdeals' ); ?></span>
									<?php 
										$fbiconurl = '';
										if( isset( $wps_deals_options['fb_icon_url'] ) && !empty( $wps_deals_options['fb_icon_url'] ) ) { 
											$fbiconurl = '<img src="'.$wps_deals_options['fb_icon_url'].'"/>';
										}
									?>
									<div class="wps-deals-img-view"><?php echo $fbiconurl;?></div>
								</td>
							</tr>
						
							<tr valign="top">
								<th scope="row">
									<label for="wps_deals_options[fb_redirect_url]"><?php _e( 'Redirect URL:', 'wpsdeals' ); ?></label>
								</th>
								<td>
									<input type="text" name="wps_deals_options[fb_redirect_url]" id="wps_deals_options[fb_redirect_url]" value="<?php echo $model->wps_deals_escape_attr( $wps_deals_options['fb_redirect_url'] ); ?>" class="large-text" /><br />
									<span class="description"><?php _e( 'Enter a redirect URL for users who don\'t grant extended permissions to your App. The URL must start with http://', 'wpsdeals' ); ?></span>   
								</td>
							</tr>
							
							<?php 
									//action to add settings after facebook settings
									do_action('wps_deals_social_facebook_after');
							?>
							<tr>
								<td colspan="2" valign="top" scope="row">
									<input type="submit" id="wps-deals-settings-submit" name="wps-deals-settings-submit" class="button-primary" value="<?php _e('Save Changes','wpsdeals');?>" />
								</td>
							</tr>
							
							</tbody>
						 </table>
					</div><!-- .inside -->
			</div><!-- #facebook -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #wps-deals-facebook -->