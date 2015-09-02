<?php

//enqueue scripts and styles *use production assets. Dev assets are located in assets/css and assets/js
function loadup_scripts() {
	wp_enqueue_script( 'font-js', 'http://fast.fonts.net/jsapi/37400450-5dd6-4716-b372-1b25c6c35c3f.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'maps-js', 'https://maps.googleapis.com/maps/api/js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'map-data', get_template_directory_uri().'/data/data.json' );
	wp_enqueue_script( 'theme-js', get_template_directory_uri().'/js/mesh.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'classie-js', get_template_directory_uri().'/js/classie.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'match-js', get_template_directory_uri().'/js/jquery.matchHeight-min.js', array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'loadup_scripts' );

// Add Thumbnail Theme Support
add_theme_support('post-thumbnails');
add_image_size('background-fullscreen', 1800, 1200, true);
add_image_size('short-banner', 1800, 800, true);

add_image_size('large', 1500, '', true); // Large Thumbnail
add_image_size('medium', 250, '', true); // Medium Thumbnail
add_image_size('small', 120, '', true); // Small Thumbnail
add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');



//Register WP Menus
register_nav_menus(
    array(
        'main_nav' => 'Header and breadcrumb trail heirarchy',
        'utilities_nav' => 'Utilities menu used throughout',
				'banner_nav' => 'Banner menu'
    )
);

// Register Widget Area for the Sidebar
register_sidebar( array(
    'name' => __( 'Primary Widget Area', 'Sidebar' ),
    'id' => 'primary-widget-area',
    'description' => __( 'The primary widget area', 'Sidebar' ),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
) );

//disable code editors
add_theme_support('html5');
add_theme_support('automatic-feed-links');

//Security and header clean-ups
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'rsd_link');
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'wp_generator'); // remove WP version from header
remove_action( 'wp_head','wp_shortlink_wp_head');


?>
