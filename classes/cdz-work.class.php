<?php

namespace cdzMultiPortfolios;

/*
 *	cdzClass: Work
 */

class cdz_Work {

	function __construct() {

		/*
		 *	Register Post type
		 */
		
		add_action( 'init', array( &$this, 'register_post_type' ) );

		/*
		 *	Post Updated Messages
		 */

		add_filter( 'post_updated_messages', array( &$this, 'post_updated_messages' ) );

		/*
		 *	Add Meta Boxes
		 */

		add_action( 'add_meta_boxes', array( &$this, 'add_meta_boxes' ) );

		/*
		 *	Save Meta
		 */
		
		add_action( 'save_post', array( &$this, 'save_meta' ), 1, 2 );

		/*
		 *	Manage CPT columns
		 */

		add_action( 'manage_edit-cdz_work_columns', array( &$this, 'manage_columns' ) );

		/*
		 *	Manage posts custom column
		 */

		add_action( 'manage_cdz_work_posts_custom_column', array( &$this, 'manage_posts_custom_column' ) );

		/*
		 *	Make column sortable
		 */

		add_filter('manage_edit-cdz_work_sortable_columns', array( &$this, 'manage_sortable_columns' ) );

	}

	function register_post_type() {

		$labels = array(
			'name'					=>	__( 'Works', 'cdz' ),
			'singular_name'			=>	__( 'singular_name', 'cdz' ),
			'menu_name'				=>	__( 'Works', 'cdz' ),
			'all_items'				=>	__( 'All Works', 'cdz' ),
			'add_new'				=>	__( 'Add Work', 'cdz' ),
			'add_new_item'			=>	__( 'Add New Work', 'cdz' ),
			'edit_item'				=>	__( 'Edit Work', 'cdz' ),
			'new_item'				=>	__( 'New Work', 'cdz' ),
			'view_item'				=>	__( 'View Work', 'cdz' ),
			'search_items'			=>	__( 'Search Works', 'cdz' ),
			'not_found'				=>	__( 'No works found', 'cdz' ),
			'not_found_in_trash'	=>	__( 'No works found in Trash', 'cdz' ),
		);

		$args =	array(
			'labels'				=>	$labels,
			'public'				=>	true,
			'show_in_nav_menus'		=>	false,
			'show_in_menu'			=>	true,
			'menu_position'			=>	21,
			'menu_icon'				=>	'dashicons-admin-page',
			'has_archive'			=>	true,
			'rewrite'				=>	array( 'slug' => 'work' ),
			'can_export'			=>	true,
			'supports'				=>	array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		);

		/*
		 *	Use the order attribute:
		 *	$loop = new WP_Query( array( 'post_type', 'slider_item', 'orderby' => 'menu_order', 'order'=>'ASC') );
		 */

		register_post_type( 'cdz_work', apply_filters( 'cdz_work_args', $args ) );

	}

