<?php

use Carbon_Fields\Field;

/**
 * Add theme support
 */
add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	//add_theme_support( 'post-thumbnails' );
	//set_post_thumbnail_size( 825, 510, true );
} );

/**
 * Removing image srcset
 */
add_filter( 'wp_calculate_image_srcset', '__return_null' );

/**
 * Setting image quality
 */
add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) );

/**
 * Deleting menu items in the admin panel
 */
add_action( 'admin_menu', function () {
//	remove_menu_page( 'index.php' );
//	remove_menu_page( 'edit.php' );
//	remove_menu_page( 'upload.php' );
//	remove_menu_page( 'edit.php?post_type=page' );
//	remove_menu_page( 'edit-comments.php' );
//	remove_menu_page( 'themes.php' );
//	remove_menu_page( 'plugins.php' );
//	remove_menu_page( 'users.php' );
//	remove_menu_page( 'tools.php' );
//	remove_menu_page( 'options-general.php' );
} );

/**
 * Removing defaults scripts
 */
add_action( 'wp_print_scripts', function () {
	if ( ! is_admin() && ! is_customize_preview() ) {
		wp_deregister_script( 'jquery' );
	}
}, 100 );

/**
 * Include scripts and styles
 */
add_action( 'wp_enqueue_scripts', function () {
	$min_script = env( 'WP_ENV' ) === 'production' ? '.min' : '';
	wp_enqueue_style( 'my-style', get_template_directory_uri() . "/static/css/main$min_script.css" );
	wp_enqueue_script( 'my-script', get_template_directory_uri() . "/static/js/main$min_script.js", array(), '', true );
} );
add_action( 'admin_enqueue_scripts', function () {
	wp_enqueue_style( 'my-admin-style', get_template_directory_uri() . '/style.css' );
} );

/**
 * Adding 'async' attribute for scripts
 */
add_filter( 'script_loader_tag', function ( $tag, $handle ) {
	if ( 'my-script' !== $handle ) {
		return $tag;
	}

	return str_replace( ' src', ' async src', $tag );
}, 10, 2 );

/**
 * Create nonce
 */
add_action( 'wp_enqueue_scripts', function () {
	wp_localize_script( 'my-script', 'ajaxdata',
		array(
			'url'   => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'ajax_for_my_site' )
		)
	);
}, 99 );

/**
 * Setup text editor
 */
add_filter( 'tiny_mce_before_init', function () {
	$in['wordpress_adv_hidden'] = false;

	return $in;
} );
add_filter( 'mce_buttons_3', function () {
//	$buttons[] = 'fontselect';
	$buttons[] = 'fontsizeselect';
//  $buttons[] = 'styleselect';
	$buttons[] = 'backcolor';
//  $buttons[] = 'newdocument';
	$buttons[] = 'cut';
	$buttons[] = 'copy';
//  $buttons[] = 'charmap';
//  $buttons[] = 'hr';
	$buttons[] = 'visualaid';

	return $buttons;
} );

/**
 * Adding using session
 */
add_action( 'init', function () {
	if ( ! session_id() ) {
//		session_start();
	}
} );

/**
 * Carbon components
 */
if ( function_exists( 'carbon_get_post_meta' ) ) {
	$carbon_components = Field::make( 'complex', 'components', __( 'Content blocks', 'krn' ) )
	                          ->set_collapsed( true );
} else {
	if ( ! is_admin() ) {
		echo '<h1 style="margin-top: 200px; margin-bottom: 100px; text-align: center; color: red; font-size: 50px;">You must activate of Carbon Fields Plugin</h1>';
	}
}

/**
 * Include functions.php of components
 */
$dirs_components = scandir( __DIR__ . '/components' );
foreach ( $dirs_components as $dir ) {
	if ( $dir === 'template' || $dir === 'carbon' ) {
		continue;
	}
	$path = TEMPLATEPATH . '/components/' . $dir . '/' . $dir . '_functions.php';
	if ( file_exists( $path ) ) {
		require_once( $path );
	}
}

/**
 * Require carbon component
 */
if(isset($carbon_components)) {
	require_once __DIR__ . '/components/carbon.php';
}
