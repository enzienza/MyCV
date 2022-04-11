<?php
/**
 * Name file: 05-curriculum
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

class myprofil_curriculum{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 4
    //const SUB_TITLE   = 'Curriculum';
    //const SUB_MENU    = 'Curriculum';
    const PERMITION   = 'manage_options';
    const SUB_GROUP   = 'myprofil_curriculum';
    const NONCE       = '_myprofil_curriculum';

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
            __('Curriculum', 'MyCV'),               // page_title
            __('Curriculum', 'MyCV'),               // menu_title
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
            <h1 class="wp-heagin-inline"><?php _e('Curriculum Vitae', 'MyCV') ?></h1>
            <p class="description">
                <?php _e("Sur cette page, vous pouvez gérer l'import / export de votre CV", 'MyCV') ?>
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
            __('Section en français', 'MyCV'),      // TITLE
            [self::class, 'display_section_fr'],    // CALLBACK
            self:: SUB_GROUP                  // SLUG_PAGE
        );
        // -> Ajouter les éléments du formulaire
        add_settings_field(
            'import_cv_fr',                     // SLUG_FIELD
            __('Importer mon CV', 'MyCV'),               // LABEL
            [self::class,'field_import_cv_fr'],     // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_FR                   // SLUG_SECTION
        );
        add_settings_field(
            'export_cv_fr',                     // SLUG_FIELD
            __('Exporter mon CV', 'MyCV'),               // LABEL
            [self::class,'field_export_cv_fr'],     // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_FR                   // SLUG_SECTION
        );

        // -> Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'import_cv_fr', [self::class, 'handle_cvfr_upload']);
        register_setting(self::SUB_GROUP, 'export_cv_fr');

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
            __('Section en anglais', 'MyCV'),      // TITLE
            [self::class, 'display_section_en'],    // CALLBACK
            self:: SUB_GROUP                  // SLUG_PAGE
        );
    // -> Ajouter les éléments du formulaire
        add_settings_field(
            'import_cv_en',                     // SLUG_FIELD
            __('Importer mon CV', 'MyCV'),               // LABEL
            [self::class,'field_import_cv_en'],     // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_EN                   // SLUG_SECTION
        );
        add_settings_field(
            'export_cv_en',                     // SLUG_FIELD
            __('Exporter mon CV', 'MyCV'),               // LABEL
            [self::class,'field_export_cv_en'],     // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_EN                   // SLUG_SECTION
        );

        // -> Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'import_cv_en', [self::class, 'handle_cven_upload']);
        register_setting(self::SUB_GROUP, 'export_cv_en');



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
            __('Section en italien', 'MyCV'),      // TITLE
            [self::class, 'display_section_it'],   // CALLBACK
            self:: SUB_GROUP                // SLUG_PAGE
        );
        // -> Ajouter les éléments du formulaire
        add_settings_field(
            'import_cv_it',                     // SLUG_FIELD
            __('Importer mon CV', 'MyCV'),               // LABEL
            [self::class,'field_import_cv_it'],     // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_IT                   // SLUG_SECTION
        );
        add_settings_field(
            'export_cv_it',                     // SLUG_FIELD
            __('Exporter mon CV', 'MyCV'),               // LABEL
            [self::class,'field_export_cv_it'],     // CALLBACK
            self::SUB_GROUP ,                    // SLUG_PAGE
            self::SECTION_IT                   // SLUG_SECTION
        );

        // -> Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'import_cv_it', [self::class, 'handle_cvit_upload']);
        register_setting(self::SUB_GROUP, 'export_cv_it');

    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_FR =========================================
    public static function display_section_fr(){
        ?>
        <p class="section-description">
            <?php _e('Gestion de la section en français', 'MyCV') ?>
        </p>
        <?php
    }

    // SECTION 2 : SECTION_EN =========================================
    public static function display_section_en(){
        ?>
        <p class="section-description">
            <?php _e('Gestion de la section en anglais', 'MyCV') ?>
        </p>
        <?php
    }

    // SECTION 3 : SECTION_IT =========================================
    public static function display_section_it(){
        ?>
        <p class="section-description">
            <?php _e('Gestion de la section en italien' , 'MyCV') ?>
        </p>
        <?php
    }

    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */
    // SECTION 1 : SECTION_FR =========================================
    public static function handle_cvfr_upload(){
        if(!function_exists('wp_handle_upload')){
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        //check if user has uploaded a file and clicked save changes button
        if(!empty($_FILES['import_cv_fr']['tmp_name'])){
            $url = wp_handle_upload($_FILES['import_cv_fr'], array('test_form' => false));
            $temp = $url['url'];
            return $temp;
        }
        // No upload. Old file url is the next value.
        return get_option('import_cv_fr');
    }

    // SECTION 2 : SECTION_EN =========================================
    public static function handle_cven_upload(){
        if(!function_exists('wp_handle_upload')){
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        //check if user has uploaded a file and clicked save changes button
        if(!empty($_FILES['import_cv_en']['tmp_name'])){
            $url = wp_handle_upload($_FILES['import_cv_en'], array('test_form' => false));
            $temp = $url['url'];
            return $temp;
        }
        // No upload. Old file url is the next value.
        return get_option('import_cv_en');
    }
   
    // SECTION 3 : SECTION_IT =========================================
    public static function handle_cvit_upload(){
        if(!function_exists('wp_handle_upload')){
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        //check if user has uploaded a file and clicked save changes button
        if(!empty($_FILES['import_cv_it']['tmp_name'])){
            $url = wp_handle_upload($_FILES['import_cv_it'], array('test_form' => false));
            $temp = $url['url'];
            return $temp;
        }
        // No upload. Old file url is the next value.
        return get_option('import_cv_it');
    }
    
    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 1 : SECTION_FR =========================================
    public static function field_import_cv_fr(){
        $import_cv_fr = esc_attr(get_option('import_cv_fr'));
        ?>
            <div class="grid-cols-2">
                <div class="input-file">
                    <input type="file"
                           id="import_cv_fr"
                           name="import_cv_fr"
                           value="<?php $import_cv_fr ?>"
                    />
                </div>
                <div>
                    <embed src="<?php echo $import_cv_fr ?>"
                           type="application/pdf"
                           class="w-full"
                    />
                </div>
            </div>
        <?php
    }
    public static function field_export_cv_fr(){
        $export_cv_fr = esc_attr(get_option('export_cv_fr'));
        ?>
            <div>
                <input type="checkbox"
                       id="export_cv_fr"
                       name="export_cv_fr"
                       value="1"
                       <?php checked(1, $export_cv_fr, true); ?>
                />
                <label for="">
                    <?php _e('Ajouter le bouton "télécharger mon cv"', 'MyCV') ?>
                </label>
            </div>
        <?php
    }

    // SECTION 2 : SECTION_EN =========================================
    public static function field_import_cv_en(){
        $import_cv_en = esc_attr(get_option('import_cv_en'));
        ?>
        <div class="grid-cols-2">
            <div class="input-file">
                <input type="file"
                       id="import_cv_en"
                       name="import_cv_en"
                       value="<?php $import_cv_en ?>"
                />
            </div>
            <div>
                <embed src="<?php echo $import_cv_en ?>"
                       type="application/pdf"
                       class="w-full"
                />
            </div>
        </div>
        <?php
    }
    public static function field_export_cv_en(){
        $export_cv_en = esc_attr(get_option('export_cv_en'));
        ?>
        <div>
            <input type="checkbox"
                   id="export_cv_en"
                   name="export_cv_en"
                   value="1"
                <?php checked(1, $export_cv_en, true); ?>
            />
            <label for="">
                <?php _e('Ajouter le bouton "télécharger mon cv"', 'MyCV') ?>
            </label>
        </div>
        <?php
    }
   
    // SECTION 3 : SECTION_IT =========================================
    public static function field_import_cv_it(){
        $import_cv_it = esc_attr(get_option('import_cv_it'));
        ?>
        <div class="grid-cols-2">
            <div class="input-file">
                <input type="file"
                       id="import_cv_it"
                       name="import_cv_it"
                       value="<?php $import_cv_it ?>"
                />
            </div>
            <div>
                <embed src="<?php echo $import_cv_it ?>"
                       type="application/pdf"
                       class="w-full"
                />
            </div>
        </div>
        <?php
    }
    public static function field_export_cv_it(){
        $export_cv_it = esc_attr(get_option('export_cv_it'));
        ?>
        <div>
            <input type="checkbox"
                   id="export_cv_it"
                   name="export_cv_it"
                   value="1"
                <?php checked(1, $export_cv_it, true); ?>
            />
            <label for="">
                <?php _e('Ajouter le bouton "télécharger mon cv"', 'MyCV') ?>
            </label>
        </div>
        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('myprofil_curriculum')){
    myprofil_curriculum::register();
}