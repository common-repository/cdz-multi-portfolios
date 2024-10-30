<?php

/*
 *	Plugin Name: cdz Multi Portfolios
 *	Plugin URI: http://www.coderzjungle.com/wp-plugins/multi-portfolios
 *	Author: CoderzJungle
 *	Author URI: http://www.coderzjungle.com
 *	Description: This Wordpress plugin allow you to manage multiple portfolios with infinite works.
 *	License: GPL3
 *	Version: 1.0.1
 *
 *       ( ( (                        |"|                         ___         .      .   
 *     '. ___ .'       ,,,,,         _|_|_        __MMM__        .|||.      .  .:::.     
 *    '  (> <) '      /(o o)\        (o o)         (o o)         (o o)        :(o o):  . 
 *   ooO--(_)--Ooo-ooO--(_)--Ooo-ooO--(_)--Ooo-ooO--(_)--Ooo-ooO--(_)--Ooo-ooO--(_)--Ooo
 *     ____          _                  _                   _                           
 *    / ___|___   __| | ___ _ __ ____  | |_   _ _ __   __ _| | ___   ___ ___  _ __ ___  
 *   | |   / _ \ / _` |/ _ \ '__|_  /  | | | | | '_ \ / _` | |/ _ \ / __/ _ \| '_ ` _ \ 
 *   | |__| (_) | (_| |  __/ |   / / |_| | |_| | | | | (_| | |  __/| (_| (_) | | | | | |
 *    \____\___/ \__,_|\___|_|  /___\___/ \__,_|_| |_|\__, |_|\___(_)___\___/|_| |_| |_|
 *                                                    |___/                             
 */

namespace cdzMultiPortfolios;

/*
 *	Load classes
 */

require_once dirname( __FILE__ ) . '/classes/cdz-work.class.php';
require_once dirname( __FILE__ ) . '/classes/cdz-work-category.class.php';
require_once dirname( __FILE__ ) . '/classes/cdz-work-portfolio.class.php';

/*
 *	Load functions
 */

require_once dirname( __FILE__ ) . '/functions/cdz-get-template.php';
require_once dirname( __FILE__ ) . '/functions/cdz-include-template-files.php';
require_once dirname( __FILE__ ) . '/functions/cdz-load-plugin-textdomain.php';
require_once dirname( __FILE__ ) . '/functions/cdz-load-styles.php';

/*
 *	Load Font Awesome
 */

add_action( 'wp_enqueue_scripts', 'cdzMultiPortfolios\\cdz_load_styles', 99 );

/*
 *	Load plugin textdomain
 */

add_action( 'plugins_loaded', 'cdzMultiPortfolios\\cdz_load_plugin_textdomain' );

/*
 *	Templates
 */

add_filter( 'template_include', 'cdzMultiPortfolios\\cdz_include_template_files' );

/*
 *	Thumbnails
 */

add_theme_support( 'post-thumbnails' );
add_image_size( 'cdz_work_thumb', 40, 40, true );

/*
 *	Create Portfolio Object
 */

$cdz_work			= new cdz_Work();
$cdz_work_category	= new cdz_Work_Category();
$cdz_work_portfolio	= new cdz_Work_Portfolio();
