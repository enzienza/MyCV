<?php
/**
 * Name file: 06-skills
 * Description: This file is manage the skill section
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


class mycustome_skill{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION    = 'manage_options';
    const SUB_GROUP    = 'mycustome_skill';
    const NONCE        = '_mycustome_skill';

    //definir les sections de la page d'option
    const SECTION_SKILL      = "section_skill";
    const SECTION_SKILL_LOOP = "section_skill_loop";
    const SECTION_SKILL_FR   = "section_skill_fr";
    const SECTION_SKILL_EN   = "section_skill_en";
    const SECTION_SKILL_IT   = "section_skill_it";

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
            __('Skill', 'MyCV'),                    // page_title
            __('Skill', 'MyCV'),                    // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e( 'Personnaliser la section skill', 'MyCV') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer la section des skills du site', 'MyCV') ?>
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
         * SECTION 1 : SECTION_SKILL =========================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_SKILL,                 // SLUG_SECTION
            __('Gérer la section', 'MyCV'),                 // TITLE
            [self::class, 'display_section_skill'],  // CALLBACK
            self::SUB_GROUP                   // SLUG_PAGE
        );
        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'skill_hidden_section',                  // SLUG_FIELD
            __("Cacher la section", 'MyCV'),            // LABEL
            [self::class,'field_skill_hidden_section'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_SKILL                   // SLUG_SECTION
        );
        add_settings_field(
            'skill_title_section',                  // SLUG_FIELD
            __("Titre section", 'MyCV'),            // LABEL
            [self::class,'field_skill_title_section'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_SKILL                   // SLUG_SECTION
        );

        add_settings_field(
            'skill_show_desc_section',                  // SLUG_FIELD
            __("Description section", 'MyCV'),            // LABEL
            [self::class,'field_skill_show_desc_section'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_SKILL                   // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'skill_hidden_section');
        register_setting(self::SUB_GROUP, 'skill_title_fr');
        register_setting(self::SUB_GROUP, 'skill_title_en');
        register_setting(self::SUB_GROUP, 'skill_title_it');
        register_setting(self::SUB_GROUP, 'skill_show_desc');


        /**
         * SECTION 2 : SECTION_SKILL_LOOP =====================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_SKILL_LOOP,                    // SLUG_SECTION
            __('Gérer la boucle', 'MyCV'), // TITLE
            [self::class, 'display_section_skill_loop'],     // CALLBACK
            self::SUB_GROUP                          // SLUG_PAGE
        );
        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'skill_emoji_loop',                  // SLUG_FIELD
            __("Émoji", 'MyCV'), // LABEL
            [self::class,'field_skill_emoji_loop'],  // CALLBACK
            self::SUB_GROUP ,                // SLUG_PAGE
            self::SECTION_SKILL_LOOP        // SLUG_SECTION
        );
        add_settings_field(
            'skill_msg_loop',                  // SLUG_FIELD
            __("Message boucle", 'MyCV'), // LABEL
            [self::class,'field_skill_msg_loop'],  // CALLBACK
            self::SUB_GROUP ,                // SLUG_PAGE
            self::SECTION_SKILL_LOOP        // SLUG_SECTION
        );
        
        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'skill_emoji_loop');
        register_setting(self::SUB_GROUP, 'skill_loop_fr');
        register_setting(self::SUB_GROUP, 'skill_loop_en');
        register_setting(self::SUB_GROUP, 'skill_loop_it');

        /**
         * SECTION 3 : SECTION_SKILL_FR ======================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_SKILL_FR,                    // SLUG_SECTION
            __('Gérer les messages (en français)', 'MyCV'), // TITLE
            [self::class, 'display_section_skill_fr'],     // CALLBACK
            self::SUB_GROUP                          // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'skill_desc_fr',                  // SLUG_FIELD
            __("Message pour la description", 'MyCV'), // LABEL
            [self::class,'field_skill_desc_fr'],  // CALLBACK
            self::SUB_GROUP ,                // SLUG_PAGE
            self::SECTION_SKILL_FR        // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'skill_desc_fr');

        /**
         * SECTION 4 : SECTION_SKILL_EN ======================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_SKILL_EN,                   // SLUG_SECTION
            __('Gérer les messages (en anglais)', 'MyCV'), // TITLE
            [self::class, 'display_section_skill_en'],    // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'skill_desc_en',                      // SLUG_FIELD
            __("Message pour la description", 'MyCV'), // LABEL
            [self::class,'field_skill_desc_en'],      // CALLBACK
            self::SUB_GROUP ,                   // SLUG_PAGE
            self::SECTION_SKILL_EN            // SLUG_SECTION
        );


        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'skill_desc_en');


        /**
         * SECTION 5 : SECTION_SKILL_IT ======================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_SKILL_IT,                 // SLUG_SECTION
            __('Gérer les messages (en italien)', 'MyCV'),  // TITLE
            [self::class, 'display_section_skill_it'],  // CALLBACK
            self::SUB_GROUP                   // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'skill_desc_it',                  // SLUG_FIELD
            __("Message pour la description", 'MyCV'), // LABEL
            [self::class,'field_skill_desc_it'],  // CALLBACK
            self::SUB_GROUP ,                // SLUG_PAGE
            self::SECTION_SKILL_IT        // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'skill_desc_it');

    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_SKILL =========================================
    public static function display_section_skill(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage de la section", "MyCV") ?>
        </p>
        <?php
    }

    // SECTION 2 : SECTION_SKILL_LOOP =====================================
    public static function display_section_skill_loop(){
        ?>
        <p class="section-description">
            <?php _e("Cette parite vous permet de gérer la boucle", "MyCV"); ?>
        </p>
        <?php
    }

    // SECTION 3 : SECTION_SKILL_FR ======================================
    public static function display_section_skill_fr(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer les messages de la section en français", "MyCV") ?>
        </p>
        <?php
    }

    // SECTION 4 : SECTION_SKILL_EN ======================================
    public static function display_section_skill_en(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer les messages de la section en anglais", "MyCV") ?>
        </p>
        <?php
    }

    // SECTION 5 : SECTION_SKILL_IT ======================================
    public static function display_section_skill_it(){
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
    // SECTION 1 : SECTION_SKILL =========================================
    public static function field_skill_hidden_section(){
        $skill_hidden_section = get_option('skill_hidden_section');
        ?>
        <input type="checkbox" id="skill_hidden_section" name="skill_hidden_section" value="1" <?php checked(1, $skill_hidden_section, true) ?> />
        <label for=""><?php _e("Masquer la section skill du theme", "MyCV"); ?></label>
        <?php
    }
    public static function field_skill_title_section(){
        $skill_title_fr = esc_attr(get_option('skill_title_fr'));
        $skill_title_en = esc_attr(get_option('skill_title_en'));
        $skill_title_it = esc_attr(get_option('skill_title_it'));
        ?>
        <p class="description"><?php _e("Définir le titre de la section", "MyCV"); ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e("Français", "MyCV") ?></p>
                <input type="text"
                       id="skill_title_fr"
                       name="skill_title_fr"
                       value="<?php echo $skill_title_fr ?>"
                       placeholder="<?php _e("Texte en français", "MyCV") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Anglais", "MyCV") ?></p>
                <input type="text"
                       id="skill_title_en"
                       name="skill_title_en"
                       value="<?php echo $skill_title_en ?>"
                       placeholder="<?php _e("Texte en anglais", "MyCV") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Italien", "MyCV") ?></p>
                <input type="text"
                       id="skill_title_it"
                       name="skill_title_it"
                       value="<?php echo $skill_title_it ?>"
                       placeholder="<?php _e("Texte en italien", "MyCV") ?>"
                />
            </div>
        </div>
        <?php
    }
    public static function field_skill_show_desc_section(){
        $skill_show_desc = get_option('skill_show_desc');
        ?>
        <input type="checkbox" id="skill_show_desc" name="skill_show_desc" value="1" <?php checked(1, $skill_show_desc, true) ?> />
        <label for=""><?php _e("Afficher une description à la section", "MyCV"); ?></label>
        <?php
    }

    // SECTION 2 : SECTION_SKILL_LOOP =====================================
    public static function field_skill_emoji_loop(){
        $skill_emoji_loop = get_option('skill_emoji_loop');
        ?>
        <input type="checkbox" id="skill_emoji_loop" name="skill_emoji_loop" value="1" <?php checked(1, $skill_emoji_loop, true) ?> />
        <label for=""><?php _e("Afficher un émoji", "MyCV"); ?> &#128549;</label>
        <?php
    }
    public static function field_skill_msg_loop(){
        $skill_loop_fr = esc_attr(get_option('skill_loop_fr'));
        $skill_loop_en = esc_attr(get_option('skill_loop_en'));
        $skill_loop_it = esc_attr(get_option('skill_loop_it'));
        ?>
        <p class="description"><?php _e("Ce message sera présent si la boucle est vide", "MyCV"); ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e("Français", "MyCV") ?></p>
                <input type="text"
                       id="skill_loop_fr"
                       name="skill_loop_fr"
                       value="<?php echo $skill_loop_fr ?>"
                       placeholder="<?php _e("Texte en français", "MyCV") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Anglais", "MyCV") ?></p>
                <input type="text"
                       id="skill_loop_en"
                       name="skill_loop_en"
                       value="<?php echo $skill_loop_en ?>"
                       placeholder="<?php _e("Texte en anglais", "MyCV") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Italien", "MyCV") ?></p>
                <input type="text"
                       id="skill_loop_it"
                       name="skill_loop_it"
                       value="<?php echo $skill_loop_it ?>"
                       placeholder="<?php _e("Texte en italien", "MyCV") ?>"
                />
            </div>
        </div>
        <?php
    }

    // SECTION 3 : SECTION_SKILL_FR ======================================
    public static function field_skill_desc_fr(){
        // define register settings
        $skill_desc_fr = esc_attr(get_option('skill_desc_fr'));
        // define argument for editor WYSIWYG
        $args = array(
            'media_buttons'    => false,
            'textarea_name'    => 'skill_desc_fr',
            'textarea_rows'    => 20,
            'teeny'            => true,
            'tinymce'          => true,
            'drag_drop_upload' => true,
        );
        ?>
            <div>
                <?php
                    // call hooks wp_editor()
                    $content = wp_editor($skill_desc_fr, 'skill_desc_fr', $args);

                    echo $content
                ?>
            </div>
        <?php
    }

    // SECTION 4 : SECTION_SKILL_EN ======================================
    public static function field_skill_desc_en(){
        $skill_desc_en = esc_attr(get_option('skill_desc_en'));
        // define argument for editor WYSIWYG
        $args = array(
            'media_buttons'    => false,
            'textarea_name'    => 'skill_desc_en',
            'textarea_rows'    => 20,
            'teeny'            => true,
            'tinymce'          => true,
            'drag_drop_upload' => true,
        );
        ?>
        <div>
            <?php
            // call hooks wp_editor()
            $content = wp_editor($skill_desc_en, 'skill_desc_en', $args);

            echo $content
            ?>
        </div>
        <?php
    }

    // SECTION 5 : SECTION_SKILL_IT ======================================
    public static function field_skill_desc_it(){
        // define register settings
        $skill_desc_it = esc_attr(get_option('skill_desc_it'));

        // define argument for editor WYSIWYG
        $args = array(
            'media_buttons'    => false,
            'textarea_name'    => 'skill_desc_it',
            'textarea_rows'    => 20,
            'teeny'            => true,
            'tinymce'          => true,
            'drag_drop_upload' => true,
        );
        ?>
        <div>
            <?php
            // call hooks wp_editor()
            $content = wp_editor($skill_desc_it, 'skill_desc_it', $args);

            echo $content
            ?>
        </div>
        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycustome_skill')){
    mycustome_skill::register();
}