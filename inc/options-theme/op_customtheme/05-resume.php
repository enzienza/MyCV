<?php
/**
 * Name file: 05-e
 * Description: This file is manage the resume section
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


class mycustome_resume{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION    = 'manage_options';
    const SUB_GROUP    = 'mycustome_resume';
    const NONCE        = '_mycustome_resume';

    //definir les sections de la page d'option
    const SECTION_RESUME      = "section_resume";
    const SECTION_RESUME_TABS = "section_resume_tabs";
    const SECTION_RESUME_LOOP = "section_resume_loop";
    const SECTION_RESUME_FR   = "section_resume_fr";
    const SECTION_RESUME_EN   = "section_resume_en";
    const SECTION_RESUME_IT   = "section_resume_it";

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
            __('Resume', 'MyCV'),                    // page_title
            __('Resume', 'MyCV'),                    // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e( 'Personnaliser la section resume', 'MyCV') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer la section des resumes du site', 'MyCV') ?>
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
         * SECTION 1 : SECTION_RESUME =========================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_RESUME,                 // SLUG_SECTION
            __('Gérer la section', 'MyCV'),                 // TITLE
            [self::class, 'display_section_resume'],  // CALLBACK
            self::SUB_GROUP                   // SLUG_PAGE
        );
        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'resume_hidden_section',                  // SLUG_FIELD
            __("Cacher la section", 'MyCV'),            // LABEL
            [self::class,'field_resume_hidden_section'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_RESUME                   // SLUG_SECTION
        );
        add_settings_field(
            'resume_title_section',                  // SLUG_FIELD
            __("Titre section", 'MyCV'),            // LABEL
            [self::class,'field_resume_title_section'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_RESUME                   // SLUG_SECTION
        );

        add_settings_field(
            'resume_show_desc_section',                  // SLUG_FIELD
            __("Description section", 'MyCV'),            // LABEL
            [self::class,'field_resume_show_desc_section'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_RESUME                   // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'resume_hidden_section');
        register_setting(self::SUB_GROUP, 'resume_title_fr');
        register_setting(self::SUB_GROUP, 'resume_title_en');
        register_setting(self::SUB_GROUP, 'resume_title_it');
        register_setting(self::SUB_GROUP, 'resume_show_desc');

        /**
         * SECTION 2 : SECTION_RESUME_TABS ====================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_RESUME_TABS,                    // SLUG_SECTION
            __('Gérer les onglets', 'MyCV'), // TITLE
            [self::class, 'display_section_resume_tabs'],     // CALLBACK
            self::SUB_GROUP                          // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'resume_tab_one',                  // SLUG_FIELD
            __("Titre onglet 1", 'MyCV'), // LABEL
            [self::class,'field_resume_tab_one'],  // CALLBACK
            self::SUB_GROUP ,                // SLUG_PAGE
            self::SECTION_RESUME_TABS        // SLUG_SECTION
        );
        add_settings_field(
            'resume_tab_two',                  // SLUG_FIELD
            __("Titre onglet 2", 'MyCV'), // LABEL
            [self::class,'field_resume_tab_two'],  // CALLBACK
            self::SUB_GROUP ,                // SLUG_PAGE
            self::SECTION_RESUME_TABS        // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'resume_tab_one_fr');
        register_setting(self::SUB_GROUP, 'resume_tab_one_en');
        register_setting(self::SUB_GROUP, 'resume_tab_one_it');
        register_setting(self::SUB_GROUP, 'resume_tab_two_fr');
        register_setting(self::SUB_GROUP, 'resume_tab_two_en');
        register_setting(self::SUB_GROUP, 'resume_tab_two_it');

        /**
         * SECTION 3 : SECTION_RESUME_LOOP ======================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_RESUME_LOOP,                    // SLUG_SECTION
            __('Gérer la boucle', 'MyCV'), // TITLE
            [self::class, 'display_section_resume_loop'],     // CALLBACK
            self::SUB_GROUP                          // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'resume_empji_loop',                  // SLUG_FIELD
            __("Émoji", 'MyCV'), // LABEL
            [self::class,'field_resume_empji_loop'],  // CALLBACK
            self::SUB_GROUP ,                // SLUG_PAGE
            self::SECTION_RESUME_LOOP        // SLUG_SECTION
        );
        add_settings_field(
            'resume_msg_loop_1',                  // SLUG_FIELD
            __("Message boucle 1er", 'MyCV'), // LABEL
            [self::class,'field_resume_msg_loop_1'],  // CALLBACK
            self::SUB_GROUP ,                // SLUG_PAGE
            self::SECTION_RESUME_LOOP        // SLUG_SECTION
        );
        add_settings_field(
            'resume_msg_loop_2',                  // SLUG_FIELD
            __("Message boucle 2ème", 'MyCV'), // LABEL
            [self::class,'field_resume_msg_loop_2'],  // CALLBACK
            self::SUB_GROUP ,                // SLUG_PAGE
            self::SECTION_RESUME_LOOP        // SLUG_SECTION
        );
        register_setting(self::SUB_GROUP, 'resume_empji_loop');
        // 1st Loop
        register_setting(self::SUB_GROUP, 'resume_loop1_fr');
        register_setting(self::SUB_GROUP, 'resume_loop1_en');
        register_setting(self::SUB_GROUP, 'resume_loop1_it');
        // 2nd Loop
        register_setting(self::SUB_GROUP, 'resume_loop2_fr');
        register_setting(self::SUB_GROUP, 'resume_loop2_en');
        register_setting(self::SUB_GROUP, 'resume_loop2_it');

        /**
         * SECTION 4 : SECTION_RESUME_FR ======================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_RESUME_FR,                    // SLUG_SECTION
            __('Gérer les messages (en français)', 'MyCV'), // TITLE
            [self::class, 'display_section_resume_fr'],     // CALLBACK
            self::SUB_GROUP                          // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'resume_desc_fr',                  // SLUG_FIELD
            __("Message pour la description", 'MyCV'), // LABEL
            [self::class,'field_resume_desc_fr'],  // CALLBACK
            self::SUB_GROUP ,                // SLUG_PAGE
            self::SECTION_RESUME_FR        // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'resume_desc_fr');

        /**
         * SECTION 5 : SECTION_RESUME_EN ======================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_RESUME_EN,                   // SLUG_SECTION
            __('Gérer les messages (en anglais)', 'MyCV'), // TITLE
            [self::class, 'display_section_resume_en'],    // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'resume_desc_en',                      // SLUG_FIELD
            __("Message pour la description", 'MyCV'), // LABEL
            [self::class,'field_resume_desc_en'],      // CALLBACK
            self::SUB_GROUP ,                   // SLUG_PAGE
            self::SECTION_RESUME_EN            // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'resume_desc_en');


        /**
         * SECTION 6 : SECTION_RESUME_IT ======================================
         *      1. créer la section
         *      2. ajouter les éléments du formulaire
         *      3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_RESUME_IT,                 // SLUG_SECTION
            __('Gérer les messages (en italien)', 'MyCV'),  // TITLE
            [self::class, 'display_section_resume_it'],  // CALLBACK
            self::SUB_GROUP                   // SLUG_PAGE
        );

        // 2. ajouter les éléments du formulaire
        add_settings_field(
            'resume_desc_it',                  // SLUG_FIELD
            __("Message pour la description", 'MyCV'), // LABEL
            [self::class,'field_resume_desc_it'],  // CALLBACK
            self::SUB_GROUP ,                // SLUG_PAGE
            self::SECTION_RESUME_IT        // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'resume_desc_it');

    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_RESUME =========================================
    public static function display_section_resume(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer l'affichage de la section", "MyCV") ?>
        </p>
        <?php
    }

    // SECTION 2 : SECTION_RESUME_TABS ====================================
    public static function display_section_resume_tabs(){
        ?>
        <p class="section-description">
            <?php _e("Cette parite vous permet de gérer les titres (intitulé) des onglets", "MyCV"); ?>
        </p>
        <?php
    }

    // SECTION 3 : SECTION_RESUME_LOOP ====================================
    public static function display_section_resume_loop(){
        ?>
        <p class="section-description">
            <?php _e("Cette parite vous permet de gérer la boucle", "MyCV"); ?>
        </p>
        <?php
    }

    // SECTION 4 : SECTION_RESUME_FR ======================================
    public static function display_section_resume_fr(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer les messages de la section en français", "MyCV") ?>
        </p>
        <?php
    }

    // SECTION 5 : SECTION_RESUME_EN ======================================
    public static function display_section_resume_en(){
        ?>
        <p class="section-description">
            <?php _e("Cette partie vous permet de gérer les messages de la section en anglais", "MyCV") ?>
        </p>
        <?php
    }

    // SECTION 6 : SECTION_RESUME_IT ======================================
    public static function display_section_resume_it(){
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
    // SECTION 1 : SECTION_RESUME =========================================
    public static function field_resume_hidden_section(){
        $resume_hidden_section = get_option('resume_hidden_section');
        ?>
        <input type="checkbox" id="resume_hidden_section" name="resume_hidden_section" value="1" <?php checked(1, $resume_hidden_section, true) ?> />
        <label for=""><?php _e("Masquer la section about du theme", "MyCV"); ?></label>
        <?php
    }
    public static function field_resume_title_section(){
        $resume_title_fr = esc_attr(get_option('resume_title_fr'));
        $resume_title_en = esc_attr(get_option('resume_title_en'));
        $resume_title_it = esc_attr(get_option('resume_title_it'));
        ?>
        <p class="description"><?php _e("Définir le titre de la section", "MyCV"); ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e("Français", "MyCV") ?></p>
                <input type="text"
                       id="resume_title_fr"
                       name="resume_title_fr"
                       value="<?php echo $resume_title_fr ?>"
                       placeholder="<?php _e("Texte en français", "MyCV") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Anglais", "MyCV") ?></p>
                <input type="text"
                       id="resume_title_en"
                       name="resume_title_en"
                       value="<?php echo $resume_title_en ?>"
                       placeholder="<?php _e("Texte en anglais", "MyCV") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Italien", "MyCV") ?></p>
                <input type="text"
                       id="resume_title_it"
                       name="resume_title_it"
                       value="<?php echo $resume_title_it ?>"
                       placeholder="<?php _e("Texte en italien", "MyCV") ?>"
                />
            </div>
        </div>
        <?php
    }
    public static function field_resume_show_desc_section(){
        $resume_show_desc = get_option('resume_show_desc');
        ?>
        <input type="checkbox" id="resume_show_desc" name="resume_show_desc" value="1" <?php checked(1, $resume_show_desc, true) ?> />
        <label for=""><?php _e("Afficher une description à la section", "MyCV"); ?></label>
        <?php
    }

    // SECTION 2 : SECTION_RESUME_TABS ====================================
    public static function field_resume_tab_one(){
        $resume_tab_one_fr = esc_attr(get_option('resume_tab_one_fr'));
        $resume_tab_one_en = esc_attr(get_option('resume_tab_one_en'));
        $resume_tab_one_it = esc_attr(get_option('resume_tab_one_it'));
        ?>
        <p class="description"><?php _e("Définir le titre de l'onget", "MyCV"); ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e("Français", "MyCV") ?></p>
                <input type="text"
                       id="resume_tab_one_fr"
                       name="resume_tab_one_fr"
                       value="<?php echo $resume_tab_one_fr ?>"
                       placeholder="<?php _e("Texte en français", "MyCV") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Anglais", "MyCV") ?></p>
                <input type="text"
                       id="resume_tab_one_en"
                       name="resume_tab_one_en"
                       value="<?php echo $resume_tab_one_en ?>"
                       placeholder="<?php _e("Texte en anglais", "MyCV") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Italien", "MyCV") ?></p>
                <input type="text"
                       id="resume_tab_one_it"
                       name="resume_tab_one_it"
                       value="<?php echo $resume_tab_one_it ?>"
                       placeholder="<?php _e("Texte en italien", "MyCV") ?>"
                />
            </div>
        </div>
        <?php
    }
    public static function field_resume_tab_two(){
        $resume_tab_two_fr = esc_attr(get_option('resume_tab_two_fr'));
        $resume_tab_two_en = esc_attr(get_option('resume_tab_two_en'));
        $resume_tab_two_it = esc_attr(get_option('resume_tab_two_it'));
        ?>
        <p class="description"><?php _e("Définir le titre de l'onget", "MyCV"); ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e("Français", "MyCV") ?></p>
                <input type="text"
                       id="resume_tab_two_fr"
                       name="resume_tab_two_fr"
                       value="<?php echo $resume_tab_two_fr ?>"
                       placeholder="<?php _e("Texte en français", "MyCV") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Anglais", "MyCV") ?></p>
                <input type="text"
                       id="resume_tab_two_en"
                       name="resume_tab_two_en"
                       value="<?php echo $resume_tab_two_en ?>"
                       placeholder="<?php _e("Texte en anglais", "MyCV") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Italien", "MyCV") ?></p>
                <input type="text"
                       id="resume_tab_two_it"
                       name="resume_tab_two_it"
                       value="<?php echo $resume_tab_two_it ?>"
                       placeholder="<?php _e("Texte en italien", "MyCV") ?>"
                />
            </div>
        </div>
        <?php
    }

    // SECTION 3 : SECTION_RESUME_LOOP ====================================
    public static function field_resume_empji_loop(){
        $resume_empji_loop = get_option('resume_empji_loop');
        ?>
        <input type="checkbox" name="resume_empji_loop" id="resume_empji_loop" value="1" <?php checked(1, $resume_empji_loop, true) ?> />
        <label for=""><?php _e("Afficher un émoji", "MyCV"); ?> &#128549;</label>
        <?php
    }
    public static function field_resume_msg_loop_1(){
        $resume_loop1_fr = esc_attr(get_option('resume_loop1_fr'));
        $resume_loop1_en = esc_attr(get_option('resume_loop1_en'));
        $resume_loop1_it = esc_attr(get_option('resume_loop1_it'));
        ?>
        <p class="description"><?php _e("Ce message sera présent si la boucle 1er est vide", "MyCV"); ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e("Français", "MyCV") ?></p>
                <input type="text"
                       id="resume_loop1_fr"
                       name="resume_loop1_fr"
                       value="<?php echo $resume_loop1_fr ?>"
                       placeholder="<?php _e("Texte en français", "MyCV") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Anglais", "MyCV") ?></p>
                <input type="text"
                       id="resume_loop1_en"
                       name="resume_loop1_en"
                       value="<?php echo $resume_loop1_en ?>"
                       placeholder="<?php _e("Texte en anglais", "MyCV") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Italien", "MyCV") ?></p>
                <input type="text"
                       id="resume_loop1_it"
                       name="resume_loop1_it"
                       value="<?php echo $resume_loop1_it ?>"
                       placeholder="<?php _e("Texte en italien", "MyCV") ?>"
                />
            </div>
        </div>
        <?php
    }
    public static function field_resume_msg_loop_2(){
        $resume_loop2_fr = esc_attr(get_option('resume_loop2_fr'));
        $resume_loop2_en = esc_attr(get_option('resume_loop2_en'));
        $resume_loop2_it = esc_attr(get_option('resume_loop2_it'));
        ?>
        <p class="description"><?php _e("Ce message sera présent si la boucle 2ème est vide", "MyCV"); ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e("Français", "MyCV") ?></p>
                <input type="text"
                       id="resume_loop2_fr"
                       name="resume_loop2_fr"
                       value="<?php echo $resume_loop2_fr ?>"
                       placeholder="<?php _e("Texte en français", "MyCV") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Anglais", "MyCV") ?></p>
                <input type="text"
                       id="resume_loop2_en"
                       name="resume_loop2_en"
                       value="<?php echo $resume_loop2_en ?>"
                       placeholder="<?php _e("Texte en anglais", "MyCV") ?>"
                />
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Italien", "MyCV") ?></p>
                <input type="text"
                       id="resume_loop2_it"
                       name="resume_loop2_it"
                       value="<?php echo $resume_loop2_it ?>"
                       placeholder="<?php _e("Texte en italien", "MyCV") ?>"
                />
            </div>
        </div>
        <?php
    }

    // SECTION 4 : SECTION_RESUME_FR ======================================
    public static function field_resume_desc_fr(){
        // define register settings
        $resume_desc_fr = esc_attr(get_option('resume_desc_fr'));
        // define argument for editor WYSIWYG
        $args = array(
            'media_buttons'    => false,
            'textarea_name'    => 'resume_desc_fr',
            'textarea_rows'    => 20,
            'teeny'            => true,
            'tinymce'          => true,
            'drag_drop_upload' => true,
        );
        ?>
            <div>
                <?php
                    // call hooks wp_editor()
                    $content = wp_editor($resume_desc_fr, 'resume_desc_fr', $args);

                    echo $content
                ?>
            </div>
        <?php
    }

    // SECTION 5 : SECTION_RESUME_EN ======================================
    public static function field_resume_desc_en(){
        $resume_desc_en = esc_attr(get_option('resume_desc_en'));
        // define argument for editor WYSIWYG
        $args = array(
            'media_buttons'    => false,
            'textarea_name'    => 'resume_desc_en',
            'textarea_rows'    => 20,
            'teeny'            => true,
            'tinymce'          => true,
            'drag_drop_upload' => true,
        );
        ?>
        <div>
            <?php
            // call hooks wp_editor()
            $content = wp_editor($resume_desc_en, 'resume_desc_en', $args);

            echo $content
            ?>
        </div>
        <?php
    }

    // SECTION 6 : SECTION_RESUME_IT ======================================
    public static function field_resume_desc_it(){
        // define register settings
        $resume_desc_it = esc_attr(get_option('resume_desc_it'));

        // define argument for editor WYSIWYG
        $args = array(
            'media_buttons'    => false,
            'textarea_name'    => 'resume_desc_it',
            'textarea_rows'    => 20,
            'teeny'            => true,
            'tinymce'          => true,
            'drag_drop_upload' => true,
        );
        ?>
        <div>
            <?php
            // call hooks wp_editor()
            $content = wp_editor($resume_desc_it, 'resume_desc_it', $args);

            echo $content
            ?>
        </div>
        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycustome_resume')){
    mycustome_resume::register();
}