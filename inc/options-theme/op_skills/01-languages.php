<?php
/**
 * Name file: OP_about
 * Description: File for the manage CV Settings.
 *              [information general]
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

class skills_languages{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    //const INFO_TITLE = 'Mon profile';
    //const INFO_MENU  = 'Mon profile';
    const PERMITION  = 'manage_options';
    const DASHICON   = 'dashicons-smiley';
    const SUB_GROUP      = 'language';
    const NONCE      = '_language';

    //definir les sections de la page d'option
    const SECTION_INTRO   = 'section_intro';
    const SECTION_FRENCH  = 'section_french';
    const SECTION_ENGLIGH = 'section_engligh';
    const SECTION_ITALIAN = 'section_italian';


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
            "edit.php?post_type=competences",        // slug parent
            __('Langues', 'MyCV'),       // TITLE_PAGE
            __('Langues', 'MyCV'),        // TITLE_MENU
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
            <h1 class="wp-heagin-inline"><?php _e('Langues', 'MyCV') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer vos compétences en langues', 'MyCV') ?>
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
         * SECTION 1 : SECTION_INTRO ======================================
         *        -> Créer la section
         *        -> Ajouter les éléments du formulaire
         *        -> Sauvegarder les champs
         *
         */
        // -> créer la section
        add_settings_section(
            self::SECTION_INTRO,                 // SLUG_SECTION
            __('', 'MyCV'),                // TITLE
            [self::class, 'display_section_intro'],  // CALLBACK
            self::SUB_GROUP                        // SLUG_PAGE
        );

        // -> Ajouter les éléments du formulaire
        // -> Sauvegarder les champs


        /**
         * SECTION 2 : SECTION_FRENCH ====================================
         *        -> Créer la section
         *        -> Ajouter les éléments du formulaire
         *        -> Sauvegarder les champs
         *
         */
        // -> créer la section
        add_settings_section(
            self::SECTION_FRENCH,                 // SLUG_SECTION
            __('Français', 'MyCV'),                // TITLE
            [self::class, 'display_section_french'],  // CALLBACK
            self::SUB_GROUP                        // SLUG_PAGE
        );

        // -> Ajouter les éléments du formulaire
        add_settings_field(
            'isnative_french',                          // SLUG_FIELD
            __('Langue maternelle', 'MyCV'),         // LABEL
            [self::class,'field_isnative_french'],          // CALLBACK
            self::SUB_GROUP ,                   // SLUG_PAGE
            self::SECTION_FRENCH               // SLUG_SECTION
        );
        add_settings_field(
            'level_french',                          // SLUG_FIELD
            __('Niveau de maîtrise', 'MyCV'),         // LABEL
            [self::class,'field_level_french'],          // CALLBACK
            self::SUB_GROUP ,                   // SLUG_PAGE
            self::SECTION_FRENCH               // SLUG_SECTION
        );

        // -> Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'french_isnative');
        register_setting(self::SUB_GROUP, 'french_level');

        /**
         * SECTION 3 : SECTION_ENGLIGH ===================================
         *        -> Créer la section
         *        -> Ajouter les éléments du formulaire
         *        -> Sauvegarder les champs
         *
         */
        // -> Créer la section
        add_settings_section(
            self::SECTION_ENGLIGH,                 // SLUG_SECTION
            __('Anglais', 'MyCV'),                // TITLE
            [self::class, 'display_section_english'],  // CALLBACK
            self::SUB_GROUP                        // SLUG_PAGE
        );

        // -> Ajouter les éléments du formulaire
         add_settings_field(
            'isnative_english',                          // SLUG_FIELD
            __('Langue maternelle', 'MyCV'),         // LABEL
            [self::class,'field_isnative_english'],          // CALLBACK
            self::SUB_GROUP ,                   // SLUG_PAGE
            self::SECTION_ENGLIGH               // SLUG_SECTION
        );
        add_settings_field(
            'level_english',                          // SLUG_FIELD
            __('Niveau de maîtrise', 'MyCV'),         // LABEL
            [self::class,'field_level_english'],          // CALLBACK
            self::SUB_GROUP ,                   // SLUG_PAGE
            self::SECTION_ENGLIGH               // SLUG_SECTION
        );

        // -> Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'english_isnative');
        register_setting(self::SUB_GROUP, 'english_level');

        /**
         * SECTION 4 : SECTION_ITALIAN ===================================
         *        -> Créer la section
         *        -> Ajouter les éléments du formulaire
         *        -> Sauvegarder les champs
         *
         */
        // -> Créer la section
        add_settings_section(
            self::SECTION_ITALIAN,                 // SLUG_SECTION
            __('Italien', 'MyCV'),                // TITLE
            [self::class, 'display_section_italian'],  // CALLBACK
            self::SUB_GROUP                        // SLUG_PAGE
        );

        // -> Ajouter les éléments du formulaire
         add_settings_field(
            'isnative_italian',                          // SLUG_FIELD
            __('Langue maternelle', 'MyCV'),         // LABEL
            [self::class,'field_isnative_italian'],          // CALLBACK
            self::SUB_GROUP ,                   // SLUG_PAGE
            self::SECTION_ITALIAN               // SLUG_SECTION
        );
         add_settings_field(
            'level_italian',                          // SLUG_FIELD
            __('Niveau de maîtrise', 'MyCV'),         // LABEL
            [self::class,'field_level_italian'],          // CALLBACK
            self::SUB_GROUP ,                   // SLUG_PAGE
            self::SECTION_ITALIAN               // SLUG_SECTION
        );

        // -> Sauvegarder les champs
        register_setting(self::SUB_GROUP, 'italian_isnative');
        register_setting(self::SUB_GROUP, 'italian_level');

    }




    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_INTRO =====================================
    public static function display_section_intro(){
        ?>
            <div class="box-note">
                <p class="sub-title"><?php _e("La liste des niveaux de langue CECRL<span class='footnote-mark'><a href='#fn1'>1</a></span>", "MyCV") ?></p>

                <div class="grid-cols-3">
                    <div class="group-languages">
                        <p class="font-bold"><?php _e("Utilisateur élémentaire", "MyCV") ?></p>
                        <ul class="level-group">
                            <li class="level-item"><span class="control">A1</span><?php _e("niveau introductif ou de découverte", "MyCV") ?></li>
                            <li class="level-item"><span class="control">A2</span><?php _e("niveau intermédiaire ou usuel", "MyCV") ?></li>
                        </ul>
                    </div>

                    <div class="group-languages">
                        <p class="font-bold"><?php _e("Utilisateur intermédiaire", "MyCV") ?></p>
                        <ul class="level-group">
                            <li class="level-item"><span class="control">B1</span><?php _e("niveau seuil", "MyCV") ?></li>
                            <li class="level-item"><span class="control">B2</span><?php _e("niveau avancé ou indépendant", "MyCV") ?></li>
                        </ul>
                    </div>

                    <div class="group-languages">
                        <p class="font-bold"><?php _e("Utilisateur avancé", "MyCV") ?></p>
                        <ul class="level-group">
                            <li class="level-item"><span class="control">C1</span><?php _e("niveau autonome", "MyCV") ?></li>
                            <li class="level-item"><span class="control">C2</span><?php _e("niveau maîtrise", "MyCV") ?></li>
                        </ul>
                    </div>
                </div>

                <div class="footnotes" id="fn:1">
                    <ol>
                        <li><?php _e("Cadre Européen de Référence pour les Langues", "MyCV") ?></li>
                    </ol>
                </div>
            </div>
        <?php
    }

    // SECTION 2 : SECTION_FRENCH ====================================
    public static function display_section_french(){
        ?>
        <P class="section-description">
            <?php _e("Précisé le niveau de maîtrise de cette langue", "MyCV") ?>
        </P>
        <?php
    }

    // SECTION 3 : SECTION_ENGLIGH ===================================
    public static function display_section_english(){
        ?>
        <P class="section-description">
            <?php _e("Précisé le niveau de maîtrise de cette langue", "MyCV") ?>
        </P>
        <?php
    }

    // SECTION 4 : SECTION_ITALIAN ===================================
    public static function display_section_italian(){
        ?>
        <P class="section-description">
            <?php _e("Précisé le niveau de maîtrise de cette langue", "MyCV") ?>
        </P>
        <?php
    }

    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */


    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 2 : SECTION_FRENCH ====================================
    public static function field_isnative_french(){
        $french_isnative = get_option('french_isnative')
        ?>
        <input type="radio" name="french_isnative" value="1" <?php checked(1, $french_isnative, true) ?> /> <?php _e("Oui", "MyCV");?>
        <input type="radio" name="french_isnative" value="2" <?php checked(2, $french_isnative, true) ?> /> <?php _e("Non", "MyCV");?>
        <?php
    }
    public static function field_level_french(){
        $french_level = get_option('french_level');
        ?>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="font-bold"><?php _e("Élémentaire", "MyCV"); ?></p>
                <p>
                    <input type="radio" name="french_level" value="1" <?php checked(1, $french_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>A1</span> - niveau introductif ou de découvert", "MyCV") ?></label>
                </p>
                <p>
                    <input type="radio" name="french_level" value="2" <?php checked(2, $french_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>A2</span> - niveau intermédiaire ou usuel", "MyCV") ?></label>
                </p>
            </div>
            <div class="grid-box">
                <p class="font-bold"><?php _e("Intermédiaire", "MyCV"); ?></p>
                <p>
                    <input type="radio" name="french_level" value="3" <?php checked(3, $french_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>B1</span> - niveau seuil", "MyCV"); ?></label>
                </p>
                <p>
                    <input type="radio" name="french_level" value="4" <?php checked(4, $french_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>B2</span> - niveau avancé ou indépendant", "MyCV"); ?></label>
                </p>
            </div>
            <div class="grid-box">
                <p class="font-bold"><?php _e("Avancé", "MyCV"); ?></p>
                <p>
                    <input type="radio" name="french_level" value="5" <?php checked(5, $french_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>C1</span> - niveau autonome", "MyCV"); ?></label>
                </p>
                <p>
                    <input type="radio" name="french_level" value="6" <?php checked(6, $french_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>C2</span> - niveau maîtrise", "MyCV"); ?></label>
                </p>
            </div>
        </div>
        <?php
    }


    // SECTION 3 : SECTION_ENGLIGH ===================================
    public static function field_isnative_english(){
        $english_isnative = get_option('english_isnative');
        ?>
        <input type="radio" name="english_isnative" value="1" <?php checked(1, $english_isnative, true) ?> /> <?php _e("Oui", "MyCV");?>
        <input type="radio" name="english_isnative" value="2" <?php checked(2, $english_isnative, true) ?> /> <?php _e("Non", "MyCV");?>
        <?php
    }
    public static function field_level_english(){
        $english_level = get_option('english_level');
        ?>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="font-bold"><?php _e("Élémentaire", "MyCV"); ?></p>
                <p>
                    <input type="radio" name="english_level" value="1" <?php checked(1, $english_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>A1</span> - niveau introductif ou de découvert", "MyCV") ?></label>
                </p>
                <p>
                    <input type="radio" name="english_level" value="2" <?php checked(2, $english_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>A2</span> - niveau intermédiaire ou usuel", "MyCV") ?></label>
                </p>
            </div>
            <div class="grid-box">
                <p class="font-bold"><?php _e("Intermédiaire", "MyCV"); ?></p>
                <p>
                    <input type="radio" name="english_level" value="3" <?php checked(3, $english_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>B1</span> - niveau seuil", "MyCV"); ?></label>
                </p>
                <p>
                    <input type="radio" name="english_level" value="4" <?php checked(4, $english_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>B2</span> - niveau avancé ou indépendant", "MyCV"); ?></label>
                </p>
            </div>
            <div class="grid-box">
                <p class="font-bold"><?php _e("Avancé", "MyCV"); ?></p>
                <p>
                    <input type="radio" name="english_level" value="5" <?php checked(5, $english_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>C1</span> - niveau autonome", "MyCV"); ?></label>
                </p>
                <p>
                    <input type="radio" name="english_level" value="6" <?php checked(6, $english_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>C2</span> - niveau maîtrise", "MyCV"); ?></label>
                </p>
            </div>
        </div>
        <?php
    }

    // SECTION 4 : SECTION_ITALIAN ===================================
    public static function field_isnative_italian(){
        $italian_isnative = get_option('italian_isnative');
        ?>
        <input type="radio" name="italian_isnative" value="1" <?php checked(1, $italian_isnative, true) ?> /> <?php _e("Oui", "MyCV");?>
        <input type="radio" name="italian_isnative" value="2" <?php checked(2, $italian_isnative, true) ?> /> <?php _e("Non", "MyCV");?>
        <?php
    }
    public static function field_level_italian(){
        $italian_level = get_option('italian_level');
        ?>
        <div class="grid-cols-3">
            <div class="grid-box">
                <p class="font-bold"><?php _e("Élémentaire", "MyCV"); ?></p>
                <p>
                    <input type="radio" name="italian_level" value="1" <?php checked(1, $italian_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>A1</span> - niveau introductif ou de découvert", "MyCV") ?></label>
                </p>
                <p>
                    <input type="radio" name="italian_level" value="2" <?php checked(2, $italian_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>A2</span> - niveau intermédiaire ou usuel", "MyCV") ?></label>
                </p>
            </div>
            <div class="grid-box">
                <p class="font-bold"><?php _e("Intermédiaire", "MyCV"); ?></p>
                <p>
                    <input type="radio" name="italian_level" value="3" <?php checked(3, $italian_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>B1</span> - niveau seuil", "MyCV"); ?></label>
                </p>
                <p>
                    <input type="radio" name="italian_level" value="4" <?php checked(4, $italian_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>B2</span> - niveau avancé ou indépendant", "MyCV"); ?></label>
                </p>
            </div>
            <div class="grid-box">
                <p class="font-bold"><?php _e("Avancé", "MyCV"); ?></p>
                <p>
                    <input type="radio" name="italian_level" value="5" <?php checked(5, $italian_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>C1</span> - niveau autonome", "MyCV"); ?></label>
                </p>
                <p>
                    <input type="radio" name="italian_level" value="6" <?php checked(6, $italian_level, true) ?> />
                    <label for=""><?php _e("<span class='font-bold'>C2</span> - niveau maîtrise", "MyCV"); ?></label>
                </p>
            </div>
        </div>
        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('skills_languages')){
    skills_languages::register();
}
