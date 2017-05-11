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
	wp_enqueue_style( 'my-style', get_template_directory_uri() . '/static/css/main.css' );
	wp_enqueue_script( 'my-script', get_template_directory_uri() . '/static/js/main.js', array(), '', true );
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
$carbon_components = Field::make( 'complex', 'components', __( 'Content blocks', 'example' ) );

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
require_once TEMPLATEPATH . '/components/carbon.php';
