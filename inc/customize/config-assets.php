<?php
/**
 * Name file:   Include Styles and script
 * Description: Function for runs the scripts and css for customtheme
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */

// fonction qui vérifie si 'mycv_register_assets' exixte déjà avant de l'initialiser
if(!function_exists('mycv_register_assets')) {
    function mycv_register_assets()
    {

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
        wp_enqueue_script('bootstrap');

        // CDN jquery-cookie
        wp_register_script(
            'jquery-cookie',
            'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js',
            ['jquery'],
            '1.4.1', true
        );
        wp_enqueue_script('jquery-cookie');


        // JS Custom  ---------------------------------
        wp_enqueue_script(
            'switch-mode',
            get_template_directory_uri().'/assets/js/switch-mode.js',
            ['jquery-cookie','jquery'],
            '1.0',
            true
        );
        wp_enqueue_script(
            'btn-menu',
            get_template_directory_uri().'/assets/js/btn-menu.js',
            [],
            '1.0',
            true
        );
        wp_enqueue_script(
            'ancestor_menu',
            get_template_directory_uri().'/assets/js/ancestor_menu.js',
            [],
            '1.0',
            true
        );
        wp_enqueue_script(
            'scrollTop',
            get_template_directory_uri().'/assets/js/scrollTop.js',
            [],
            '1.0',
            true
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



    }
}
add_action('wp_enqueue_scripts', 'mycv_register_assets');