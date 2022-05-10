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


class mycustome_home{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION    = 'manage_options';
    const SUB_GROUP    = 'mycustome_home';
    const NONCE        = '_mycustome_home';

    //definir les sections de la page d'option
    const SECTION_HERO              = 'section_hero';
    const SECTION_HERO_SALUTATION   = 'section_hero_salutation';
    const SECTION_HERO_JOB          = 'section_hero_job';
    const SECTION_HERO_ABOUT        = "section_hero_about";
    const SECTION_HERO_CALLTOACTION = 'section_hero_calltoaction';

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
            __('Accueil', 'MyCV'),            // page_title
            __('Accueil', 'MyCV'),             // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e("Personnaliser l'accueil", 'MyCV') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer la section accueil du site', 'MyCV') ?>
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
         * SECTION 1 : SECTION_HERO ===========================================
         *           1. créer la section
         *           2. ajouter les éléments du formulaire
         *           3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_HERO,                 // SLUG_SECTION
            __('Bannière', 'MyCV'),                 // TITLE
            [self::class, 'display_section_hero'],  // CALLBACK
            self::SUB_GROUP                   // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'hero_hidden_section',                  // SLUG_FIELD
            __("Cacher la section", 'MyCV'),            // LABEL
            [self::class,'field_hero_hidden_section'],  // CALLBACK
            self::SUB_GROUP ,                     // SLUG_PAGE
            self::SECTION_HERO                   // SLUG_SECTION
        );

        add_settings_field(
            'hero_bg_image',                  // SLUG_FIELD
            __("Image en arrière plan", 'MyCV'),  // LABEL
            [self::class,'field_hero_bg_image'],  // CALLBACK
            self::SUB_GROUP ,               // SLUG_PAGE
            self::SECTION_HERO            // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'hero_hidden_section');
        register_setting(self::SUB_GROUP, 'add_bg_hero');
        register_setting(self::SUB_GROUP, 'bg_hero', [self::class, 'handle_hero_upload']);

        /**
         * SECTION 2 : SECTION_HERO_SALUTATION ================================
         *           1. créer la section
         *           2. ajouter les éléments du formulaire
         *           3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_HERO_SALUTATION,                 // SLUG_SECTION
            __("Salutation", 'MyCV'),                          // TITLE
            [self::class, 'display_section_hero_salutation'],  // CALLBACK
            self::SUB_GROUP                             // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'hero_salutation',                  // SLUG_FIELD
            __("Message", 'MyCV'),                  // LABEL
            [self::class,'field_hero_salutation'],  // CALLBACK
            self::SUB_GROUP ,                 // SLUG_PAGE
            self::SECTION_HERO_SALUTATION   // SLUG_SECTION
        );
        add_settings_field(
            'element_display_hero',                  // SLUG_FIELD
            __("Ce qui doit être présent", 'MyCV'),      // LABEL
            [self::class,'field_element_display_hero'],  // CALLBACK
            self::SUB_GROUP ,                      // SLUG_PAGE
            self::SECTION_HERO_SALUTATION        // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'choose_salutation');
        // salutation in 1 line
        register_setting(self::SUB_GROUP, 'hero_salutation_fr');
        register_setting(self::SUB_GROUP, 'hero_salutation_en');
        register_setting(self::SUB_GROUP, 'hero_salutation_it');
        // salutation in 2 lines
        register_setting(self::SUB_GROUP, 'hero_msg_oneline_fr');
        register_setting(self::SUB_GROUP, 'hero_msg_twoline_fr');
        register_setting(self::SUB_GROUP, 'hero_msg_oneline_en');
        register_setting(self::SUB_GROUP, 'hero_msg_twoline_en');
        register_setting(self::SUB_GROUP, 'hero_msg_oneline_it');
        register_setting(self::SUB_GROUP, 'hero_msg_twoline_it');
        // show name
        register_setting(self::SUB_GROUP, 'hero_show_lastname');
        register_setting(self::SUB_GROUP, 'hero_show_firstname');


        /**
         * SECTION 3 : SECTION_HERO_JOB =======================================
         *           1. créer la section
         *           2. ajouter les éléments du formulaire
         *           3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_HERO_JOB,                 // SLUG_SECTION
            __("Job", 'MyCV'),                          // TITLE
            [self::class, 'display_section_hero_job'],  // CALLBACK
            self::SUB_GROUP                       // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'hero_msg_job',                     // SLUG_FIELD
            __("Message", 'MyCV'),                  // LABEL
            [self::class,'field_hero_msg_job'],     // CALLBACK
            self::SUB_GROUP ,                 // SLUG_PAGE
            self::SECTION_HERO_JOB          // SLUG_SECTION
        );

        add_settings_field(
            'hero_job_element',                     // SLUG_FIELD
            __("Ce qui doit être présent", 'MyCV'),                  // LABEL
            [self::class,'field_hero_job_element'],     // CALLBACK
            self::SUB_GROUP ,                 // SLUG_PAGE
            self::SECTION_HERO_JOB          // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        //fr
        register_setting(self::SUB_GROUP, 'hero_show_msg_fr');
        register_setting(self::SUB_GROUP, 'hero_msg_job_fr');
        //en
        register_setting(self::SUB_GROUP, 'hero_show_msg_en');
        register_setting(self::SUB_GROUP, 'hero_msg_job_en');
        //it
        register_setting(self::SUB_GROUP, 'hero_show_msg_it');
        register_setting(self::SUB_GROUP, 'hero_msg_job_it');
        // all
        register_setting(self::SUB_GROUP, 'hero_add_job');

        /**
         * SECTION 4 : SECTION_HERO_ABOUT =====================================
         *           1. créer la section
         *           2. ajouter les éléments du formulaire
         *           3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_HERO_ABOUT,                 // SLUG_SECTION
            __("About", 'MyCV'),                 // TITLE
            [self::class, 'display_section_hero_about'],  // CALLBACK
            self::SUB_GROUP                         // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'hero_about_element',                     // SLUG_FIELD
            __("Ce qui doit être présent", 'MyCV'),                  // LABEL
            [self::class,'field_hero_about_element'],     // CALLBACK
            self::SUB_GROUP ,                 // SLUG_PAGE
            self::SECTION_HERO_ABOUT          // SLUG_SECTION
        );

        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'hero_about_fr');
        register_setting(self::SUB_GROUP, 'hero_about_en');
        register_setting(self::SUB_GROUP, 'hero_about_it');

        /**
         * SECTION 5 : SECTION_HERO_CALLTOACTION ==============================
         *           1. créer la section
         *           2. ajouter les éléments du formulaire
         *           3. Sauvegarder les champs
         */
        // 1. créer la section
        add_settings_section(
            self::SECTION_HERO_CALLTOACTION,                 // SLUG_SECTION
            __("Call To Action", 'MyCV'),                        // TITLE
            [self::class, 'display_section_hero_colltoaction'],  // CALLBACK
            self::SUB_GROUP                                // SLUG_PAGE
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'hero_show_btn_about',                    // SLUG_FIELD
            __('Bouton "à propos"', 'MyCV'),             // LABEL
            [self::class,'field_hero_show_btn_about'],   // CALLBACK
            self::SUB_GROUP ,                      // SLUG_PAGE
            self::SECTION_HERO_CALLTOACTION      // SLUG_SECTION
        );

        add_settings_field(
            'hero_show_btn_download',                   // SLUG_FIELD
            __('Bouton "Télécharger CV"', 'MyCV'),          // LABEL
            [self::class,'field_hero_show_btn_download'],   // CALLBACK
            self::SUB_GROUP ,                         // SLUG_PAGE
            self::SECTION_HERO_CALLTOACTION         // SLUG_SECTION
        );

        add_settings_field(
            'hero_show_btn_contact',                   // SLUG_FIELD
            __('Bouton "Contact"', 'MyCV'),          // LABEL
            [self::class,'field_hero_show_btn_contact'],   // CALLBACK
            self::SUB_GROUP ,                         // SLUG_PAGE
            self::SECTION_HERO_CALLTOACTION         // SLUG_SECTION
        );


        // 3. Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'hero_add_btn_about');
        register_setting(self::SUB_GROUP, 'hero_show_icon_about');
        register_setting(self::SUB_GROUP, 'hero_add_btn_download');
        register_setting(self::SUB_GROUP, 'hero_show_icon_download');
        register_setting(self::SUB_GROUP, 'hero_add_btn_contact');
        register_setting(self::SUB_GROUP, 'hero_show_icon_contact');
    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_HERO ===========================================
    public static function display_section_hero(){
        ?>
            <p class="section-description">
                <?php _e("Cette section vous permettre de gérer l'affichage de la bannière", "MyCV"); ?>
            </p>
        <?php
    }

    // SECTION 2 : SECTION_HERO_SALUTATION ================================
    public static function display_section_hero_salutation(){
        ?>
            <p class="section-description">
                <?php _e("Cette partie vous permet de gérer les salutations de la section", "MyCV"); ?>
            </p>
        <?php
    }

    // SECTION 3 : SECTION_HERO_JOB =======================================
    public static function display_section_hero_job(){
        ?>
            <p class="section-description">
                <?php _e("Cette partie vous permet de gérer l'affichage du métier visé", "MyCV");?>
            </p>
        <?php
    }

    // SECTION 4 : SECTION_HERO_ABOUT =====================================
    public static function display_section_hero_about(){
        ?>
            <p class="section-description">
                <?php _e('Cette partie vous permet de gérer l\'affichage de "Qui je suis ?"', "MyCV"); ?>
            </p>
        <?php
    }

    // SECTION 5 : SECTION_HERO_CALLTOACTION ==============================
    public static function display_section_hero_colltoaction(){
        ?>
            <p class="section-description">
                <?php _e("Cette partie vous permet de gérer les call-to-action présent dans la section", "MyCV");?>
            </p>
        <?php
    }

    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */
    // SECTION 1 : SECTION_HERO ===========================================
    public static function handle_hero_upload(){
        if(!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        //check if user had uploaded a file and clicked save changes button
        if(!empty($_FILES['bg_hero']['tmp_name'])){
            $url = wp_handle_upload($_FILES['bg_hero'], array('test_form' => false));
            $temp = $url['url'];
            return $temp;
        }
        // no upload. Old file url is the new value.
        return get_option('bg_hero');

    }

    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 1 : SECTION_HERO ===========================================
    public static function field_hero_hidden_section(){
        $hero_hidden_section = esc_attr(get_option('hero_hidden_section'));
        ?>
        <input type="checkbox"
               id="hero_hidden_section"
               name="hero_hidden_section"
               value="1"
            <?php checked(1, $hero_hidden_section, true) ?>
        />
        <label for=""><?php _e("Masquer la section home du theme", "MyCV"); ?></label>
        <?php
    }

    public static function field_hero_bg_image(){
        $add_bg_hero = esc_attr(get_option('add_bg_hero'));
        $bg_hero = esc_attr(get_option('bg_hero'));
        ?>
        <div>
            <input type="checkbox" id="add_bg_hero" name="add_bg_hero" value="1" <?php checked(1, $add_bg_hero, true) ?> />
            <label for="">
                <?php _e("Ajouter une image comme arrière plan", "MyCV"); ?>
            </label>
        </div>
        <div class="">
            <p>aperçu :</p>
            <img src="<?php echo get_option("bg_hero") ?>"
                 alt="background home section"
                 class="img-hero"
            />
        </div>
        <div class="bg-input-file">
            <input type="file"
                   id="bg_hero"
                   name="bg_hero"
                   value="<?php echo get_option("bg_hero") ?>"
            />
        </div>
        <?php
    }

    // SECTION 2 : SECTION_HERO_SALUTATION ================================
    public static function field_hero_salutation(){
        $choose_salutation = get_option('choose_salutation');
        // salutation in 1 line
        $hero_salutation_fr = esc_attr(get_option('hero_salutation_fr'));
        $hero_salutation_en = esc_attr(get_option('hero_salutation_en'));
        $hero_salutation_it = esc_attr(get_option('hero_salutation_it'));
        // salutation in 2 lines
        $hero_msg_oneline_fr = esc_attr(get_option('hero_msg_oneline_fr'));
        $hero_msg_twoline_fr = esc_attr(get_option('hero_msg_twoline_fr'));
        $hero_msg_oneline_en = esc_attr(get_option('hero_msg_oneline_en'));
        $hero_msg_twoline_en = esc_attr(get_option('hero_msg_twoline_en'));
        $hero_msg_oneline_it = esc_attr(get_option('hero_msg_oneline_it'));
        $hero_msg_twoline_it = esc_attr(get_option('hero_msg_twoline_it'));
        ?>
            <div class="">
                <label for="">
                    <input type="radio" name="choose_salutation" value="1" <?php checked(1, $choose_salutation, true) ?> />
                    <?php _e("Salutation en 1 ligne", 'MyCV'); ?>
                </label>
                <div class="grid-cols-3">
                    <div class="grid-box">
                        <p class="box-title"><?php _e("Français", "mycv") ?></p>
                        <div>
                            <input type="text"
                                   id="hero_salutation_fr"
                                   name="hero_salutation_fr"
                                   value="<?php echo $hero_salutation_fr ?>"
                                   placeholder="<?php _e("Salutation en français", "mycv") ?>"
                            />
                        </div>
                    </div>
                    <div class="grid-box">
                        <p class="box-title"><?php _e("Anglais", "mycv") ?></p>
                        <div>
                            <input type="text"
                                   id="hero_salutation_en"
                                   name="hero_salutation_en"
                                   value="<?php echo $hero_salutation_en ?>"
                                   placeholder="<?php _e("Salutation en anglais", "mycv") ?>"
                            />
                        </div>
                    </div>
                    <div class="grid-box">
                        <p class="box-title"><?php _e("Italien", "mycv") ?></p>
                        <div>
                            <input type="text"
                                   id="hero_salutation_it"
                                   name="hero_salutation_it"
                                   value="<?php echo $hero_salutation_it ?>"
                                   placeholder="<?php _e("Salutation en italien", "mycv") ?>"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="separation">
                <label for="">
                    <input type="radio" name="choose_salutation" value="2" <?php checked(2, $choose_salutation, true) ?> />
                    <?php _e("Salutation en 2 lignes", 'MyCV'); ?>
                </label>
                <div class="grid-cols-3">
                    <div class="grid-box">
                        <p class="box-title"><?php _e("Français", "mycv") ?></p>
                        <div>
                            <p><?php _e("Ligne 1", "MyCV"); ?></p>
                            <input type="text"
                                   id="hero_msg_oneline_fr"
                                   name="hero_msg_oneline_fr"
                                   value="<?php echo $hero_msg_oneline_fr ?>"
                                   placeholder="<?php _e("Texte en français", "mycv") ?>"
                            />
                        </div>
                        <div class="space-y-4">
                            <p><?php _e("Ligne 2", "MyCV"); ?></p>
                            <input type="text"
                                   id="hero_msg_twoline_fr"
                                   name="hero_msg_twoline_fr"
                                   value="<?php echo $hero_msg_twoline_fr ?>"
                                   placeholder="<?php _e("Texte en français", "mycv") ?>"
                            />
                        </div>
                    </div>
                    <div class="grid-box">
                        <p class="box-title"><?php _e("Anglais", "mycv") ?></p>
                        <div>
                            <p><?php _e("Ligne 1", "MyCV"); ?></p>
                            <input type="text"
                                   id="hero_msg_oneline_en"
                                   name="hero_msg_oneline_en"
                                   value="<?php echo $hero_msg_oneline_en ?>"
                                   placeholder="<?php _e("Texte en anglais", "mycv") ?>"
                            />
                        </div>
                        <div class="space-y-4">
                            <p><?php _e("Ligne 2", "MyCV"); ?></p>
                            <input type="text"
                                   id="hero_msg_twoline_en"
                                   name="hero_msg_twoline_en"
                                   value="<?php echo $hero_msg_twoline_en ?>"
                                   placeholder="<?php _e("Texte en anglais", "mycv") ?>"
                            />
                        </div>
                    </div>
                    <div class="grid-box">
                        <p class="box-title"><?php _e("Italien", "mycv") ?></p>
                        <div>
                            <p><?php _e("Ligne 1", "MyCV"); ?></p>
                            <input type="text"
                                   id="hero_msg_oneline_it"
                                   name="hero_msg_oneline_it"
                                   value="<?php echo $hero_msg_oneline_it ?>"
                                   placeholder="<?php _e("Texte en italien", "mycv") ?>"
                            />
                        </div>
                        <div class="space-y-4">
                            <p><?php _e("Ligne 2", "MyCV"); ?></p>
                            <input type="text"
                                   id="hero_msg_twoline_it"
                                   name="hero_msg_twoline_it"
                                   value="<?php echo $hero_msg_twoline_it ?>"
                                   placeholder="<?php _e("Texte en italien", "mycv") ?>"
                            />
                        </div>
                    </div>
                </div>

            </div>
        <?php
    }

    public static function field_element_display_hero(){
        $hero_show_lastname = esc_attr(get_option('hero_show_lastname'));
        $hero_show_firstname = esc_attr(get_option('hero_show_firstname'));
        ?>
        <p class="description"><?php _e("Cocher ce qui doit être présent", "MyCV") ?></p>
        <p>
            <input type="checkbox" id="hero_show_lastname" name="hero_show_lastname" value="1" <?php checked(1, $hero_show_lastname, true) ?> />
            <label for=""><?php _e("Nom", "MyCV"); ?></label>
        </p>
        <p>
            <input type="checkbox" id="hero_show_firstname" name="hero_show_firstname" value="1" <?php checked(1, $hero_show_firstname, true) ?> />
            <label for=""><?php _e("Prénom", "MyCV"); ?></label>
        </p>
        <?php
    }

    // SECTION 3 : SECTION_HERO_JOB =======================================
    public static function field_hero_msg_job(){
        // FR
        $hero_show_msg_fr = esc_attr(get_option('hero_show_msg_fr'));
        $hero_msg_job_fr  = esc_attr(get_option('hero_msg_job_fr'));
        // EN
        $hero_show_msg_en = esc_attr(get_option('hero_show_msg_en'));
        $hero_msg_job_en  = esc_attr(get_option('hero_msg_job_en'));
        // IT
        $hero_show_msg_it = esc_attr(get_option('hero_show_msg_it'));
        $hero_msg_job_it  = esc_attr(get_option('hero_msg_job_it'));
        ?>
            <p class="description"><?php _e("Définir le texte d'introduction au job visé", "MyCV"); ?></p>
            <div class="grid-cols-3">
                <div class="grid-box">
                    <p class="box-title"><?php _e("Français", "mycv") ?></p>
                    <div class="mt-1">
                        <input type="checkbox" id="hero_show_msg_fr" name="hero_show_msg_fr" value="1" <?php checked(1, $hero_show_msg_fr, true) ?> />
                        <?php _e('Ajouter un message', 'MyCV'); ?>
                    </div>
                    <div class="mt-1">
                        <input type="text"
                               id="hero_msg_job_fr"
                               name="hero_msg_job_fr"
                               value="<?php echo $hero_msg_job_fr ?>"
                               placeholder="<?php _e("Texte en français", "mycv") ?>"
                        />
                    </div>
                </div>
                <div class="grid-box">
                    <p class="box-title"><?php _e("Anglais", "mycv") ?></p>
                    <div class="mt-1">
                        <input type="checkbox" id="hero_show_msg_en" name="hero_show_msg_en" value="1" <?php checked(1, $hero_show_msg_en, true) ?> />
                        <?php _e('Ajouter un message', 'MyCV'); ?>
                    </div>
                    <div class="mt-1">
                        <input type="text"
                               id="hero_msg_job_en"
                               name="hero_msg_job_en"
                               value="<?php echo $hero_msg_job_en ?>"
                               placeholder="<?php _e("Texte en anglais", "mycv") ?>"
                        />
                    </div>
                </div>
                <div class="grid-box">
                    <p class="box-title"><?php _e("Italien", "mycv") ?></p>
                    <div class="mt-1">
                        <input type="checkbox" id="hero_show_msg_it" name="hero_show_msg_it" value="1" <?php checked(1, $hero_show_msg_it, true) ?> />
                        <?php _e('Ajouter un message', 'MyCV'); ?>
                    </div>
                    <div class="mt-1">
                        <input type="text"
                               id="hero_msg_job_it"
                               name="hero_msg_job_it"
                               value="<?php echo $hero_msg_job_it ?>"
                               placeholder="<?php _e("Texte en italien", "mycv") ?>"
                        />
                    </div>
                </div>
            </div>
        <?php
    }

    public static function field_hero_job_element(){
        $hero_add_job = get_option('hero_add_job');
        ?>
            <p class="description"><?php _e("Cocher ce qui doit être présent", "MyCV") ?></p>
            <p>
                <input type="checkbox" id="hero_add_job" name="hero_add_job" value="1" <?php checked(1, $hero_add_job, true) ?> />
                <label for=""><?php _e('Ajouter le nom du job visé', 'MyCV'); ?></label>
            </p>
        <?php
    }

    // SECTION 4 : SECTION_HERO_ABOUT =====================================
    public static function field_hero_about_element(){
        $hero_about_fr = get_option('hero_about_fr');
        $hero_about_en = get_option('hero_about_en');
        $hero_about_it = get_option('hero_about_it');
        ?>
        <p class="description"><?php _e("Cocher ce qui doit être présent", "MyCV") ?></p>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="box-title"><?php _e("Français", "mycv") ?></p>
                <div class="mt-1">
                    <input type="checkbox" id="hero_about_fr" name="hero_about_fr" value="1" <?php checked(1, $hero_about_fr, true); ?> />
                    <label for=""><?php _e('Ajouter "Parler de sois"', "MyCV"); ?></label>
                </div>
                <div class="mt-1">
                    <a href="?page=myprofil_aboutme"><?php _e('Modifier le texte "Parler de sois"', 'MyCV'); ?></a>
                </div>
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Anglais", "mycv") ?></p>
                <div class="mt-1">
                    <input type="checkbox" id="hero_about_en" name="hero_about_en" value="1" <?php checked(1, $hero_about_en, true); ?> />
                    <label for=""><?php _e('Ajouter "Parler de sois"', "MyCV"); ?></label>
                </div>
                <div class="mt-1">
                    <a href="?page=myprofil_aboutme"><?php _e('Modifier le texte "Parler de sois"', 'MyCV'); ?></a>
                </div>
            </div>
            <div class="grid-box">
                <p class="box-title"><?php _e("Italien", "mycv") ?></p>
                <div class="mt-1">
                    <input type="checkbox" id="hero_about_it" name="hero_about_it" value="1" <?php checked(1, $hero_about_it, true); ?> />
                    <label for=""><?php _e('Ajouter "Parler de sois"', "MyCV"); ?></label>
                </div>
                <div class="mt-1">
                    <a href="?page=myprofil_aboutme"><?php _e('Modifier le texte "Parler de sois"', 'MyCV'); ?></a>
                </div>
            </div>
        </div>
        <?php
    }

    // SECTION 5 : SECTION_HERO_CALLTOACTION ==============================
    public static function field_hero_show_btn_about(){
        $hero_add_btn_about = esc_attr(get_option('hero_add_btn_about'));
        $hero_show_icon_about = esc_attr(get_option('hero_show_icon_about'));
        ?>
            <p>
                <input type="checkbox" id="hero_add_btn_about" name="hero_add_btn_about" value="1" <?php checked(1, $hero_add_btn_about, true) ?>  />
                <label for=""><?php _e('Afficher le bouton', "MyCV"); ?></label>
            </p>
            <p>
                <input type="checkbox" id="hero_show_icon_about" name="hero_show_icon_about" value="1" <?php checked(1, $hero_show_icon_about, true) ?>  />
                <label for=""><?php _e("Afficher l'îcone", "MyCV"); ?></label>
            </p>
        <?php
    }

    public static function field_hero_show_btn_download(){
        $hero_add_btn_download = esc_attr(get_option('hero_add_btn_download'));
        $hero_show_icon_download = esc_attr(get_option('hero_show_icon_download'));
        ?>
        <p>
            <input type="checkbox" id="hero_add_btn_download" name="hero_add_btn_download" value="1" <?php checked(1, $hero_add_btn_download, true) ?>  />
            <label for=""><?php _e('Afficher le bouton', "MyCV"); ?></label>
        </p>
        <p>
            <input type="checkbox" id="hero_show_icon_download" name="hero_show_icon_download" value="1" <?php checked(1, $hero_show_icon_download, true) ?>  />
            <label for=""><?php _e("Afficher l'îcone", "MyCV"); ?></label>
        </p>
        <?php
    }

    public static function field_hero_show_btn_contact(){
        $hero_add_btn_contact = esc_attr(get_option('hero_add_btn_contact'));
        $hero_show_icon_contact = esc_attr(get_option('hero_show_icon_contact'));
        ?>
        <p>
            <input type="checkbox" id="hero_add_btn_contact" name="hero_add_btn_contact" value="1" <?php checked(1, $hero_add_btn_contact, true) ?>  />
            <label for=""><?php _e('Afficher le bouton', "MyCV"); ?></label>
        </p>
        <p>
            <input type="checkbox" id="hero_show_icon_contact" name="hero_show_icon_contact" value="1" <?php checked(1, $hero_show_icon_contact, true) ?>  />
            <label for=""><?php _e("Afficher l'îcone", "MyCV"); ?></label>
        </p>
        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycustome_home')){
    mycustome_home::register();
}
