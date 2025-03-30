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

function enqueue_lightgallery_scripts() {
    wp_enqueue_script('lightgallery', 'https://cdn.jsdelivr.net/npm/lightgallery/lightgallery.umd.js', array(), null, true);
    wp_enqueue_script('lg-zoom', 'https://cdn.jsdelivr.net/npm/lightgallery/plugins/zoom/lg-zoom.umd.js', array('lightgallery'), null, true);
    wp_enqueue_script('lg-thumbnail', 'https://cdn.jsdelivr.net/npm/lightgallery/plugins/thumbnail/lg-thumbnail.umd.js', array('lightgallery'), null, true);
    
    wp_add_inline_script('lightgallery', "
        document.addEventListener('DOMContentLoaded', function () {
            lightGallery(document.getElementById('lightgallery'), {
                plugins: [lgZoom, lgThumbnail],
                licenseKey: 'your_license_key',
                speed: 500
            });
        });
    ");
}
add_action('wp_enqueue_scripts', 'enqueue_lightgallery_scripts');

function register_students_cpt() {
    $labels = array(
        'name' => 'Students',
        'singular_name' => 'Student',
        'add_new_item' => 'Add New Student',
        'edit_item' => 'Edit Student',
        'new_item' => 'New Student',
        'view_item' => 'View Student',
        'search_items' => 'Search Students',
        'not_found' => 'No students found',
        'not_found_in_trash' => 'No students found in Trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-id',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
        'template' => array(
            array('core/paragraph', array(
                'placeholder' => 'Enter a short biography here...'
            )),
            array('core/button', array(
                'text' => 'See My Portfolio'
            )),
        ),
        'template_lock' => 'all', // Prevent adding/removing/moving blocks
    );

    register_post_type('students', $args);
}
add_action('init', 'register_students_cpt');

function register_student_taxonomy() {
    $labels = array(
        'name' => 'Programs',
        'singular_name' => 'Program',
        'search_items' => 'Search Programs',
        'all_items' => 'All Programs',
        'edit_item' => 'Edit Program',
        'update_item' => 'Update Program',
        'add_new_item' => 'Add New Program',
        'new_item_name' => 'New Program Name',
        'menu_name' => 'Programs',
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true, // Makes it act like categories
        'show_in_rest' => true,
        'public' => true,
    );

    register_taxonomy('student_program', array('students'), $args);
}
add_action('init', 'register_student_taxonomy');

function custom_editor_scripts() {
    wp_enqueue_script(
        'custom-editor-placeholder',
        get_template_directory_uri() . '/js/custom-editor-placeholder.js',
        array('wp-dom-ready', 'wp-data'),
        null,
        true
    );
}
add_action('enqueue_block_editor_assets', 'custom_editor_scripts');


function enqueue_aos_scripts() {
    // AOS CSS
    wp_enqueue_style('aos-css', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css', array(), '2.3.4');

    // AOS JS
    wp_enqueue_script('aos-js', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js', array('jquery'), '2.3.4', true);

    // Initialize AOS
    wp_enqueue_script('aos-init', get_template_directory_uri() . '/js/aos-init.js', array('aos-js'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_aos_scripts');

function enqueue_aos_init_script() {
    wp_add_inline_script('aos-js', 'document.addEventListener("DOMContentLoaded", function() { AOS.init({ duration: 1000, once: true }); });', 'after');
}
add_action('wp_enqueue_scripts', 'enqueue_aos_init_script');