	function post_updated_messages( $messages ) {

		global $post, $post_ID;

		$messages['cdz_work'] = array(
			0	=>	'',
			1	=>	sprintf( __( 'Work updated. <a href="%s">View work</a>', 'cdz' ), esc_url( get_permalink($post_ID) ) ),
			2	=>	__( 'Custom field updated.', 'cdz' ),
			3	=>	__( 'Custom field deleted.', 'cdz' ),
			4	=>	__( 'Work updated.', 'cdz' ),
			5	=>	isset( $_GET['revision'] ) ? sprintf( __( 'Work restored to revision from %s', 'cdz' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6	=>	sprintf( __( 'Work published. <a href="%s">View work</a>', 'cdz' ), esc_url( get_permalink($post_ID) ) ),
			7	=>	__( 'Work saved.', 'cdz' ),
			8	=>	sprintf( __( 'Work submitted. <a target="_blank" href="%s">Preview work</a>', 'cdz' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
			9	=>	sprintf(
						__( 'Work scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview work</a>', 'cdz' ),
						date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) )
					),
			10	=>	sprintf( __( 'Work draft updated. <a target="_blank" href="%s">Preview work</a>', 'cdz' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		);

		return $messages;

	}

	/*
	 *	Meta Boxes
	 */

	function add_meta_boxes() {

		add_meta_box( 'cdz_work_box_customer', __( 'Work info', 'cdz' ), array( &$this, 'box_customer' ), 'cdz_work', 'normal', 'high' );
		add_meta_box( 'cdz_work_box_settings', __( 'Settings', 'cdz' ), array( &$this, 'box_settings' ), 'cdz_work', 'normal', 'high' );

	}
	
	function box_customer() {

		global $post;

		/*
		 *	Noncename needed to verify where the data originated
		 */

		echo '<input type="hidden" name="cdz_work_meta_noncename" id="cdz_work_meta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
		
		/*
		 *	Get meta
		 */

		$cdz_work_customer_label	= get_post_meta( $post->ID, 'cdz_work_customer_label', true );
		$cdz_work_customer			= get_post_meta( $post->ID, 'cdz_work_customer', true );
		$cdz_work_website_label		= get_post_meta( $post->ID, 'cdz_work_website_label', true );
		$cdz_work_website_url		= get_post_meta( $post->ID, 'cdz_work_website_url', true );
		$cdz_work_skills_label		= get_post_meta( $post->ID, 'cdz_work_skills_label', true );
		$cdz_work_skills			= get_post_meta( $post->ID, 'cdz_work_skills', true );

		/*
		 *	Fields
		 */

		echo '<p><label for="cdz_work_customer_label">' . __( 'Customer Label', 'cdz' ) . ' - <i>"' . __( 'Customer', 'cdz' ) . ':"</i></label></p>';
		echo '<input type="text" name="cdz_work_customer_label" value="' . $cdz_work_customer_label  . '" id="cdz_work_customer_label" class="widefat" />';

		echo '<p><label for="cdz_work_customer">' . __( 'Customer', 'cdz' ) . '</label></p>';
		echo '<input type="text" name="cdz_work_customer" value="' . $cdz_work_customer  . '" id="cdz_work_customer" class="widefat" />';

		echo '<p><label for="cdz_work_website_label">' . __( 'Website Label', 'cdz' ) . ' - <i>"' . __( 'Website', 'cdz' ) . ':"</i></label></p>';
		echo '<input type="text" name="cdz_work_website_label" value="' . $cdz_work_website_label  . '" id="cdz_work_website_label" class="widefat" />';

		echo '<p><label for="cdz_work_website_url">' . __( 'Website URL', 'cdz' ) . '</label></p>';
		echo '<input type="text" name="cdz_work_website_url" value="' . $cdz_work_website_url  . '" id="cdz_work_website_url" class="widefat" />';

		echo '<p><label for="cdz_work_skills_label">' . __( 'Skills Label', 'cdz' ) . ' - <i>"' . __( 'Skills', 'cdz' ) . ':"</i></label></p>';
		echo '<input type="text" name="cdz_work_skills_label" value="' . $cdz_work_skills_label  . '" id="cdz_work_skills_label" class="widefat" />';

		echo '<p><label for="cdz_work_skills">' . __( 'Skills', 'cdz' ) . '</label></p>';
		echo '<input type="text" name="cdz_work_skills" value="' . $cdz_work_skills  . '" id="cdz_work_skills" class="widefat" />';
		echo '<p class="description">' . __( 'Separate skills with commas', 'cdz' ) . '</p>';

	}
	
	function box_settings() {

		global $post;

		/*
		 *	Noncename needed to verify where the data originated
		 */

		echo '<input type="hidden" name="cdz_work_meta_noncename" id="cdz_work_meta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

		/*
		 *	Get meta
		 */

		$cdz_work_featured			= get_post_meta( $post->ID, 'cdz_work_featured', true );
		$cdz_work_read_more_label	= get_post_meta( $post->ID, 'cdz_work_read_more_label', true );

		/*
		 *	Fields
		 */

		echo '<p><label for="cdz_work_read_more_label">' . __( '"Read More" Label', 'cdz' ) . '</label></p>';
		echo '<input type="text" name="cdz_work_read_more_label" value="' . $cdz_work_read_more_label  . '" class="widefat" />';

		echo '<p><label for="cdz_work_featured">' . __( 'Feature this work?', 'cdz' ) . '</label></p>';
		echo '<input type="checkbox" name="cdz_work_featured" id="cdz_work_featured" value="1" ' . checked( 1, $cdz_work_featured, false ) . ' />';

	}

	function save_meta( $post_id, $post ) {

		if ( ! isset( $_POST['cdz_work_meta_noncename'] ) ) { return $post->ID; }

		/*
		 *	Verify this came from the our screen and with proper authorization
		 */

		if ( ! wp_verify_nonce( $_POST['cdz_work_meta_noncename'], plugin_basename(__FILE__) )) { return $post->ID; }

		/*
		 *	User allowed to edit the post or page?
		 */

		if ( ! current_user_can( 'edit_post', $post->ID ) ) { return $post->ID; }

		/*
		 *	Get Data and put them into an array to make it easier to loop though
		 */

		$cdz_work_meta['cdz_work_customer_label']	= $_POST['cdz_work_customer_label'];
		$cdz_work_meta['cdz_work_customer']			= $_POST['cdz_work_customer'];
		$cdz_work_meta['cdz_work_website_label']	= $_POST['cdz_work_website_label'];
		$cdz_work_meta['cdz_work_website_url']		= $_POST['cdz_work_website_url'];
		$cdz_work_meta['cdz_work_skills_label']		= $_POST['cdz_work_skills_label'];
		$cdz_work_meta['cdz_work_skills']			= $_POST['cdz_work_skills'];

		$cdz_work_meta['cdz_work_featured']			= isset( $_POST['cdz_work_featured'] ) ? $_POST['cdz_work_featured'] : '';
		$cdz_work_meta['cdz_work_read_more_label']	= $_POST['cdz_work_read_more_label'];

		/*
		 *	Add values of $cdz_work_meta as custom fields
		 */

		foreach ( $cdz_work_meta as $key => $value ) {

			/*
			 *	Don't store custom data twice
			 */

			if( $post->post_type == 'revision' ) { return; }

			/*
			 *	If $value is an array, make it a CSV (unlikely)
			 */

			$value = implode( ',', (array)$value );

			/*
			 *	If the custom field already has a value
			 */

			if( get_post_meta( $post->ID, $key, FALSE ) ) {

				update_post_meta( $post->ID, $key, $value );

			} else {

				add_post_meta($post->ID, $key, $value);

			}

			/*
			 *	Delete if blank
			 */

			if( !$value ) {

				delete_post_meta($post->ID, $key);

			}
		}
	}

	/*
	 *	Manage columns
	 */

	function manage_columns( $old_columns ) {

		/*
		 *	Doc: http://codex.wordpress.org/Plugin_API/Filter_Reference/manage_edit-post_type_columns
		 */

		var_dump( $old_columns );
		
		$columns['cb']					= '<input type="checkbox" />';
		$columns['title']				= __( 'Title', 'cdz' );
		$columns['cdz_work_thumb']		= __( 'Image', 'cdz' );
		$columns['cdz_work_portfolios']	= __( 'Portfolios', 'cdz' );
		$columns['cdz_work_categories']	= __( 'Categories', 'cdz' );
		$columns['cdz_work_featured']	= __( 'Featured', 'cdz' );
		$columns['menu_order']			= __( 'Order', 'cdz' );
		//$columns['date']				= __( 'Date', 'cdz' );

  		return $columns;
	}

	function manage_posts_custom_column( $name ) {
		
		global $post;

		if		( $name == 'menu_order' )			{ echo $post->menu_order; }
		else if	( $name == 'cdz_work_thumb' )		{ echo get_the_post_thumbnail( $post->ID, 'cdz_work_thumb' ); }
		else if	( $name == 'cdz_work_portfolios' )	{ the_terms( $post->ID, 'cdz_work_portfolio', '', ', ' ); }
		else if	( $name == 'cdz_work_categories' )	{ the_terms( $post->ID, 'cdz_work_category', '', ', ' ); }
		else if	( $name == 'cdz_work_portfolios' )	{ the_terms( $post->ID, 'cdz_work_portfolio', '', ', ' ); }
		else if	( $name == 'cdz_work_featured' )	{ echo get_post_meta( $post->ID, 'cdz_work_featured', true ) ? __( 'Yes', 'cdz' ) : __( 'No', 'cdz' ); }

	}

	function manage_sortable_columns( $columns ) {

		$columns['menu_order'] = 'menu_order';
		$columns['cdz_work_featured'] = 'cdz_work_featured';

		return $columns;
	}

}