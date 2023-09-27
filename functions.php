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