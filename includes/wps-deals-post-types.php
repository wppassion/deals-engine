<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Post Type Functions
 *
 * Handles all custom post types
 * 
 * @package Social Deals Engine
 * @since 1.0.0 
 */

/**
 * Setup Deals Post Type
 *
 * Registers the Deals Post Types
 * 
 * @package Social Deals Engine
 * @since 1.0.0 
 */
function wps_deals_register_deal_post_type() {
	 
	//array for all required labels
	$deals_labels =  array(
								'name' 				=> __('Deals','wpsdeals'),
								'singular_name' 	=> __('Deal','wpsdeals'),
								'add_new' 			=> __('Add New', 'wpsdeals'),
								'add_new_item' 		=> __('Add New Deal', 'wpsdeals'),
								'edit_item' 		=> __('Edit Deal', 'wpsdeals'),
								'new_item' 			=> __('New Deal', 'wpsdeals'),
								'all_items' 		=> __('All Deals', 'wpsdeals'),
								'view_item' 		=> __('View Deal', 'wpsdeals'),
								'search_items' 		=> __('Search Deal', 'wpsdeals'),
								'not_found' 		=> __('No deals found', 'wpsdeals'),
								'not_found_in_trash'=> __('No deals found in Trash', 'wpsdeals'), 
								'parent_item_colon' => '',
								'menu_name' 		=> __('Deals', 'wpsdeals')
							);
							
	//array for all required labels
	$deals_args = array(
							'labels' 			=> $deals_labels,
							'public' 			=> true,
							'publicly_queryable'=> true,
							'show_ui' 			=> true,
							'map_meta_cap'      => true,
							'show_in_menu' 		=> true, 
							'query_var' 		=> true,
							'rewrite' 			=> array( 'slug' => WPS_DEALS_POST_TYPE_SLUG),
							'capability_type' 	=> WPS_DEALS_POST_TYPE, //'post',
							'has_archive' 		=> true,
							'supports' 			=> apply_filters('wps_deals_post_type_supports', array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' )),
							'menu_icon'			=> WPS_DEALS_URL . 'includes/images/wps-icon.png'
						);
	 
	//Add filter to modify deals register post type arguments
	$deals_args	= apply_filters( 'wps_deals_register_post_type_deals', $deals_args );
	
	//register deals post type
	register_post_type( WPS_DEALS_POST_TYPE, $deals_args );
	
}
//register deals post type
add_action( 'init','wps_deals_register_deal_post_type' );

/**
 * Setup Deals Sales Post Type
 *
 * Registers the Deals Sales Post Types
 * 
 * @package Social Deals Engine
 * @since 1.0.0 
 **/
function wps_deals_register_sales_post_types() {
	
	//deals sales post type
	$sales_labels = array(
						    'name'				=> __('Sales','wpsdeals'),
						    'singular_name' 	=> __('Sale','wpsdeals'),
						    'add_new' 			=> __('Add New','wpsdeals'),
						    'add_new_item' 		=> __('Add New Sale','wpsdeals'),
						    'edit_item' 		=> __('Edit Sale','wpsdeals'),
						    'new_item' 			=> __('New Sale','wpsdeals'),
						    'all_items' 		=> __('All Sales','wpsdeals'),
						    'view_item' 		=> __('View Sale','wpsdeals'),
						    'search_items' 		=> __('Search Sale','wpsdeals'),
						    'not_found' 		=> __('No sales found','wpsdeals'),
						    'not_found_in_trash'=> __('No sales found in Trash','wpsdeals'),
						    'parent_item_colon' => '',
						    'menu_name' 		=> __('Sales','wpsdeals'),
						);
	$sales_args = array(
						    'labels' 				=> $sales_labels,
						    'public' 				=> false,
						    'publicly_queryable'	=> true, 
						    'query_var' 			=> true,
						    'rewrite' 				=> false,
						    'capability_type' 		=> WPS_DEALS_POST_TYPE, //'post',
						    'supports' 				=> array( 'title' )
					 	); 
	
	//Add filter to modify sales register post type arguments
	$sales_args	= apply_filters( 'wps_deals_register_post_type_slaes', $sales_args );
	
	//register deals sales post type
	register_post_type( WPS_DEALS_SALES_POST_TYPE, $sales_args );
}
//register deals sales post type
// we need to keep priority 100, because we need to execute this init action after all other init action called, only when hidden post type is need to created.
add_action( 'init','wps_deals_register_sales_post_types', 100 );


/**
 * Message Filter
 *
 * Add filter to ensure the text Review, or review, 
 * is displayed when a user updates a custom post type.
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */  
function wps_deals_updated_messages( $messages ) {
		
	global $post, $post_ID;

	$messages[WPS_DEALS_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Deal updated. <a href="%s">View Deal</a>', 'wpsdeals' ), esc_url( get_permalink($post_ID) ) ),
		2 => __( 'Custom field updated.', 'wpsdeals' ),
		3 => __( 'Custom field deleted.', 'wpsdeals' ),
		4 => __( 'Deal updated.', 'wpsdeals' ),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __( 'Deal restored to revision from %s', 'wpsdeals' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Deal published. <a href="%s">View Deal</a>', 'wpsdeals' ), esc_url( get_permalink($post_ID) ) ),
		7 => __( 'Deal saved.', 'wpsdeals' ),
		8 => sprintf( __( 'Deal submitted. <a target="_blank" href="%s">Preview Deal</a>', 'wpsdeals' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __( 'Deal scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Review</a>', 'wpsdeals'),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' , 'wpsdeals' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __( 'Deal draft updated. <a target="_blank" href="%s">Preview Deal</a>', 'wpsdeals' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);

	return $messages;
}
	
add_filter( 'post_updated_messages', 'wps_deals_updated_messages' );


/**
 * Custom Icon
 *
 * Styling for the custom post type icon.
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */ 
function wps_deals_icon() {
	
    ?>
		<style type="text/css" media="screen">
			#icon-edit.icon32-posts-<?php echo WPS_DEALS_POST_TYPE;?>	 {background: url(<?php echo WPS_DEALS_URL; ?>includes/images/wps-logo.png) no-repeat; width:123px; height:38px;}
		</style>
<?php
}

add_action( 'admin_head', 'wps_deals_icon' );

/**
 * Get Default Labels
 *
 * @package Social Deals Engine
 * @since 1.0.0
 * @return array $defaults Default labels
 */
function wps_get_default_labels() {
	$defaults = array(
	   'singular' => __( 'Deal', 'wpsdeals' ),
	   'plural' => __( 'Deals', 'wpsdeals')
	);
	return apply_filters( 'wps_default_deals_name', $defaults );
}

/**
 * Get Singular Label
 *
 * @package Social Deals Engine
 * @since 1.0.0
 * 
 * @param bool $lowercase
 * @return string $defaults['singular'] Singular label
 */
function wps_get_label_singular( $lowercase = false ) {
	$defaults = wps_get_default_labels();
	return ($lowercase) ? strtolower( $defaults['singular'] ) : $defaults['singular'];
}

/**
 * Get Plural Label
 *
 * @package Social Deals Engine
 * @since 1.0.0
 * 
 * @param bool $lowercase
 * @return string $defaults['plural'] Plural label
 */
function wps_get_label_plural( $lowercase = false ) {
	$defaults = wps_get_default_labels();
	return ( $lowercase ) ? strtolower( $defaults['plural'] ) : $defaults['plural'];
}

/**
 * Setup Deals Post Type's Taxonomy
 *
 * Registers taxonomies for custom post types
 * 
 * @package Social Deals Engine
 * @since 1.0.0 
 */

function wps_deals_register_taxonomies() {
	
  //register taxonomy tags for deals
	 $taglabels = array(
						    'name' => sprintf( _x( '%s Tags', 'taxonomy general name','wpsdeals' ), wps_get_label_singular() ),
						    'singular_name' => _x( 'Tag', 'taxonomy singular name' ,'wpsdeals'),
						    'search_items' =>  __( 'Search Tags','wpsdeals' ),
						    'popular_items' => __( 'Popular Tags','wpsdeals' ),
						    'all_items' => __( 'All Tags','wpsdeals' ),
						    'parent_item' => null,
						    'parent_item_colon' => null,
						    'edit_item' => __( 'Edit Tag','wpsdeals' ), 
						    'update_item' => __( 'Update Tag','wpsdeals' ),
						    'add_new_item' => __( 'Add New Tag' ,'wpsdeals'),
						    'new_item_name' => __( 'New Tag Name' ,'wpsdeals'),
						    'separate_items_with_commas' => __( 'Separate tags with commas','wpsdeals' ),
						    'add_or_remove_items' => __( 'Add or remove tags','wpsdeals' ),
						    'choose_from_most_used' => __( 'Choose from the most used tags','wpsdeals' ),
						    'menu_name' => __( 'Tags','wpsdeals' ),
					  ); 
	
	 $dealstags = array(
						    'hierarchical' 			=> false,
						    'labels' 				=> $taglabels,
						    'show_ui' 				=> true,
						    'show_admin_column' 	=> true,
						    'update_count_callback' => '_update_post_term_count',
						    'query_var' 			=> true,
						    'rewrite' 				=> array( 'slug' => WPS_DEALS_POST_TAGS, 'with_front' => false ),
						    'capabilities'			=> array(
												            	'manage_terms' 		=> 'manage_'.WPS_DEALS_POST_TYPE.'_terms',
																'edit_terms' 		=> 'edit_'.WPS_DEALS_POST_TYPE.'_terms',
																'delete_terms' 		=> 'delete_'.WPS_DEALS_POST_TYPE.'_terms',
																'assign_terms' 		=> 'assign_'.WPS_DEALS_POST_TYPE.'_terms',
												            )
					  );
					  
					  
	  register_taxonomy( WPS_DEALS_POST_TAGS, WPS_DEALS_POST_TYPE, $dealstags);
	
	
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
				    'name' 				=>	sprintf( _x( ' %s Categories', 'taxonomy general name', 'wpsdeals'), wps_get_label_singular() ),
				    'singular_name' 	=>	_x( 'Category', 'taxonomy singular name','wpsdeals' ),
				    'search_items'		=>	__( 'Search Categories','wpsdeals' ),
				    'all_items'			=>	__( 'All Categories','wpsdeals' ),
				    'parent_item'		=>	__( 'Parent Category','wpsdeals' ),
				    'parent_item_colon' =>	__( 'Parent Category:','wpsdeals' ),
				    'edit_item' 		=>	__( 'Edit Category' ,'wpsdeals'), 
				    'update_item' 		=>	__( 'Update Category' ,'wpsdeals'),
				    'add_new_item' 		=>	__( 'Add New Category' ,'wpsdeals'),
				    'new_item_name' 	=>	__( 'New Category Name' ,'wpsdeals'),
				    'menu_name' 		=>	__( 'Categories' ,'wpsdeals')
				  );
				  
	$args = array(
					'hierarchical' 		=> true,
					'labels' 			=> $labels,
					'show_ui' 			=> true,
					'show_admin_column' => true,
					'query_var' 		=> true,
					'rewrite' 			=> array( 'slug' => 'deal-category', 'with_front' => false ),
					'capabilities'		=> array(
									            	'manage_terms' 		=> 'manage_'.WPS_DEALS_POST_TYPE.'_terms',
													'edit_terms' 		=> 'edit_'.WPS_DEALS_POST_TYPE.'_terms',
													'delete_terms' 		=> 'delete_'.WPS_DEALS_POST_TYPE.'_terms',
													'assign_terms' 		=> 'assign_'.WPS_DEALS_POST_TYPE.'_terms',
									            )
				);
	
	register_taxonomy(WPS_DEALS_POST_TAXONOMY,WPS_DEALS_POST_TYPE,$args);
	
	//do action for registering taxonomy
	do_action( 'wps_deals_register_taxonomies' );
}

//register taxonomies (categories) for custom post type
add_action( 'init','wps_deals_register_taxonomies' );
/**
 * Filter By Category
 * 
 * Handles to filter the data by category
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 **/
function wps_deals_restrict_manage_posts() {
	
	global $typenow, $wp_query, $wps_deals_model;

	$prefix = WPS_DEALS_META_PREFIX;
	
	if ( $typenow == WPS_DEALS_POST_TYPE ) {
		
		$html = '';
		
		$terms = get_terms( WPS_DEALS_POST_TAXONOMY );
		
		if ( $terms ) {

			$html .= '<select name="wps_deals_category" id="wps_deals_category">';
			
			$html .= '<option value="" ' .  selected( isset( $_GET['wps_deals_category'] ) ? $_GET['wps_deals_category'] : '', '', false ) . '>'.__( 'Select a category', 'wpsdeals' ).'</option>';
	
			foreach ( $terms as $term ) {
				
				if( isset($_GET[WPS_DEALS_POST_TAXONOMY]) && $_GET[WPS_DEALS_POST_TAXONOMY] == $term->slug ) {
					
					$_GET['wps_deals_category'] = $term->term_taxonomy_id;
				}
				
				$term_count = ' (' . $term->count . ')';
				$html .= '<option value="' . $term->term_taxonomy_id . '" ' . selected( isset( $_GET['wps_deals_category'] ) ? $_GET['wps_deals_category'] : '', $term->term_taxonomy_id, false ) . '>' . $term->name . $term_count . '</option>';
			}
		
			$html .= '</select>';
			
		}
		
		$deal_types = $wps_deals_model->wps_deals_get_deal_types();
		
		$html .= '<select id="wps_deals_type" name="wps_deals_type">';
		
		$html .= '<option value="">'.__( 'Show all deal types', 'wpsdeals' ).'</option>';
		
		foreach ( $deal_types as $deal_key => $deal_type ) {
			
			$type_args = array(
							'meta_key'         => $prefix . 'type',
							'meta_value'       => $deal_key,
							'post_type'        => WPS_DEALS_POST_TYPE,
							'post_status'      => 'publish'
						);
				
			$deal_type_count = get_posts( $type_args );
			
			if( count( $deal_type_count ) > 0 ) {
			
				$deal_type_count = ' (' . count( $deal_type_count ) . ')';
				$html .= '<option value="' . $deal_key . '" ' . selected( isset( $_GET['wps_deals_type'] ) ? $_GET['wps_deals_type'] : '', $deal_key, false ) . '>' . $deal_type . $deal_type_count . '</option>';
			}
		}
	
		$html .= '</select>';
		
		echo $html;
    }
}

// Add category filter in deals list page
add_action( 'restrict_manage_posts','wps_deals_restrict_manage_posts' );
/**
 * Categorywise Search
 * 
 * Handles to show categorywise search
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 **/
function wps_deals_category_search( $where ) {

	if( is_admin() ) {
		global $wpdb;
		
		if ( isset( $_GET['wps_deals_category'] ) && !empty( $_GET['wps_deals_category'] ) && intval( $_GET['wps_deals_category'] ) != 0 ) {
			
			$deal_category = intval( $_GET['wps_deals_category'] );
		
			$where .= " AND ID IN ( SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id=$deal_category )";
		}
	}
	return $where;
}

// Add filter for display deals using category
add_filter( 'posts_where' , 'wps_deals_category_search' );

/**
 * Typewise Search
 * 
 * Handles to show typewise search
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 **/
function wps_deals_type_search( $query ) {
	
	$prefix = WPS_DEALS_META_PREFIX;
	
	if ( isset( $_GET['wps_deals_type'] ) && !empty( $_GET['wps_deals_type'] ) ) {
		
	    if ( $query->is_main_query() ) {
	    	
	        $query->set( 'meta_key', $prefix . 'type' );
	        $query->set( 'meta_value', $_GET['wps_deals_type'] );
	    }
	}
}
// Add action for display deals using deal type
add_action( 'pre_get_posts', 'wps_deals_type_search' ); ?>