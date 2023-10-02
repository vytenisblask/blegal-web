<?php
function theme_enqueue_styles() {
    // Enqueue Style with dynamic versioning
    wp_enqueue_style( 'main-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version') );
    
    // Enqueue Scripts with dynamic versioning
    wp_enqueue_script( 'main-script', get_template_directory_uri() . '/js/main.js', array('jquery'), wp_get_theme()->get('Version'), true );

    // Enqueue Vue.js component script
    wp_enqueue_script('vue', 'https://unpkg.com/vue@3/dist/vue.global.js');
    wp_enqueue_script('contact-us', get_template_directory_uri() . '/js/contact-us.js', array('vue'), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_prefix_setup() {
    add_theme_support( 'custom-logo' );
    // Consider adding more theme support here
}
add_action( 'after_setup_theme', 'theme_prefix_setup' );

function register_theme_menus() {
    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'blegal-theme' )
        )
    );
}
add_action( 'init', 'register_theme_menus' );

function enable_svg_upload( $mimes ) {
    // Consider implementing additional security measures for SVG uploads
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'enable_svg_upload' );


function blegal_customize_register( $wp_customize ) {
    // Add Section
    $wp_customize->add_section('kontaktai_section', array(
        'title'    => __('Kontaktai Page', 'blegal-theme'),
        'priority' => 120,
    ));

    // Add Setting
    $wp_customize->add_setting('kontaktai_text_setting', array(
        'default'   => 'Default Text',
        'transport' => 'refresh',
    ));

    // Add Control
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'kontaktai_text_control',
        array(
            'label'    => __('Text Field', 'blegal-theme'),
            'section'  => 'kontaktai_section',
            'settings' => 'kontaktai_text_setting',
            'type'     => 'text',
        )
    ));
}
add_action('customize_register', 'blegal_customize_register');

// Team members 
function register_team_member_cpt() {
    $labels = array(
        'name'                  => _x('Team Members', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Team Member', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Team Members', 'text_domain'),
        'name_admin_bar'        => __('Team Member', 'text_domain'),
        'all_items'             => __('All Team Members', 'text_domain'),
        'add_new_item'          => __('Add New Team Member', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Team Member', 'text_domain'),
        'edit_item'             => __('Edit Team Member', 'text_domain'),
        'update_item'           => __('Update Team Member', 'text_domain'),
        'view_item'             => __('View Team Member', 'text_domain'),
        'view_items'            => __('View Team Members', 'text_domain'),
    );

    $args = array(
        'label'                 => __('Team Member', 'text_domain'),
        'description'           => __('Post Type Description', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'thumbnail'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );

    register_post_type('team_member', $args);
}

add_action('init', 'register_team_member_cpt', 0);

function create_naujienos_cpt() {
    $labels = array(
        'name' => _x('Naujienos', 'Post Type General Name', 'textdomain'),
        'singular_name' => _x('Naujiena', 'Post Type Singular Name', 'textdomain'),
        'menu_name' => _x('Naujienos', 'admin menu', 'textdomain'),
        'name_admin_bar' => _x('Naujiena', 'add new on admin bar', 'textdomain'),
        'add_new' => _x('Add New', 'book', 'textdomain'),
        'add_new_item' => __('Add New Naujiena', 'textdomain'),
        'new_item' => __('New Naujiena', 'textdomain'),
        'edit_item' => __('Edit Naujiena', 'textdomain'),
        'view_item' => __('View Naujiena', 'textdomain'),
        'all_items' => __('All Naujienos', 'textdomain'),
        'search_items' => __('Search Naujienos', 'textdomain'),
        'parent_item_colon' => __('Parent Naujiena:', 'textdomain'),
        'not_found' => __('No naujienos found.', 'textdomain'),
        'not_found_in_trash' => __('No naujienos found in Trash.', 'textdomain')
    );
    $args = array(
        'label' => __('Naujienos', 'textdomain'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'public' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => 'naujienos',
        'rewrite' => array('slug' => 'naujienos'),
    );
    register_post_type('naujienos', $args);
}
add_action('init', 'create_naujienos_cpt');


function register_darbo_skelbimai_post_type() {
    $labels = array(
        'name' => _x('Darbo Skelbimai', 'post type general name', 'textdomain'),
        'singular_name' => _x('Darbo Skelbimas', 'post type singular name', 'textdomain'),
        'menu_name' => _x('Darbo Skelbimai', 'admin menu', 'textdomain'),
        'name_admin_bar' => _x('Darbo Skelbimas', 'add new on admin bar', 'textdomain'),
        'add_new' => _x('Add New', 'book', 'textdomain'),
        'add_new_item' => __('Add New Darbo Skelbimas', 'textdomain'),
        'new_item' => __('New Darbo Skelbimas', 'textdomain'),
        'edit_item' => __('Edit Darbo Skelbimas', 'textdomain'),
        'view_item' => __('View Darbo Skelbimas', 'textdomain'),
        'all_items' => __('All Darbo Skelbimai', 'textdomain'),
        'search_items' => __('Search Darbo Skelbimai', 'textdomain'),
        'parent_item_colon' => __('Parent Darbo Skelbimai:', 'textdomain'),
        'not_found' => __('No darbo skelbimai found.', 'textdomain'),
        'not_found_in_trash' => __('No darbo skelbimai found in Trash.', 'textdomain')
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'darbo-skelbimai'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
    );

    register_post_type('darbo_skelbimai', $args);
}

add_action('init', 'register_darbo_skelbimai_post_type');

function load_custom_single_template($template) {
    global $post;

    // Check if the post belongs to the 'paslaugos' category
    if ( has_category( 'paslaugos', $post ) ) {
        // specify the path to your custom template
        return get_stylesheet_directory() . '/single-paslaugos.php';
    }

    return $template;
}

add_filter('single_template', 'load_custom_single_template');

function register_custom_fields() {
    register_rest_field(
        'post',
        'display_in_slider',
        array(
            'get_callback'    => 'get_custom_field',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}

function get_custom_field( $object, $field_name, $request ) {
    return get_post_meta( $object['id'], $field_name, true );
}

add_action( 'rest_api_init', 'register_custom_fields' );

function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Paslaugos'; // Change Posts label to Paslaugos
    $submenu['edit.php'][5][0] = 'Paslaugos';
    $submenu['edit.php'][10][0] = 'Add Paslaugos';
    $submenu['edit.php'][16][0] = 'Paslaugos Tags';
}
add_action('admin_menu', 'change_post_menu_label');
