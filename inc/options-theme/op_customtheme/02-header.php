<?php
/**
 * Name file: 02-header
 * Description: This file is manage the header section
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


class mycustome_header{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION    = 'manage_options';
    const SUB_GROUP    = 'mycustome_header';
    const NONCE        = '_mycustome_header';

    //definir les sections de la page d'option
    const SECTION_USER  = 'section_user';
    const SECTION_NETWORK = 'section_network';

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
            mycv_mycustome::GROUP,        // slug parent
            __('Header', 'MyCV'),            // page_title
            __('Header', 'MyCV'),             // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e('Personnaliser le header', 'MyCV') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer le header du site', 'MyCV') ?>
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
    public static function registerSettings(){
        /**
         * SECTION 1 : SECTION_USER ===========================================
         *           1. créer la section
         *           2. ajouter les éléments du formulaire
         *           3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_USER,                   // SLUG_SECTION
            __('Section utilisateur', 'MyCV'),        // TITLE
            [self::class, 'display_section_user'],    // CALLBACK
            self::SUB_GROUP                     // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'sidebar_hidden_user',                  // SLUG_FIELD
            __("Cacher la section", 'MyCV'),             // LABEL
            [self::class,'field_sidebar_hidden_user'],  // CALLBACK
            self::SUB_GROUP ,                      // SLUG_PAGE
            self::SECTION_USER                   // SLUG_SECTION
        );

        add_settings_field(
            'sidebar_user_element',                  // SLUG_FIELD
            __("Ce qui doit être présent", 'MyCV'),             // LABEL
            [self::class,'field_sidebar_user_element'],  // CALLBACK
            self::SUB_GROUP ,                      // SLUG_PAGE
            self::SECTION_USER                   // SLUG_SECTION
        );

        add_settings_field(
            'sidebar_user_shooce',                  // SLUG_FIELD
            __("Choisir l'image", 'MyCV'),             // LABEL
            [self::class,'field_sidebar_choose_picture'],  // CALLBACK
            self::SUB_GROUP ,                      // SLUG_PAGE
            self::SECTION_USER                   // SLUG_SECTION
        );


        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'sidebar_hidden_user');
        register_setting(self::SUB_GROUP, 'sidebar_display_lastname');
        register_setting(self::SUB_GROUP, 'sidebar_display_firstname');
        register_setting(self::SUB_GROUP, 'sidebar_display_job');
        register_setting(self::SUB_GROUP, 'sidebar_display_picture');
        register_setting(self::SUB_GROUP, 'sidebar_choose_picture');

        /**
         * SECTION 2 : SECTION_NETWORK ========================================
         *           1. créer la section
         *           2. ajouter les éléments du formulaire
         *           3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_NETWORK,                      // SLUG_SECTION
            __('Section social', 'MyCV'),                   // TITLE
            [self::class, 'display_section_network'],       // CALLBACK
            self::SUB_GROUP                           // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'sidebar_hidden_social',                  // SLUG_FIELD
            __("Cacher la section", 'MyCV'),             // LABEL
            [self::class,'field_sidebar_hidden_social'],  // CALLBACK
            self::SUB_GROUP ,                      // SLUG_PAGE
            self::SECTION_NETWORK                   // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'sidebar_hidden_social');
    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_USER ===========================================
    public static function display_section_user(){
        ?>
        <p class="section-description">
            <?php _e('Dans cette section, vous pourrez définir les différent éléments de la partie utilisateur de la sidebar', 'MyCV'); ?>
        </p>
        <?php
    }

    // SECTION 2 : SECTION_NETWORK ========================================
    public static function display_section_network(){
        ?>
        <p class="section-description">
            <?php _e('Dans cette section, vous pourriez définir les différent éléments de la partie social', 'MyCV'); ?>
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
    // SECTION 1 : SECTION_USER ===========================================
    public static function field_sidebar_hidden_user(){
        $sidebar_hidden_user = esc_attr(get_option('sidebar_hidden_user'));
        ?>
        <input type="checkbox"
               id="sidebar_hidden_user"
               name="sidebar_hidden_user"
               value="1"
            <?php checked(1, $sidebar_hidden_user, true) ?>
        />
        <label for=""><?php _e("Cacher la section utilisateur de la sidebar", "MyCV"); ?></label>
        <?php
    }

    public static function field_sidebar_user_element(){
        $sidebar_display_lastname = esc_attr(get_option('sidebar_display_lastname'));
        $sidebar_display_firstname = esc_attr(get_option('sidebar_display_firstname'));
        $sidebar_display_job = esc_attr(get_option('sidebar_display_job'));
        $sidebar_display_picture = esc_attr(get_option('sidebar_display_picture'));

        ?>
        <p class="description"><?php _e("Cocher ce qui doit être présent", "MyCV") ?></p>
        <p>
            <input type="checkbox" id="sidebar_display_lastname" name="sidebar_display_lastname" value="1" <?php checked(1, $sidebar_display_lastname, true) ?> />
            <label for=""><?php _e("Nom", "MyCV"); ?></label>
        </p>
        <p>
            <input type="checkbox" id="sidebar_display_firstname" name="sidebar_display_firstname" value="1" <?php checked(1, $sidebar_display_firstname, true) ?> />
            <label for=""><?php _e("Prénom", "MyCV"); ?></label>
        </p>
        <p>
            <input type="checkbox" id="sidebar_display_job" name="sidebar_display_job" value="1" <?php checked(1, $sidebar_display_job, true) ?> />
            <label for=""><?php _e("Job", "MyCV"); ?></label>
        </p>
        <p>
            <input type="checkbox" id="sidebar_display_picture" name="sidebar_display_picture" value="1" <?php checked(1, $sidebar_display_picture, true) ?> />
            <label for=""><?php _e("Photo", "MyCV"); ?></label>
        </p>
        <?php
    }

    public static function field_sidebar_choose_picture(){
        $sidebar_choose_picture = esc_attr(get_option('sidebar_choose_picture'));
        ?>
        <p class="description"><?php _e("Choisir l'image à afficher", "MyCV"); ?></p>

        <p class="">
            <input type="radio"
                   name="sidebar_choose_picture"
                   value="1"
                   <?php checked(1, $sidebar_choose_picture, true) ?>
            />
            <label for=""><?php _e("Avatar", "MyCV") ?></label>
        </p>
        <p class="">
            <input type="radio"
                   name="sidebar_choose_picture"
                   value="2"
                   <?php checked(2, $sidebar_choose_picture, true) ?>
            />
            <label for=""><?php _e("Profile", "MyCV") ?></label>
        </p>
        <p class="">
            <input type="radio"
                   name="sidebar_choose_picture"
                   value="3"
                   <?php checked(3, $sidebar_choose_picture, true) ?>
            />
            <label for=""><?php _e("logo", "MyCV") ?></label>
        </p>
        </div>
        <?php
    }

    // SECTION 2 : SECTION_NETWORK ========================================
    public static function field_sidebar_hidden_social(){
        $sidebar_hidden_social = esc_attr(get_option('sidebar_hidden_social'));
        ?>
        <input type="checkbox"
               id="sidebar_hidden_social"
               name="sidebar_hidden_social"
               value="1"
            <?php checked(1, $sidebar_hidden_social , true) ?>
        />
        <label for=""><?php _e("Cacher la section utilisateur de la sidebar", "MyCV"); ?></label>
        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycustome_header')){
    mycustome_header::register();
}
