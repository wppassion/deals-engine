<?php
/**
 * Addons Page
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// get current view
$view 	= isset( $_GET['view'] ) ? sanitize_text_field( $_GET['view'] ) : '';

// initialize addons variable that contails all extension list
$addons = "";

if ( false === ( $addons = get_transient( 'wps_deals_addons_data' ) ) ) {

	$addons_json = wp_safe_remote_get( 'http://d3uu5ojhk0n2mi.cloudfront.net/wpsocial/Deals/social-deals-engine-addons.json', array( 'user-agent' => 'Social Deals Engine Addons Page' ) );
	
	if ( ! is_wp_error( $addons_json ) ) {

		$addons = json_decode( wp_remote_retrieve_body( $addons_json ) );
	
		if ( $addons ) {
			set_transient( 'wps_deals_addons_data', $addons, WEEK_IN_SECONDS );
		}
	} 
} ?>

<div class="wrap">
	<h2><?php echo __('Extensions for Social Deal Engine', 'wpsdeals') ?></h2>
	
	<?php
	if ( $addons ) : ?>

		<ul class="subsubsub">
			<?php
				$links = array(
					'extensions'	=> __( 'Social Deals Engine Extensions', 'wpsdeals' ),
					'themes'		=> __( 'Themes', 'wpsdeals' ),
				);
	
				$i = 0;
				foreach ( $links as $link => $name ) {
					$i ++;
					$page_url = add_query_arg( array('post_type' => 'wpsdeals', 'page' => 'wps-deals-extensions', 'view' => esc_attr( $link )), admin_url('edit.php') );
					?><li><a class="<?php if ( $view == $link ) echo 'current'; ?>" href="<?php echo $page_url; ?>"><?php echo $name; ?></a><?php if ( $i != sizeof( $links ) ) echo ' |'; ?></li><?php
				}
			?>
		</ul>
		<br class="clear" />
	
		<div class="wrap wpsocialdeals wps_addons_wrap">
			</ul>
				<br class="clear" />
				<ul class="products">
					<?php
					
					switch ( $view ) {
						case '':
							$addons = $addons->extensions;
						break;
						case 'extensions':
							$addons = $addons->{'extensions'};
						break;
						case 'themes':
							$addons = $addons->{'themes'};
							break;
					}
				
				
					foreach ( $addons as $addon ) {
					echo '<li class="product">';
					
						echo '<h3>' . $addon->title . '</h3>';	
					
						if ( ! empty( $addon->image ) ) {
							echo '<a href="' . $addon->url . '" class="wps_ext_img_link" target="_Blank">';
								echo '<img src="' . $addon->image . '"/>';
							echo '</a>';
						}
						
						echo '<a href="' . $addon->url . '" class="button-secondary" target="_Blank">' . __('Get this Extension', 'wpsdeals') . '</a>';
						
					echo '</li>';
				}
			?>
			</ul>
		</div>
	<?php else : ?>
		<p><?php echo sprintf( __( 'Our catalog of Social Deals Engine Extensions can be found on wpsocial.com here: <a href="%s">Social Deals Engine Extensions Catalog</a>', 'woocommerce' ), 'http://wpsocial.com/shop/' ); ?></p>
	<?php endif; ?>
</div> <!-- End .wrap -->