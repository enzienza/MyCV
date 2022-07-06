<?php
/**
 * Name file: 10-footer
 * Description: This file is manage the error page (404 error)
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */

/**
 * Table of Contents:
 *
 * 1 - DEFINIR LES ELEMENTS (repeter)
 * 2 - DEFINIR LES HOOKS ACTIONS
 * 3 - CONSTRUCTION DE LA PAGE
 * 4 - TEMPLATE DES PAGES
 * 5 - ENREGISTRER LES PARAMETTRES D'OPTIONS
 * 6 - DEFINIR LES SECTIONS DE LA PAGE
 * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
 * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
 * 9 - AJOUT STYLE & SCRIPT
 */


class mycustome_footer{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION    = 'manage_options';
    const SUB_GROUP    = 'mycustome_footer';
    const NONCE        = '_mycustome_footer';

    //definir les sections de la page d'option
    const SECTION_FOOTER    = 'section_footer';

    /**
     * 2 - DEFINIR LES HOOKS ACTIONS
     */
    public static function register(){
        add_action('admin_menu', [self::class, 'addMenu']);
        add_action('admin_init', [self::class, 'registerSettings']);
        //add_action('admin_enqueue_scripts', [self::class, 'registerScripts']);
    }

    /**
     * 3 - CONSTRUCTION DE LA PAGE
     */
    public static function addMenu(){
        add_submenu_page(
            mycv_mycustome::GROUP,       // slug parent
            __('Footer', 'MyCV'),                    // page_title
            __('Footer', 'MyCV'),                    // menu_title
            self::PERMITION,              // capability
            self::SUB_GROUP,             // slug_menu
            [self::class, 'render']                // CALLBACK
        );
    }

    /**
     * 4 - TEMPLATE DES PAGES
     */
    public static function render(){
        ?>
        <div class="wrap">
            <h1 class="wp-heagin-inline"><?php _e( 'Personnaliser le footer', 'MyCV') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer le footer du site', 'MyCV') ?>
            </p><!--./description-->
            <?php settings_errors(); ?>
        </div><!--./wrap-->

        <form class="myoptions" action="options.php" method="post" enctype="multipart/form-data">
            <?php
            wp_nonce_field(self::NONCE, self::NONCE);
            settings_fields(self::SUB_GROUP);
            do_settings_sections(self::SUB_GROUP);
            ?>
            <?php submit_button(); ?>
        </form>
        <?php
    }

    /**
     * 5 - ENREGISTRER LES PARAMETTRES D'OPTIONS
     */
    public static function registerSettings()
    {
        /**
         * SECTION 1 : SECTION_FOOTER ===================================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_FOOTER,                   // SLUG_SECTION
            __('Gérer la section', 'MyCV'), // TITLE
            [self::class, 'display_section_footer'],    // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'type_footer',                  // SLUG_FIELD
            __("Choisir le type", 'MyCV'),            // LABEL
            [self::class,'field_type_footer'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_FOOTER                   // SLUG_SECTION
        );
        add_settings_field(
            'template_footer',                  // SLUG_FIELD
            __("Choisir le format", 'MyCV'),            // LABEL
            [self::class,'field_template_footer'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_FOOTER                   // SLUG_SECTION
        );
        add_settings_field(
            'element_footer',                  // SLUG_FIELD
            __("Ce qui doit être présent", 'MyCV'),            // LABEL
            [self::class,'field_element_footer'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_FOOTER                   // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'type_footer');
        register_setting(self::SUB_GROUP, 'template_footer');
        register_setting(self::SUB_GROUP, 'privacy_pocily');
        register_setting(self::SUB_GROUP, 'cookie_pocily');
    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
    */

    public static function display_section_footer(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage du footer", "MyCV"); ?>
        </p>
        <?php
    }


    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */

    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    public static function field_type_footer(){
        $type_footer = get_option('type_footer');
        ?>
        <p>
            <input type="radio" name="type_footer" value="1" <?php checked(1, $type_footer, true) ?> />
            <label for=""><?php _e('Uniquement le copyright', "MyCV") ?></label>
        </p>
        <p>
            <input type="radio" name="type_footer" value="2" <?php checked(2, $type_footer, true) ?> />
            <label for=""><?php _e('Copyright + partie légale', "MyCV") ?></label>
        </p>
        <?php
    }


    public static function field_template_footer(){
        $template_footer = get_option('template_footer');
        ?>

        <p>
            <input type="radio" name="template_footer" value="1" <?php checked(1, $template_footer, true) ?> />
            <label for=""><?php _e('"name-Theme" © 2022 | Created by Enza Lombardo', "MyCV") ?></label>
        </p>
        <p>
            <input type="radio" name="template_footer" value="2" <?php checked(2, $template_footer, true) ?> />
            <label for=""><?php _e('Copyright ©  2022 Enza | All rights reserved', "MyCV") ?></label>
        </p>

        <?php
    }


    public static function field_element_footer(){
        $privacy_pocily = get_option('privacy_pocily');
        $cookie_pocily = get_option('cookie_pocily');
        ?>
        <p class="description"><?php _e("Cocher ce qui doit être présent", "MyCV") ?></p>
        <p>
            <input type="checkbox" id="privacy_pocily" name="privacy_pocily" value="1" <?php checked(1, $privacy_pocily, true) ?> />
            <label for=""><?php _e("Mentions légales", "MyCV") ?></label>
        </p>
        <p>
            <input type="checkbox" id="cookie_pocily" name="cookie_pocily" value="1" <?php checked(1, $cookie_pocily, true) ?> />
            <label for=""><?php _e("Cookies", "MyCV") ?></label>
        </p>
        <?php
    }



    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycustome_footer')){
    mycustome_footer::register();
}