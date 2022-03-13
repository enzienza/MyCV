<?php
/**
 * Name file: 04-aboutme
 * Description: File for the manage CV Settings.
 *              [Talk about me]
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

class myprofil_aboutme{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 4
    const SUB_TITLE   = 'About me';
    const SUB_MENU    = 'About me';
    const PERMITION    = 'manage_options';
    const SUB_GROUP   = 'myprofil_aboutme';
    const NONCE        = '_myprofil_aboutme';

    //definir les sections de la page d'option
    const SECTION_FR = "section_fr";
    const SECTION_EN = "section_en";
    const SECTION_IT = "section_it";


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
            mycv_myprofil::GROUP,        // slug parent
            self::SUB_TITLE,                    // page_title
            self::SUB_MENU,                     // menu_title
            self::PERMITION,                     // capability
            self::SUB_GROUP,                    // slug_menu
            [self::class, 'render']              // CALLBACK
        );
    }

    /**
     * 4 - TEMPLATE DES PAGES
     */
    public static function render(){
        ?>
        <div class="wrap">
            <h1 class="wp-heagin-inline"><?php _e('À propos de moi', 'mycv') ?></h1>
            <p class="description">
                <?php _e('Sur cette page, vous pouvez parler de vous', 'mycv') ?>
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
     * SECTION 1 : SECTION_FR =========================================
     *             -> Créer la section
     *             -> Ajouter les éléments du formulaire
     *             -> Sauvegarder les champs
     *
     */
    // -> créer la section
        add_settings_section(
            self::SECTION_FR,                   // SLUG_SECTION
            __('Section en français', 'mycv'),      // TITLE
            [self::class, 'display_section_fr'],    // CALLBACK
            self:: SUB_GROUP                  // SLUG_PAGE
        );

    // -> créer la section
        add_settings_field(
            'talk_aboutme_fr',                     // SLUG_FIELD
            __('Qui suis-je ?', 'mycv'),               // LABEL
            [self::class,'field_talk_aboutme_fr'],     // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_FR                   // SLUG_SECTION
        );

    // -> Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'talk_aboutme_fr');

    /**
     * SECTION 2 : SECTION_EN =========================================
     *             -> Créer la section
     *             -> Ajouter les éléments du formulaire
     *             -> Sauvegarder les champs
     *
     */
    // -> créer la section
        add_settings_section(
            self::SECTION_EN,                   // SLUG_SECTION
            __('Section en anglais', 'mycv'),       // TITLE
            [self::class, 'display_section_en'],    // CALLBACK
            self:: SUB_GROUP                  // SLUG_PAGE
        );

    // -> créer la section
        add_settings_field(
            'talk_aboutme_en',                     // SLUG_FIELD
            __('Qui suis-je ?', 'mycv'),               // LABEL
            [self::class,'field_talk_aboutme_en'],     // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_EN                   // SLUG_SECTION
        );

    // -> Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'talk_aboutme_en');

    /**
     * SECTION 3 : SECTION_IT =========================================
     *             -> Créer la section
     *             -> Ajouter les éléments du formulaire
     *             -> Sauvegarder les champs
     *
     */
    // -> créer la section
        add_settings_section(
            self::SECTION_IT,                   // SLUG_SECTION
            __('Section en italien', 'mycv'),      // TITLE
            [self::class, 'display_section_it'],   // CALLBACK
            self:: SUB_GROUP                // SLUG_PAGE
        );

    // -> créer la section
        add_settings_field(
            'talk_aboutme_it',                     // SLUG_FIELD
            __('Qui suis-je ?', 'mycv'),               // LABEL
            [self::class,'field_talk_aboutme_it'],     // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_IT                   // SLUG_SECTION
        );

    // -> Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'talk_aboutme_it');

    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_FR =========================================
    public static function display_section_fr(){
        ?>
        <p class="section-description">
            <?php _e('Gestion de la section en français', 'mycv') ?>
        </p>
        <?php
    }
    // SECTION 2 : SECTION_EN =========================================
    public static function display_section_en(){
        ?>
        <p class="section-description">
            <?php _e('Gestion de la section en anglais', 'mycv') ?>
        </p>
        <?php
    }
    // SECTION 3 : SECTION_IT =========================================
    public static function display_section_it(){
        ?>
        <p class="section-description">
            <?php _e('Gestion de la section en italien' , 'mycv') ?>
        </p>
        <?php
    }

    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */
    // SECTION 1 : SECTION_FR =========================================
    // SECTION 2 : SECTION_EN =========================================
    // SECTION 3 : SECTION_IT =========================================

    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 1 : SECTION_FR =========================================
    public static function field_talk_aboutme_fr(){
        $talk_aboutme_fr = esc_attr(get_option('talk_aboutme_fr'));
        ?>
        <label for="talk_aboutme_fr"><?php _e('Parlez de moi', 'mycv') ?></label>
        <textarea name="talk_aboutme_fr" id="talk_aboutme_fr" class="large-text code"><?php echo $talk_aboutme_fr ?></textarea>
        <?php
    }
    // SECTION 2 : SECTION_EN =========================================
    public static function field_talk_aboutme_en(){
        $talk_aboutme_en = esc_attr(get_option('talk_aboutme_en'));
        ?>
        <label for="talk_aboutme_en"><?php _e('Parlez de moi', 'mycv') ?></label>
        <textarea name="talk_aboutme_en" id="talk_aboutme_en" class="large-text code"><?php echo $talk_aboutme_en ?></textarea>
        <?php
    }
    // SECTION 3 : SECTION_IT =========================================
    public static function field_talk_aboutme_it(){
        $talk_aboutme_it = esc_attr(get_option('talk_aboutme_it'));
        ?>
        <label for="talk_aboutme_it"><?php _e('Parlez de moi', 'mycv') ?></label>
        <textarea name="talk_aboutme_it" id="talk_aboutme_it" class="large-text code"><?php echo $talk_aboutme_it ?></textarea>
        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('myprofil_aboutme')){
    myprofil_aboutme::register();
}
