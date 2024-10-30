<?php

namespace cdzMultiPortfolios;

/*
 *	cdzFunction: Include Template Files
 */

if ( ! function_exists( 'cdz_include_template_files' ) ) {

	function cdz_include_template_files( $template ) {

		if ( is_single() AND get_post_type() == 'cdz_work' ) {

			return cdz_get_template( $template, 'cdz-multi-portfolios', 'cdz-work.php' );
			
		} else if ( is_archive() AND get_post_type() == 'cdz_work' ) {

			return cdz_get_template( $template, 'cdz-multi-portfolios', 'cdz-archive.php' );

		}

		return $template;

	}

}