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
    wp_enqueue_script('aos-js', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js', array(), '2.3.4', array("strategy"=>"defer"));

    // Initialize AOS
    wp_enqueue_script('aos-init', get_theme_file_uri("assets/js/aos-settings.js"), array('aos-js'), "2.3.1", array("strategy"=>"defer"));
}
add_action('wp_enqueue_scripts', 'enqueue_aos_scripts');

require get_theme_file_path()."/custom-blocks/custom-blocks.php";

function lightgallery_script (){
if ( is_front_page() ) {
    // Enqueue CSS from a CDN
    wp_enqueue_style(
        'lightgallery-css',
        get_theme_file_uri( 'assets/css/lightgallery-bundle.min.css'),
        array(),
        wp_get_theme()->get( 'Version' )
    );
    // Enqueue JS from a CDN
    wp_enqueue_script(
        'lightgallery-js',
        get_theme_file_uri( 'assets/js/lightgallery.min.js'),
        array(),
        wp_get_theme()->get( 'Version' ),
        array( 'strategy' => 'defer' )
    );
    wp_enqueue_script(
        'lightgallery-thumbnail-js',
        get_theme_file_uri( 'assets/js/lg-thumbnail.min.js'),
        array('lightgallery-js'),
        wp_get_theme()->get( 'Version' ),
        array( 'strategy' => 'defer' )
    );
    wp_enqueue_script(
        'lightgallery-settings',
        get_theme_file_uri( 'assets/js/lightgallery-settings.js'),
        array( 'lightgallery-js', 'lightgallery-thumbnail-js' ),
        wp_get_theme()->get( 'Version' ),
        array( 'strategy' => 'defer' )
    );
}}
add_action ("wp_equeue_script", "lightgallery_script");

// Register Staff Custom Post Type
function register_staff_cpt() {
    $labels = [
        'name'               => 'Staff',
        'singular_name'      => 'Staff Member',
        'add_new'            => 'Add New Staff Member',
        'add_new_item'       => 'Add New Staff Member',
        'edit_item'          => 'Edit Staff Member',
        'new_item'           => 'New Staff Member',
        'view_item'          => 'View Staff Member',
        'search_items'       => 'Search Staff',
        'not_found'          => 'No Staff found',
        'not_found_in_trash' => 'No Staff found in Trash',
    ];

    $args = [
        'label'               => 'Staff',
        'labels'              => $labels,
        'public'              => true,
        'show_in_rest'        => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-groups',
        'supports'            => ['title', 'editor', 'thumbnail'],
        'hierarchical'        => false,
        'has_archive'         => true,
        'rewrite'             => ['slug' => 'staff'],
        'template'            => [
            ['core/paragraph', ['placeholder' => 'Enter job title...']],
            ['core/paragraph', ['placeholder' => 'Enter email address...']]
        ],
        'template_lock'       => 'all', // Locks the template
    ];

    register_post_type('staff', $args);
}
add_action('init', 'register_staff_cpt');

// Change "Add title" placeholder to "Add staff name"
function modify_staff_title_placeholder($title, $post) {
    if ($post->post_type === 'staff') {
        return 'Add staff name';
    }
    return $title;
}
add_filter('enter_title_here', 'modify_staff_title_placeholder', 10, 2);

// Register Custom Taxonomy (Departments)
function register_staff_taxonomy() {
    $labels = [
        'name'              => 'Departments',
        'singular_name'     => 'Department',
        'search_items'      => 'Search Departments',
        'all_items'         => 'All Departments',
        'edit_item'         => 'Edit Department',
        'update_item'       => 'Update Department',
        'add_new_item'      => 'Add New Department',
        'new_item_name'     => 'New Department Name',
        'menu_name'         => 'Departments',
    ];

    // Allow admins to manage terms, restrict others
    $capabilities = current_user_can('manage_options') ? [
        'manage_terms' => 'manage_options', // Admins can manage/edit/delete
        'edit_terms'   => 'manage_options',
        'delete_terms' => 'manage_options',
        'assign_terms' => 'edit_posts',
    ] : [
        'manage_terms' => 'do_not_allow',
        'edit_terms'   => 'do_not_allow',
        'delete_terms' => 'do_not_allow',
        'assign_terms' => 'edit_posts',
    ];

    $args = [
        'label'             => 'Departments',
        'labels'            => $labels,
        'public'            => true,
        'show_in_rest'      => true,
        'hierarchical'      => true,
        'rewrite'           => ['slug' => 'department'],
        'capabilities'      => $capabilities,
    ];

    register_taxonomy('staff_department', ['staff'], $args);
}
add_action('init', 'register_staff_taxonomy');


