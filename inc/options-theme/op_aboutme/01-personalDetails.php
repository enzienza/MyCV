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

class mycv_opabout{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const INFO_TITLE = 'About Me';
    const INFO_MENU  = 'About Me';
    const PERMITION  = 'manage_options';
    const DASHICON   = 'dashicons-smiley';
    const GROUP      = 'opabout';
    const NONCE      = '_opabout';

    //definir les sections de la page d'option
    const SECTION_DETAIL = 'section_detail';


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
        add_menu_page(
            self::INFO_TITLE,          // TITLE_PAGE
            self::INFO_MENU,           // TITLE_MENU
            self::PERMITION,           // CAPABILITY
            self::GROUP,              // SLUG_PAGE
            [self::class, 'render'],            // CALLBACK
            self::DASHICON,             // icon
            2                           // POSITION
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
                <?php _e('Sur cette page vous pouvez gérer les informations de votre Curriculum Vitae', 'mycv') ?>
            </p><!--./description-->
            <?php settings_errors(); ?>
        </div><!--./wrap-->

        <form class="myoptions" action="options.php" method="post" enctype="multipart/form-data">
            <?php
            wp_nonce_field(self::NONCE, self::NONCE);
            settings_fields(self::GROUP);
            do_settings_sections(self::GROUP);
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
         * SECTION 1 : SECTION_DETAIL ===================================
         *             -> Créer la section
         *             -> Ajouter les éléments du formulaire
         *             -> Sauvegarder les champs
         *
         */
        // -> créer la section
        add_settings_section(
            self::SECTION_DETAIL,                 // SLUG_SECTION
            __('Détails personnels', 'mycv'),         // TITLE
            [self::class, 'display_section_detail'],  // CALLBACK
            self::GROUP                         // SLUG_PAGE
        ); // Section 1

        // -> Ajouter les éléments du formulaire
        add_settings_field(
            'mylastname',                             // SLUG_FIELD
            __('Nom', 'mycv'),             // LABEL
            [self::class,'field_mylastname'],         // CALLBACK
            self::GROUP ,                             // SLUG_PAGE
            self::SECTION_DETAIL                      // SLUG_SECTION
        );
        add_settings_field(
            'myfirstname',                            // SLUG_FIELD
            __('Prénom', 'mycv'),            // LABEL
            [self::class,'field_myfirstname'],        // CALLBACK
            self::GROUP ,                             // SLUG_PAGE
            self::SECTION_DETAIL                      // SLUG_SECTION
        );
        add_settings_field(
            'mybirthday',                           // SLUG_FIELD
            __('Date de naissance', 'mycv'),            // LABEL
            [self::class,'field_mybirthday'],       // CALLBACK
            self::GROUP ,                           // SLUG_PAGE
            self::SECTION_DETAIL                    // SLUG_SECTION
        );
        add_settings_field(
            'job_title',                            // SLUG_FIELD
            __('Profession', 'customtheme 2021'),          // LABEL
            [self::class,'field_job_title'],        // CALLBACK
            self::GROUP ,                           // SLUG_PAGE
            self::SECTION_DETAIL                    // SLUG_SECTION
        );
        add_settings_field(
            'mylocation',                              // SLUG_FIELD
            __('Localité', 'mycv'),               // LABEL
            [self::class,'field_mylocation'],          // CALLBACK
            self::GROUP ,                           // SLUG_PAGE
            self::SECTION_DETAIL                    // SLUG_SECTION
        );
        add_settings_field(
            'myemail',                              // SLUG_FIELD
            __('Email', 'mycv'),               // LABEL
            [self::class,'field_myemail'],          // CALLBACK
            self::GROUP ,                           // SLUG_PAGE
            self::SECTION_DETAIL                    // SLUG_SECTION
        );
        add_settings_field(
            'myphone',                              // SLUG_FIELD
            __('Téléphone', 'mycv'),        // LABEL
            [self::class,'field_myphone'],          // CALLBACK
            self::GROUP ,                           // SLUG_PAGE
            self::SECTION_DETAIL                    // SLUG_SECTION
        );

        // -> Sauvegarder les champs
        register_setting(self::GROUP, 'mylastname');
        register_setting(self::GROUP, 'myfirstname');
        register_setting(self::GROUP, 'mybirthday');
        register_setting(self::GROUP, 'job_title');
        register_setting(self::GROUP, 'mylocation');
        register_setting(self::GROUP, 'myemail');
        register_setting(self::GROUP, 'myphone');


        /**
         * SECTION 2 : SECTION_MEDIA ===================================
         *             -> Créer la section
         *             -> Ajouter les éléments du formulaire
         *             -> Sauvegarder les champs
         *
         */

    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_DETAIL ==========================================
    public static function display_section_detail(){
        ?>
        <p class="section-description">
            <?php _e('Section dédiée aux informations personnels', 'mycv') ?>
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
    // SECTION 1 : SECTION_DETAIL ==========================================
    public static function field_mylastname(){
        $mylastname = esc_attr(get_option('mylastname'))
        ?>
        <input type="text"
               id="mylastname"
               name="mylastname"
               value="<?php echo $mylastname ?>"
               class="regular-text"
        />
        <?php
    }
    public static function field_myfirstname(){
        $myfirstname = esc_attr(get_option('myfirstname'))
        ?>
        <input type="text"
               id="myfirstname"
               name="myfirstname"
               value="<?php echo $myfirstname ?>"
               class="regular-text"
        />
        <?php
    }
    public static function field_mybirthday(){
        $mybirthday = esc_attr(get_option('mybirthday'));
        ?>
        <input type="date"
               id="mybirthday"
               name="mybirthday"
               value="<?php echo $mybirthday ?>"
        />
        <?php
    }
    public static function field_job_title(){
        $job_title = esc_attr(get_option('job_title'))
        ?>
        <input type="text"
               id="job_title"
               name="job_title"
               value="<?php echo $job_title  ?>"
               class="regular-text"
               placeholder="Le titre du job"
        />
        <?php
    }
    public static function field_mylocation(){
        $mylocation = esc_attr(get_option('mylocation'))
        ?>
        <input type="text"
               id="mylocation"
               name="mylocation"
               value="<?php echo $mylocation  ?>"
               class="regular-text"
               placeholder="La localité"
        />
        <?php
    }
    public static function field_myemail(){
        $myemail = esc_attr(get_option('myemail'))
        ?>
        <input type="email"
               id="myemail"
               name="myemail"
               value="<?php echo $myemail  ?>"
               class="regular-text"
               placeholder="sophie@example.com"
        />
        <?php
    }
    public static function field_myphone(){
        $myphone = esc_attr(get_option('myphone'))
        ?>
        <input type="text"
               id="myphone"
               name="myphone"
               value="<?php echo $myphone  ?>"
               class="regular-text"
               placeholder="0000000000"
        />
        <?php
    }


    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycv_opabout')){
    mycv_opabout::register();
}
