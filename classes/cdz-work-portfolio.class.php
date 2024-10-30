<?php

namespace cdzMultiPortfolios;

/*
 *	cdzClass: Work Portfolio
 */

class cdz_Work_Portfolio {

	function __construct() {

		/*
		 *	Register taxonomy
		 */

		add_action( 'init', array( &$this, 'register_taxonomy' ) );

		/*
		 *	Add form fields remover
		 */

		add_action( 'cdz_work_portfolio_add_form_fields', array( &$this, 'add_form_fields_remover' ), 10, 2 );

	}

	function register_taxonomy() {
	
		$labels = array(
			'name'							=>	__( 'Work Portfolios', 'cdz' ),
			'singular_name'					=>	__( 'Work Portfolio', 'cdz' ),
			'menu_name'						=>	__( 'Portfolios', 'cdz' ),
			'all_items'						=>	__( 'All Work Portfolios', 'cdz' ),
			'edit_item'						=>	__( 'Edit Work Portfolio', 'cdz' ),
			'view_item'						=>	__( 'View Work Portfolio', 'cdz' ),
			'update_item'					=>	__( 'Update Work Portfolio', 'cdz' ),
			'add_new_item'					=>	__( 'Add New Work Portfolio', 'cdz' ),
			'new_item_name'					=>	__( 'New PWork ortfolio Name', 'cdz' ),
			'search_items'					=>	__( 'Search Work Portfolios', 'cdz' ),
			'popular_items'					=>	NULL,
			'separate_items_with_commas'	=>	__( 'Separate work portfolios with commas', 'cdz' ),
			'add_or_remove_items'			=>	__( 'Add or remove work portfolios', 'cdz' ),
			'choose_from_most_used'			=>	__( 'Choose from the most used work portfolios', 'cdz' ),
			'not_found'						=>	__( 'No work portfolios found.', 'cdz' ),
		);

		$args = array(
			'label'				=>	__( 'Portfolio' ),
			'labels'			=>	$labels,
			'show_in_nav_menus'	=>	true,
			'hierarchical'		=>	true,
			'rewrite'			=>	array( 'slug' => 'work-portfolio' ),
		);

		register_taxonomy( 'cdz_work_portfolio',
			apply_filters( 'cdz_work_portfolio_objects', array('cdz_work') ),
			apply_filters( 'cdz_work_portfolio_args', $args )
		);

	}

	function add_form_fields_remover() {

		echo '<style>.form-field{display:none;}.form-field.form-required{display:block;}</style>';

	}

}