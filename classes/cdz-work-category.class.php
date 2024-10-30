<?php

namespace cdzMultiPortfolios;

/*
 *	cdzClass: Work Category
 */

class cdz_Work_Category {

	function __construct() {

		/*
		 *	Register taxonomy
		 */

		add_action( 'init', array( &$this, 'register_taxonomy' ) );

		/*
		 *	Add form fields remover
		 */

		add_action( 'cdz_work_category_add_form_fields', array( &$this, 'add_form_fields_remover' ), 10, 2 );

	}

	function register_taxonomy() {
	
		$labels = array(
			'name'							=>	__( 'Work Categories', 'cdz' ),
			'singular_name'					=>	__( 'Work Category', 'cdz' ),
			'menu_name'						=>	__( 'Categories', 'cdz' ),
			'all_items'						=>	__( 'All Work Categories', 'cdz' ),
			'edit_item'						=>	__( 'Edit Work Category', 'cdz' ),
			'view_item'						=>	__( 'View Work Category', 'cdz' ),
			'update_item'					=>	__( 'Update Work Category', 'cdz' ),
			'add_new_item'					=>	__( 'Add New Work Category', 'cdz' ),
			'new_item_name'					=>	__( 'New Work Category Name', 'cdz' ),
			'search_items'					=>	__( 'Search Work Categories', 'cdz' ),
			'popular_items'					=>	NULL,
			'separate_items_with_commas'	=>	__( 'Separate work categories with commas', 'cdz' ),
			'add_or_remove_items'			=>	__( 'Add or remove work categories', 'cdz' ),
			'choose_from_most_used'			=>	__( 'Choose from the most used work categories', 'cdz' ),
			'not_found'						=>	__( 'No work categories found.', 'cdz' ),
		);

		$args = array(
			'label'				=>	__( 'Category' ),
			'labels'			=>	$labels,
			'show_in_nav_menus'	=>	true,
			'hierarchical'		=>	true,
			'rewrite'			=>	array( 'slug' => 'work-category' ),
		);

		register_taxonomy( 'cdz_work_category',
			apply_filters( 'cdz_work_category_objects', array('cdz_work') ),
			apply_filters( 'cdz_work_category_args', $args )
		);

	}

	function add_form_fields_remover() {

		echo '<style>.form-field{display:none;}.form-field.form-required{display:block;}</style>';

	}

}