<?php
/**
 * Name file: config-theme
 * Description: MyCV functions and definitions
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */

/**
 * Table of Contents:
 *
 * 1 - Theme setup
 * 2 - custom css nav menu
 * 3 - Include Styles and script
 * 4 - Separator Title
 * 5 - Hiden Version WP
 */

/**
 * 1 - Theme setup
 *     Function for perform basic setup, registration and init actions for customtheme
 */

// fonction qui vérifie si le 'mycv_supports' exixte déjà avant de l'initialiser
if(!function_exists('mycv_supports')){
    function mycv_supports(){
        // Let WordPress manage the document title.
        add_theme_support( "title-tag" );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');
        
        // dimention image
        add_image_size('post-thumbnail', 350, 215, true);

        // This customtheme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'top' => esc_html__( 'Top', 'Nav-top' ),
            'aside' => esc_html__( 'Aside', 'Nav-vertical' ),
            //'footer' => __( 'Footer', 'Pied de page' )
        ) );

        // Make customtheme available for translation. Translations can be filed in the /languages/ directory.
        load_theme_textdomain( 'MyCV', get_template_directory() . '/languages' );
    }
}
add_action('after_setup_theme','mycv_supports' );

/**
 * 2 - Custom css nav menu
 *     nav_menu_css_class: Filters the CSS classes applied to a menu item’s list item elements.
 *     nav_menu_link_attributes: Filters the HTML attributes applied to a menu item’s anchor elements.
 */
add_filter(
    "nav_menu_css_class",
    function($classes){
        $classes[] = 'nav-item';
        return $classes;
    }
);

add_filter(
    "nav_menu_link_attributes",
    function($attrs){
        $attrs['class'] = 'nav-link';
        //$attrs['class'] = 'nav-link scrollto';
        return $attrs;
    }
);

/**
 * 3 - Include Styles and script
 *     Function for runs the scripts and css for customtheme
 */
// fonction qui vérifie si 'mycv_register_assets' exixte déjà avant de l'initialiser
if(!function_exists('mycv_register_assets')) {
    function mycv_register_assets()
    {

        // ===================================================================
        // JAVASCRIP
        // ===================================================================

        // JS Externe ---------------------------------
        // CDN JS BOOTSTRAP 4.4.1
        wp_register_script(
            'bootstrap',
            'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js',
            ['popper', 'jquery'],
            '4.4.1', true
        );

        // CDN POPPER
        wp_register_script(
            'popper',
            'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js',
            [],
            '1.16.0', true
        );
        // CDN jQuery
        wp_deregister_script('jquery');
        wp_register_script(
            'jquery',
            'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js',
            [],
            '3.5.1',
            true
        );

        // JS Custom  ---------------------------------


        // ===================================================================
        // CSS
        // ===================================================================

        // CSS Externe --------------------------------
        //cdn CSS bootstrap 4.4.1
        wp_register_style(
            'bootstrap',
            'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
            [], '4.4.1'
        );
        wp_enqueue_style('bootstrap');

        // CSS Custom  --------------------------------
        wp_enqueue_style(
            'style',
            get_template_directory_uri().'/style.css',
            [], '1.0.0'
        );
    }
}
add_action('wp_enqueue_scripts', 'mycv_register_assets');

/**
 * 4 - Separator Title
 *     Filters the separator for the document title
 */
if(!function_exists('mycv_title_separator')){
    function mycv_title_separator(){
        return '|';
    }
}
add_filter( 'document_title_separator', 'mycv_title_separator');

/**
 * 5 - Hiden Version WP
 */
//	Securité : Cacher la verion du WordPress utilisé
function mycv_remove_version_strings( $src ) {
    global $wp_version;
    parse_str(parse_url($src, PHP_URL_QUERY), $query);
    if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

add_filter( 'script_loader_src', 'mycv_remove_version_strings' );
add_filter( 'style_loader_src', 'mycv_remove_version_strings' );

// Hide WP version strings from generator meta tag
function mycv_remove_version() {
    return '';
}

add_filter('the_generator', 'mycv_remove_version');