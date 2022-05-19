<?php
/**
 * Name file: 09-errorpage
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


class mycustome_errorpage{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION    = 'manage_options';
    const SUB_GROUP    = 'mycustome_errorpage';
    const NONCE        = '_mycustome_errorpage';

    //definir les sections de la page d'option
    const SECTION_ERRORPAGE    = 'section_errorpage';
    const SECTION_ERRORPAGE_FR = 'section_errorpage_fr';
    const SECTION_ERRORPAGE_EN = 'section_errorpage_en';
    const SECTION_ERRORPAGE_IT = 'section_errorpage_it';

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
            __('Error Page', 'MyCV'),                    // page_title
            __('Error Page', 'MyCV'),                    // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e( 'Personnaliser la page d\'erreur 404', 'MyCV') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer la page d\'error 404 du site', 'MyCV') ?>
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
         * SECTION 1 : SECTION_ERRORPAGE ===================================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_ERRORPAGE,                   // SLUG_SECTION
            __('Gérer la section', 'MyCV'), // TITLE
            [self::class, 'display_section_errorpage'],    // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'element_errorpage',                  // SLUG_FIELD
            __("Ce qui doit être présent", 'MyCV'),            // LABEL
            [self::class,'field_element_errorpage'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_ERRORPAGE                   // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'errorpage_btn_homepage');

        /**
         * SECTION 2 : SECTION_ERRORPAGE_FR ================================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_ERRORPAGE_FR,                   // SLUG_SECTION
            __('Gérer les messages (en français)', 'MyCV'), // TITLE
            [self::class, 'display_section_errorpage_fr'],    // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'type_error_fr',                  // SLUG_FIELD
            __("Type d'erreur", 'MyCV'),            // LABEL
            [self::class,'field_type_error_fr'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_ERRORPAGE_FR                   // SLUG_SECTION
        );
        add_settings_field(
            'maintext_error_fr',                  // SLUG_FIELD
            __("Texte principal", 'MyCV'),            // LABEL
            [self::class,'field_maintext_error_fr'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_ERRORPAGE_FR                   // SLUG_SECTION
        );
        add_settings_field(
            'message_error_fr',                  // SLUG_FIELD
            __("Message d'erreur", 'MyCV'),            // LABEL
            [self::class,'field_message_error_fr'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_ERRORPAGE_FR                   // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'maintext_error_fr');
        register_setting(self::SUB_GROUP, 'message_error_fr');

        /**
         * SECTION 3 : SECTION_ERRORPAGE_EN ================================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_ERRORPAGE_EN,                   // SLUG_SECTION
            __('Gérer les messages (en anglais)', 'MyCV'), // TITLE
            [self::class, 'display_section_errorpage_en'],    // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'type_error_en',                  // SLUG_FIELD
            __("Type d'erreur", 'MyCV'),            // LABEL
            [self::class,'field_type_error_en'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_ERRORPAGE_EN                   // SLUG_SECTION
        );
        add_settings_field(
            'maintext_error_en',                  // SLUG_FIELD
            __("Texte principal", 'MyCV'),            // LABEL
            [self::class,'field_maintext_error_en'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_ERRORPAGE_EN                   // SLUG_SECTION
        );
        add_settings_field(
            'message_error_en',                  // SLUG_FIELD
            __("Message d'erreur", 'MyCV'),            // LABEL
            [self::class,'field_message_error_en'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_ERRORPAGE_EN                   // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'maintext_error_en');
        register_setting(self::SUB_GROUP, 'message_error_en');

        /**
         * SECTION 4 : SECTION_ERRORPAGE_IT ================================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_ERRORPAGE_IT,                   // SLUG_SECTION
            __('Gérer les messages (en italien)', 'MyCV'), // TITLE
            [self::class, 'display_section_errorpage_it'],    // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'type_error_it',                  // SLUG_FIELD
            __("Type d'erreur", 'MyCV'),            // LABEL
            [self::class,'field_type_error_it'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_ERRORPAGE_IT                   // SLUG_SECTION
        );
        add_settings_field(
            'maintext_error_it',                  // SLUG_FIELD
            __("Texte principal", 'MyCV'),            // LABEL
            [self::class,'field_maintext_error_it'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_ERRORPAGE_IT                   // SLUG_SECTION
        );
        add_settings_field(
            'message_error_it',                  // SLUG_FIELD
            __("Message d'erreur", 'MyCV'),            // LABEL
            [self::class,'field_message_error_it'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_ERRORPAGE_IT                   // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'maintext_error_it');
        register_setting(self::SUB_GROUP, 'message_error_it');
    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
    */
    // SECTION 1 : SECTION_ERRORPAGE ===================================================
    public static function display_section_errorpage(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage de la section", "MyCV"); ?>
        </p>
        <?php
    }
    // SECTION 2 : SECTION_ERRORPAGE_FR ================================================
    public static function display_section_errorpage_fr(){
        ?>
        <p class="section-description">
            <?php _e("Gestion du message d'erreur en français", "MyCV"); ?>
        </p>
        <?php
    }

    // SECTION 3 : SECTION_ERRORPAGE_EN ================================================
    public static function display_section_errorpage_en(){
        ?>
        <p class="section-description">
            <?php _e("Gestion du message d'erreur en anglais", "MyCV"); ?>
        </p>
        <?php
    }

    // SECTION 4 : SECTION_ERRORPAGE_IT ================================================
    public static function display_section_errorpage_it(){
        ?>
        <p class="section-description">
            <?php _e("Gestion du message d'erreur en italien", "MyCV"); ?>
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
    // SECTION 1 : SECTION_ERRORPAGE ===================================================
    public static function field_element_errorpage(){
        $errorpage_btn_homepage = get_option('errorpage_btn_homepage');
        ?>
        <p class="description"><?php _e("Cocher ce qui doit être présent", "MyCV") ?></p>
        <p>
            <input type="checkbox" name="errorpage_btn_homepage" id="errorpage_btn_homepage" value="1" <?php checked(1, $errorpage_btn_homepage, true) ?> />
            <label for=""><?php _e("Button page d'accueil", "MyCV"); ?></label>
        </p>
        <?php
    }

    // SECTION 2 : SECTION_ERRORPAGE_FR ================================================
    public static function field_type_error_fr(){
        ?>
        <p class=""><?php _e("Erreur 404", "MyCV"); ?></p>
        <?php
    }
    public static function field_maintext_error_fr(){
        $maintext_error_fr = esc_attr(get_option('maintext_error_fr'));
        ?>
        <p class=""><?php _e("Définir le texte principal", "MyCV"); ?></p>
        <input type="text"
               id="maintext_error_fr"
               name="maintext_error_fr"
               value="<?php echo $maintext_error_fr ?>"
               class="large-text"
               placeholder="<?php _e("Ex: Oups! Une erreur s'est produite", "MyCV"); ?>"
        />
        <?php
    }
    public static function field_message_error_fr(){
        $message_error_fr = get_option('message_error_fr');
        $args = array(
            'media_buttons'    => false,
            'textarea_name'    => 'message_error_fr',
            'textarea_rows'    => 20,
            'teeny'            => true,
            'tinymce'          => true,
            'drag_drop_upload' => true,
        );
        // call hooks wp_editor()
        $content = wp_editor($message_error_fr, 'message_error_fr', $args);

        echo $content;
    }

    // SECTION 3 : SECTION_ERRORPAGE_EN ================================================
    public static function field_type_error_en(){
        ?>
        <p class=""><?php _e("Erreur 404", "MyCV"); ?></p>
        <?php
    }
    public static function field_maintext_error_en(){
        $maintext_error_en = esc_attr(get_option('maintext_error_en'));
        ?>
        <p class=""><?php _e("Définir le texte principal", "MyCV"); ?></p>
        <input type="text"
               id="maintext_error_en"
               name="maintext_error_en"
               value="<?php echo $maintext_error_en ?>"
               class="large-text"
               placeholder="<?php _e("Ex: Oups! Une erreur s'est produite", "MyCV"); ?>"
        />
        <?php
    }
    public static function field_message_error_en(){
        $message_error_en = get_option('message_error_en');
        $args = array(
            'media_buttons'    => false,
            'textarea_name'    => 'message_error_en',
            'textarea_rows'    => 20,
            'teeny'            => true,
            'tinymce'          => true,
            'drag_drop_upload' => true,
        );
        // call hooks wp_editor()
        $content = wp_editor($message_error_en, 'message_error_en', $args);

        echo $content;
    }

    // SECTION 4 : SECTION_ERRORPAGE_IT ================================================
    public static function field_type_error_it(){
        ?>
        <p class=""><?php _e("Erreur 404", "MyCV"); ?></p>
        <?php
    }
    public static function field_maintext_error_it(){
        $maintext_error_it = esc_attr(get_option('maintext_error_it'));
        ?>
        <p class=""><?php _e("Définir le texte principal", "MyCV"); ?></p>
        <input type="text"
               id="maintext_error_it"
               name="maintext_error_it"
               value="<?php echo $maintext_error_it ?>"
               class="large-text"
               placeholder="<?php _e("Ex: Oups! Une erreur s'est produite", "MyCV"); ?>"
        />
        <?php
    }
    public static function field_message_error_it(){
        $message_error_it = get_option('message_error_it');
        $args = array(
            'media_buttons'    => false,
            'textarea_name'    => 'message_error_it',
            'textarea_rows'    => 20,
            'teeny'            => true,
            'tinymce'          => true,
            'drag_drop_upload' => true,
        );
        // call hooks wp_editor()
        $content = wp_editor($message_error_it, 'message_error_it', $args);

        echo $content;
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycustome_errorpage')){
    mycustome_errorpage::register();
}