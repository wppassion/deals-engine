<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Deals Images
 *
 * Display the Delas images meta box.
 *
 * @package Social Deals Engine
 * @since 2.4.5
 */

/**
 * Wps_Meta_Box_Deals_Images Class
 */
class Wps_Meta_Box_Deals_Images {

	/**
	 * Output the metabox
	 */
	public static function output( $post ) {
		?>
		<div id="wps_deals_images_container">
			<ul class="wps_deals_images">
				<?php
					
					$prefix = WPS_DEALS_META_PREFIX;
					
					if ( metadata_exists( 'post', $post->ID, $prefix . 'image_gallery' ) ) {
						$wps_deals_image_gallery = get_post_meta( $post->ID, $prefix . 'image_gallery', true );
					} else {
						// Backwards compat
						$attachment_ids = get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids&meta_key=_deals_exclude_image&meta_value=0' );
						$attachment_ids = array_diff( $attachment_ids, array( get_post_thumbnail_id() ) );
						$wps_deals_image_gallery = implode( ',', $attachment_ids );
					}

					$attachments = array_filter( explode( ',', $wps_deals_image_gallery ) );

					if ( ! empty( $attachments ) ) {
						foreach ( $attachments as $attachment_id ) {
							echo '<li class="image" data-attachment_id="' . esc_attr( $attachment_id ) . '">
								' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
								<ul class="actions">
									<li><a href="#" class="delete tips" data-tip="' . esc_attr__( 'Delete image', 'wpsdeals' ) . '">' . __( 'Delete', 'wpsdeals' ) . '</a></li>
								</ul>
							</li>';
						}
					}
				?>
			</ul>

			<input type="hidden" id="wps_deals_image_gallery" name="wps_deals_image_gallery" value="<?php echo esc_attr( $wps_deals_image_gallery ); ?>" />

		</div>
		<p class="add_wps_deals_images hide-if-no-js">
			<a href="#" data-choose="<?php esc_attr_e( 'Add Images to Deals Gallery', 'wpsdeals' ); ?>" data-update="<?php esc_attr_e( 'Add to gallery', 'wpsdeals' ); ?>" data-delete="<?php esc_attr_e( 'Delete image', 'wpsdeals' ); ?>" data-text="<?php esc_attr_e( 'Delete', 'wpsdeals' ); ?>"><?php _e( 'Add Deals gallery images', 'wpsdeals' ); ?></a>
		</p>
		<?php
	}

	
	/**
	 * Save meta box data
	 */
	public static function save( $post_id, $post ) {
		 
		$attachment_ids = isset( $_POST['wps_deals_image_gallery'] ) ? array_filter( explode( ',', wp_clean( $_POST['wps_deals_image_gallery'] ) ) ) : array();

		update_post_meta( $post_id, '_wps_deals_image_gallery', implode( ',', $attachment_ids ) );
	}
}