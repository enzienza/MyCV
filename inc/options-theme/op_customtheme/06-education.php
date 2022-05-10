<?php
/**
 * Name file: 05-e
 * Description: This file is manage the education section
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


class mycustome_education{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION    = 'manage_options';
    const SUB_GROUP    = 'mycustome_education';
    const NONCE        = '_mycustome_education';

    //definir les sections de la page d'option
    const SECTION_EDUCATION = "section_education";
    const SECTION_EDUCATION_FR = "section_education_fr";
    const SECTION_EDUCATION_EN = "section_education_en";
    const SECTION_EDUCATION_IT = "section_education_it";

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
            __('Education', 'MyCV'),                    // page_title
            __('Education', 'MyCV'),                    // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e( 'Personnaliser la section "Éducation"', 'MyCV') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer la section des éducations du site', 'MyCV') ?>
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
         * SECTION 1 : SECTION_EDUCATION =========================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_EDUCATION,                 // SLUG_SECTION
            __('Gérer la section', 'MyCV'),                 // TITLE
            [self::class, 'display_section_education'],  // CALLBACK
            self::SUB_GROUP                   // SLUG_PAGE
        );
        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'education_hidden_section',                  // SLUG_FIELD
            __("Cacher la section", 'MyCV'),            // LABEL
            [self::class,'field_education_hidden_section'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_EDUCATION                   // SLUG_SECTION
        );
        add_settings_field(
            'education_title_section',                  // SLUG_FIELD
            __("Titre section", 'MyCV'),            // LABEL
            [self::class,'field_education_title_section'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_EDUCATION                   // SLUG_SECTION
        );

        add_settings_field(
            'education_show_desc_section',                  // SLUG_FIELD
            __("Description section", 'MyCV'),            // LABEL
            [self::class,'field_education_show_desc_section'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_EDUCATION                   // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'education_hidden_section');
        register_setting(self::SUB_GROUP, 'education_title_fr');
        register_setting(self::SUB_GROUP, 'education_title_en');
        register_setting(self::SUB_GROUP, 'education_title_it');
        register_setting(self::SUB_GROUP, 'education_show_desc');


        /**
         * SECTION 2 : SECTION_EDUCATION_FR ======================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_EDUCATION_FR,                    // SLUG_SECTION
            __('Gérer les messages (en français)', 'MyCV'), // TITLE
            [self::class, 'display_section_education_fr'],     // CALLBACK
            self::SUB_GROUP                          // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'education_desc_fr',                  // SLUG_FIELD
            __("Message pour la description", 'MyCV'), // LABEL
            [self::class,'field_education_desc_fr'],  // CALLBACK
            self::SUB_GROUP ,                // SLUG_PAGE
            self::SECTION_EDUCATION_FR        // SLUG_SECTION
        );

        add_settings_field(
            'education_else_msg_fr',                  // SLUG_FIELD
            __("Message pour la boucle", 'MyCV'),      // LABEL
            [self::class,'field_education_else_msg_fr'],  // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_EDUCATION_FR            // SLUG_SECTION
        );
        
        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'education_desc_fr');
        register_setting(self::SUB_GROUP, 'education_else_msg_fr');

        /**
         * SECTION 3 : SECTION_EDUCATION_EN ======================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_EDUCATION_EN,                   // SLUG_SECTION
            __('Gérer les messages (en anglais)', 'MyCV'), // TITLE
            [self::class, 'display_section_education_en'],    // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'education_desc_en',                      // SLUG_FIELD
            __("Message pour la description", 'MyCV'), // LABEL
            [self::class,'field_education_desc_en'],      // CALLBACK
            self::SUB_GROUP ,                   // SLUG_PAGE
            self::SECTION_EDUCATION_EN            // SLUG_SECTION
        );

        add_settings_field(
            'education_else_msg_en',                  // SLUG_FIELD
            __("Message pour la boucle", 'MyCV'),      // LABEL
            [self::class,'field_education_else_msg_en'],  // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_EDUCATION_EN            // SLUG_SECTION
        );
        
        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'education_desc_en');
        register_setting(self::SUB_GROUP, 'education_else_msg_en');


        /**
         * SECTION 4 : SECTION_EDUCATION_IT ======================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_EDUCATION_IT,                 // SLUG_SECTION
            __('Gérer les messages (en italien)', 'MyCV'),  // TITLE
            [self::class, 'display_section_education_it'],  // CALLBACK
            self::SUB_GROUP                   // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'education_desc_it',                  // SLUG_FIELD
            __("Message pour la description", 'MyCV'), // LABEL
            [self::class,'field_education_desc_it'],  // CALLBACK
            self::SUB_GROUP ,                // SLUG_PAGE
            self::SECTION_EDUCATION_IT        // SLUG_SECTION
        );

        add_settings_field(
            'education_else_msg_it',                  // SLUG_FIELD
            __("Message pour la boucle", 'MyCV'),      // LABEL
            [self::class,'field_education_else_msg_it'],  // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_EDUCATION_IT            // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'education_desc_it');
        register_setting(self::SUB_GROUP, 'education_else_msg_it');

    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_EDUCATION =========================================
    public static function display_section_education(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage de la section", "MyCV") ?>
        </p>
        <?php
    }

    // SECTION 2 : SECTION_EDUCATION_FR ======================================
    public static function display_section_education_fr(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer les messages de la section en français", "MyCV") ?>
        </p>
        <?php
    }

    // SECTION 3 : SECTION_EDUCATION_EN ======================================
    public static function display_section_education_en(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer les messages de la section en anglais", "MyCV") ?>
        </p>
        <?php
    }

    // SECTION 4 : SECTION_EDUCATION_IT ======================================
    public static function display_section_education_it(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer les messages de la section en italien", "MyCV") ?>
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
    // SECTION 1 : SECTION_EDUCATION =========================================
    public static function field_education_hidden_section(){
        $education_hidden_section = get_option('education_hidden_section');
        ?>
        <input type="checkbox" id="education_hidden_section" name="education_hidden_section" value="1" <?php checked(1, $education_hidden_section, true) ?> />
        <label for=""><?php _e("Masquer la section education du theme", "MyCV"); ?></label>
        <?php
    }
    public static function field_education_title_section(){
        $education_title_fr = esc_attr(get_option('education_title_fr'));
        $education_title_en = esc_attr(get_option('education_title_en'));
        $education_title_it = esc_attr(get_option('education_title_it'));
        ?>
        <p class="description"><?php _e("Définir le titre de la section", "MyCV"); ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e("Français", "MyCV") ?></p>
                <input type="text"
                       id="education_title_fr"
                       name="education_title_fr"
                       value="<?php echo $education_title_fr ?>"
                       placeholder="<?php _e("Texte en français", "MyCV") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Anglais", "MyCV") ?></p>
                <input type="text"
                       id="education_title_en"
                       name="education_title_en"
                       value="<?php echo $education_title_en ?>"
                       placeholder="<?php _e("Texte en anglais", "MyCV") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Italien", "MyCV") ?></p>
                <input type="text"
                       id="education_title_it"
                       name="education_title_it"
                       value="<?php echo $education_title_it ?>"
                       placeholder="<?php _e("Texte en italien", "MyCV") ?>"
                />
            </div>
        </div>
        <?php
    }
    public static function field_education_show_desc_section(){
        $education_show_desc = get_option('education_show_desc');
        ?>
        <input type="checkbox" id="education_show_desc" name="education_show_desc" value="1" <?php checked(1, $education_show_desc, true) ?> />
        <label for=""><?php _e("Afficher une description à la section", "MyCV"); ?></label>
        <?php
    }

    // SECTION 2 : SECTION_EDUCATION_FR ======================================
    public static function field_education_desc_fr(){
        // define register settings
        $education_desc_fr = esc_attr(get_option('education_desc_fr'));
        // define argument for editor WYSIWYG
        $args = array(
            'media_buttons'    => false,
            'textarea_name'    => 'education_desc_fr',
            'textarea_rows'    => 20,
            'teeny'            => true,
            'tinymce'          => true,
            'drag_drop_upload' => true,
        );
        ?>
            <div>
                <?php
                    // call hooks wp_editor()
                    $content = wp_editor($education_desc_fr, 'education_desc_fr', $args);

                    echo $content
                ?>
            </div>
        <?php
    }
    public static function field_education_else_msg_fr(){
        $education_else_msg_fr = esc_attr(get_option('education_else_msg_fr'));
        ?>
        <p class="description"><?php _e("Ce message sera présent si la boucle est vide", "MyCV") ?></p>
        <input type="text"
               id="education_else_msg_fr"
               name="education_else_msg_fr"
               value="<?php echo $education_else_msg_fr ?>"
               placeholder="<?php _e("Message court", "MyCV"); ?>"
               class="large-text"
        />
        <?php
    }

    // SECTION 3 : SECTION_EDUCATION_EN ======================================
    public static function field_education_desc_en(){
        $education_desc_en = esc_attr(get_option('education_desc_en'));
        // define argument for editor WYSIWYG
        $args = array(
            'media_buttons'    => false,
            'textarea_name'    => 'education_desc_en',
            'textarea_rows'    => 20,
            'teeny'            => true,
            'tinymce'          => true,
            'drag_drop_upload' => true,
        );
        ?>
        <div>
            <?php
            // call hooks wp_editor()
            $content = wp_editor($education_desc_en, 'education_desc_en', $args);

            echo $content
            ?>
        </div>
        <?php
    }
    public static function field_education_else_msg_en(){
        $education_else_msg_en = esc_attr(get_option('education_else_msg_en'));
        ?>
        <p class="description"><?php _e("Ce message sera présent si la boucle est vide", "MyCV") ?></p>
        <input type="text"
               id="education_else_msg_en"
               name="education_else_msg_en"
               value="<?php echo $education_else_msg_en ?>"
               placeholder="<?php _e("Message court", "MyCV"); ?>"
               class="large-text"
        />
        <?php
    }
    
    // SECTION 4 : SECTION_EDUCATION_IT ======================================
    public static function field_education_desc_it(){
        // define register settings
        $education_desc_it = esc_attr(get_option('education_desc_it'));

        // define argument for editor WYSIWYG
        $args = array(
            'media_buttons'    => false,
            'textarea_name'    => 'education_desc_it',
            'textarea_rows'    => 20,
            'teeny'            => true,
            'tinymce'          => true,
            'drag_drop_upload' => true,
        );
        ?>
        <div>
            <?php
            // call hooks wp_editor()
            $content = wp_editor($education_desc_it, 'education_desc_it', $args);

            echo $content
            ?>
        </div>
        <?php
    }
    public static function field_education_else_msg_it(){
        $education_else_msg_it = esc_attr(get_option('education_else_msg_it'));
        ?>
        <p class="description"><?php _e("Ce message sera présent si la boucle est vide", "MyCV") ?></p>
        <input type="text"
               id="education_else_msg_it"
               name="education_else_msg_it"
               value="<?php echo $education_else_msg_it ?>"
               placeholder="<?php _e("Message court", "MyCV"); ?>"
               class="large-text"
        />
        <?php
    }
    
    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycustome_education')){
    mycustome_education::register();
}