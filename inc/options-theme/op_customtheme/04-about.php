<?php
/**
 * Name file: 04-about
 * Description: This file is manage the about section
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


class mycustome_about{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION    = 'manage_options';
    const SUB_GROUP    = 'mycustome_about';
    const NONCE        = '_mycustome_about';

    //definir les sections de la page d'option
    const SECTION_ABOUT              = 'section_about';
    const SECTION_ABOUT_INFO         = 'section_about_info';
    const SECTION_ABOUT_CALLTOACTION = 'section_about_calltoaction';

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
            __('About', 'MyCV'),                    // page_title
            __('About', 'MyCV'),                    // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e( 'Personnaliser la section "about"', 'MyCV') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer la section about du site', 'MyCV') ?>
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
         * SECTION 1 : SECTION_ABOUT ======================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_ABOUT,                 // SLUG_SECTION
            __('Gérer la section', 'MyCV'),                 // TITLE
            [self::class, 'display_section_about'],  // CALLBACK
            self::SUB_GROUP                   // SLUG_PAGE
        );
        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'about_hidden_section',                  // SLUG_FIELD
            __("Cacher la section", 'MyCV'),            // LABEL
            [self::class,'field_about_hidden_section'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_ABOUT                   // SLUG_SECTION
        );
        add_settings_field(
            'about_title_section',                  // SLUG_FIELD
            __("Titre section", 'MyCV'),            // LABEL
            [self::class,'field_about_title_section'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_ABOUT                   // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'about_hidden_section');
        register_setting(self::SUB_GROUP, 'about_title_fr');
        register_setting(self::SUB_GROUP, 'about_title_en');
        register_setting(self::SUB_GROUP, 'about_title_it');

        /**
         * SECTION 2 : SECTION_ABOUT_INFO =================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_ABOUT_INFO,                 // SLUG_SECTION
            __("Gérer les éléments", 'MyCV'),             // TITLE
            [self::class, 'display_section_about_info'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );
        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'about_info_element',                    // SLUG_FIELD
            __("Ce qui doit être présent", 'MyCV'),      // LABEL
            [self::class,'field_about_info_element'],    // CALLBACK
            self::SUB_GROUP ,                      // SLUG_PAGE
            self::SECTION_ABOUT_INFO             // SLUG_SECTION
        );
        add_settings_field(
            'about_choose_picture',                  // SLUG_FIELD
            __("Choisir l'image", 'MyCV'),              // LABEL
            [self::class,'field_about_choose_picture'], // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_ABOUT_INFO            // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'about_show_fullname');
        register_setting(self::SUB_GROUP, 'about_show_age');
        register_setting(self::SUB_GROUP, 'about_show_country');
        register_setting(self::SUB_GROUP, 'about_show_job');
        register_setting(self::SUB_GROUP, 'about_show_picture');

        /**
         * SECTION 3 : SECTION_ABOUT_CALLTOACTION =========================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_ABOUT_CALLTOACTION,                 // SLUG_SECTION
            __("Call To Action", 'MyCV'),                        // TITLE
            [self::class, 'display_section_about_colltoaction'], // CALLBACK
            self::SUB_GROUP                                // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'about_show_btn_download',                    // SLUG_FIELD
            __('Bouton "Télécharger CV"', 'MyCV'),            // LABEL
            [self::class,'field_about_show_btn_download'],   // CALLBACK
            self::SUB_GROUP ,                          // SLUG_PAGE
            self::SECTION_ABOUT_CALLTOACTION         // SLUG_SECTION
        );
        add_settings_field(
            'about_show_btn_portfolio',                 // SLUG_FIELD
            __('Bouton "Portfolio"', 'MyCV'),               // LABEL
            [self::class,'field_about_show_btn_portfolio'], // CALLBACK
            self::SUB_GROUP ,                        // SLUG_PAGE
            self::SECTION_ABOUT_CALLTOACTION        // SLUG_SECTION
        );

        add_settings_field(
            'about_show_btn_contact',                   // SLUG_FIELD
            __('Bouton "Contact"', 'MyCV'),                 // LABEL
            [self::class,'field_about_show_btn_contact'],   // CALLBACK
            self::SUB_GROUP ,                         // SLUG_PAGE
            self::SECTION_ABOUT_CALLTOACTION        // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP,'about_add_btn_download');
        register_setting(self::SUB_GROUP,'about_show_icon_download');
        register_setting(self::SUB_GROUP,'about_add_btn_portfolio');
        register_setting(self::SUB_GROUP,'about_show_icon_portfolio');
        register_setting(self::SUB_GROUP,'about_add_btn_contact');
        register_setting(self::SUB_GROUP,'about_show_icon_contact');
    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */


    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */
    // SECTION 1 : SECTION_ABOUT ======================================
    public static function display_section_about(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage de la section", "MyCV"); ?>
        </p>
        <?php
    }

    // SECTION 2 : SECTION_ABOUT_INFO =================================
    public static function display_section_about_info(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage de vos information", "MyCV") ?>
        </p>
        <?php
    }

    // SECTION 3 : SECTION_ABOUT_CALLTOACTION =========================
    public static function display_section_about_colltoaction(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage des call-to-action présent dans la section", "MyCV"); ?>
        </p>
        <?php
    }

    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 1 : SECTION_ABOUT ======================================
    public static function field_about_hidden_section(){
        $about_hidden_section = get_option('about_hidden_section');
        ?>
        <input type="checkbox" id="about_hidden_section" name="about_hidden_section" value="1" <?php checked(1, $about_hidden_section, true) ?> />
        <label for=""><?php _e("Masquer la section about du theme", "MyCV"); ?></label>
        <?php
    }
    public static function field_about_title_section(){
        $about_title_fr = esc_attr(get_option('about_title_fr'));
        $about_title_en = esc_attr(get_option('about_title_en'));
        $about_title_it = esc_attr(get_option('about_title_it'));
        ?>
        <p class="description"><?php _e("Définir le titre de la section", "MyCV"); ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e("Français", "mycv") ?></p>
                <input type="text"
                       id="about_title_fr"
                       name="about_title_fr"
                       value="<?php echo $about_title_fr ?>"
                       placeholder="<?php _e("Texte en français", "mycv") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Anglais", "mycv") ?></p>
                <input type="text"
                       id="about_title_en"
                       name="about_title_en"
                       value="<?php echo $about_title_en ?>"
                       placeholder="<?php _e("Texte en anglais", "mycv") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Italien", "mycv") ?></p>
                <input type="text"
                       id="about_title_it"
                       name="about_title_it"
                       value="<?php echo $about_title_it ?>"
                       placeholder="<?php _e("Texte en italien", "mycv") ?>"
                />
            </div>
        </div>

        <?php
    }

    // SECTION 2 : SECTION_ABOUT_INFO =================================
    public static function field_about_info_element(){
        $about_show_fullname = get_option('about_show_fullname');
        $about_show_age = get_option('about_show_age');
        $about_show_country = get_option('about_show_country');
        $about_show_job = get_option('about_show_job');
        ?>
        <p class="description"><?php _e("Cocher ce qui doit être présent", "MyCV") ?></p>
        <p>
            <input type="checkbox" id="about_show_fullname" name="about_show_fullname" value="1" <?php checked(1, $about_show_fullname, true) ?> />
            <label for=""><?php _e("Nom complet", "MyCV"); ?></label>
        </p>
        <p>
            <input type="checkbox" id="about_show_age" name="about_show_age" value="1" <?php checked(1, $about_show_age, true) ?> />
            <label for=""><?php _e("Âge", "MyCV"); ?></label>
        </p>
        <p>
            <input type="checkbox" id="about_show_country" name="about_show_country" value="1" <?php checked(1, $about_show_country, true) ?> />
            <label for=""><?php _e("Ville", "MyCV"); ?></label>
        </p>
        <p>
            <input type="checkbox" id="about_show_job" name="about_show_job" value="1" <?php checked(1, $about_show_job, true) ?> />
            <label for=""><?php _e("Métier", "MyCV"); ?></label>
        </p>
        <?php
    }

    public static function field_about_choose_picture(){
        $about_show_picture = get_option('about_show_picture');
        ?>
        <p class="description"><?php _e("Choisir l'image à afficher", "MyCV"); ?></p>
        <p>
            <input type="radio" name="about_show_picture" value="1" <?php checked(1, $about_show_picture, true) ?> />
            <label for=""><?php _e("Avatar", "MyCV") ?></label>
        </p>
        <p>
            <input type="radio" name="about_show_picture" value="2" <?php checked(2 ,$about_show_picture, true) ?> />
            <label for=""><?php _e("Profile", "MyCV") ?></label>
        </p>
        <?php
    }

    // SECTION 3 : SECTION_ABOUT_CALLTOACTION =========================
    public static function field_about_show_btn_download(){
        $about_add_btn_download = get_option('about_add_btn_download');
        $about_show_icon_download = get_option('about_show_icon_download');
        ?>

        <p>
            <input type="checkbox" id="about_add_btn_download" name="about_add_btn_download" value="1" <?php checked(1, $about_add_btn_download, true) ?> />
            <label for=""><?php _e("Afficher le bouton", "MyCV"); ?></label>
        </p>
        <p>
            <input type="checkbox" id="about_show_icon_download" name="about_show_icon_download" value="1" <?php checked(1, $about_show_icon_download, true) ?> />
            <label for=""><?php _e("Afficher l'îcone", "MyCV"); ?></label>
        </p>
        <?php
    }
    public static function field_about_show_btn_portfolio(){
        $about_add_btn_portfolio = get_option('about_add_btn_portfolio');
        $about_show_icon_portfolio = get_option('about_show_icon_portfolio');
        ?>

        <p>
            <input type="checkbox" id="about_add_btn_portfolio" name="about_add_btn_portfolio" value="1" <?php checked(1, $about_add_btn_portfolio, true) ?> />
            <label for=""><?php _e("Afficher le bouton", "MyCV"); ?></label>
        </p>
        <p>
            <input type="checkbox" id="about_show_icon_portfolio" name="about_show_icon_portfolio" value="1" <?php checked(1, $about_show_icon_portfolio, true) ?> />
            <label for=""><?php _e("Afficher l'îcone", "MyCV"); ?></label>
        </p>
        <?php
    }
    public static function field_about_show_btn_contact(){
        $about_add_btn_contact = get_option('about_add_btn_contact');
        $about_show_icon_contact = get_option('about_show_icon_contact');
        ?>
        <p>
            <input type="checkbox" id="about_add_btn_contact" name="about_add_btn_contact" value="1" <?php checked(1, $about_add_btn_contact, true) ?> />
            <label for=""><?php _e("Afficher le bouton", "MyCV"); ?></label>
        </p>
        <p>
            <input type="checkbox" id="about_show_icon_contact" name="about_show_icon_contact" value="1" <?php checked(1, $about_show_icon_contact, true) ?> />
            <label for=""><?php _e("Afficher l'îcone", "MyCV"); ?></label>
        </p>
        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycustome_about')){
    mycustome_about::register();
}