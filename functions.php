<?php
/**
 * Theme Functions File
 *
 * This file contains custom functionality for the theme.
 */

/**
 * Enqueue Google Fonts
 * This function loads the Google Fonts (Poppins in this case).
 */
function theme_enqueue_google_fonts() {
    // Enqueue Google Fonts for the front-end
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap', [], null);
    
    // Enqueue Google Fonts for the admin (back-end)
    if (is_admin()) {
        wp_enqueue_style('google-fonts-admin', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap', [], null);
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_google_fonts'); // Front-end
add_action('admin_enqueue_scripts', 'theme_enqueue_google_fonts'); // Admin (back-end)

/**
 * Enqueue Theme Styles
 * This function adds the main style.css file for front-end and admin area.
 */
function my_theme_enqueue_styles() {
    // Enqueue the front-end style.css file
    wp_enqueue_style('my-theme-style', get_stylesheet_uri());
    
    // Enqueue the admin (back-end) style.css file
    if (is_admin()) {
        wp_enqueue_style('my-theme-admin-style', get_stylesheet_uri());
    }
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles'); // Front-end
add_action('admin_enqueue_scripts', 'my_theme_enqueue_styles'); // Admin (back-end)

/**
 * Theme Setup
 * This function runs theme setup actions like support for title tag, custom menus, etc.
 */
function theme_setup() {
    // Add theme support for various WordPress features
    add_theme_support('title-tag'); // Automatically manage the <title> tag
    add_theme_support('post-thumbnails'); // Add support for post thumbnails (featured images)
    add_theme_support('custom-logo'); // Add support for custom logo
    add_theme_support('customize-selective-refresh-widgets'); // Enable selective refresh for widgets

    // Register navigation menus
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer'  => 'Footer Menu',
    ));
}
add_action('after_setup_theme', 'theme_setup');

/**
 * Register Widget Areas
 * This function registers the widget areas (sidebars) for the theme.
 */
function theme_widgets_init() {
    register_sidebar(array(
        'name'          => 'Sidebar',
        'id'            => 'sidebar-1',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => 'Footer Widgets',
        'id'            => 'footer-1',
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'theme_widgets_init');


function theme_enqueue_styles() {
    // Enqueue Normalize CSS from a CDN
    wp_enqueue_style('normalize-css', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css', [], null);

    // Enqueue the main style.css file (your theme's stylesheet)
    wp_enqueue_style('my-theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');


// Enable theme support for site icon (favicon)
function theme_add_site_icon_support() {
    add_theme_support('site-icon');
}
add_action('after_setup_theme', 'theme_add_site_icon_support');

