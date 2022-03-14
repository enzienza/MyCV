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

class mycv_myprofil{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    const INFO_TITLE = 'Mon profile';
    const INFO_MENU  = 'Mon profile';
    const PERMITION  = 'manage_options';
    const DASHICON   = 'dashicons-smiley';
    const GROUP      = 'myprofil';
    const NONCE      = '_myprofil';

    //definir les sections de la page d'option
    const SECTION_DETAIL = 'section_detail';
    const SECTION_LOCATION = 'section_location';
    const SECTION_POST = 'section_post';


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
            <h1 class="wp-heagin-inline"><?php _e('Mon profile', 'MyCV') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer les informations de votre Curriculum Vitae', 'MyCV') ?>
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
            __('Détails personnels', 'MyCV'),         // TITLE
            [self::class, 'display_section_detail'],  // CALLBACK
            self::GROUP                         // SLUG_PAGE
        ); // Section 1

        // -> Ajouter les éléments du formulaire
        // add_settings_field(
        //     'mylastname',                             // SLUG_FIELD
        //     __('Nom', 'MyCV'),             // LABEL
        //     [self::class,'field_mylastname'],         // CALLBACK
        //     self::GROUP ,                             // SLUG_PAGE
        //     self::SECTION_DETAIL                      // SLUG_SECTION
        // );
        // add_settings_field(
        //     'myfirstname',                            // SLUG_FIELD
        //     __('Prénom', 'MyCV'),            // LABEL
        //     [self::class,'field_myfirstname'],        // CALLBACK
        //     self::GROUP ,                             // SLUG_PAGE
        //     self::SECTION_DETAIL                      // SLUG_SECTION
        // );

        add_settings_field(
            'myfullname',                            // SLUG_FIELD
            __('Nom complet', 'MyCV'),            // LABEL
            [self::class,'field_myfullname'],        // CALLBACK
            self::GROUP ,                             // SLUG_PAGE
            self::SECTION_DETAIL                      // SLUG_SECTION
        );

        add_settings_field(
            'mybirthday',                           // SLUG_FIELD
            __('Date de naissance', 'MyCV'),            // LABEL
            [self::class,'field_mybirthday'],       // CALLBACK
            self::GROUP ,                           // SLUG_PAGE
            self::SECTION_DETAIL                    // SLUG_SECTION
        );

        // -> Sauvegarder les champs
        register_setting(self::GROUP, 'mylastname');
        register_setting(self::GROUP, 'myfirstname');
        register_setting(self::GROUP, 'mybirthday');



        /**
         * SECTION 2 : SECTION_LOCATION ===================================
         *             -> Créer la section
         *             -> Ajouter les éléments du formulaire
         *             -> Sauvegarder les champs
         *
         */
        // -> créer la section
        add_settings_section(
            self::SECTION_LOCATION,                 // SLUG_SECTION
            __('Mes coordonnés', 'MyCV'),         // TITLE
            [self::class, 'display_section_location'],  // CALLBACK
            self::GROUP                         // SLUG_PAGE
        ); // Section 2

        // -> Ajouter les éléments du formulaire
        add_settings_field(
            'mylocation',                              // SLUG_FIELD
            __('Localité', 'MyCV'),               // LABEL
            [self::class,'field_mylocation'],          // CALLBACK
            self::GROUP ,                           // SLUG_PAGE
            self::SECTION_LOCATION                    // SLUG_SECTION
        );
        add_settings_field(
            'myemail',                              // SLUG_FIELD
            __('Email', 'MyCV'),               // LABEL
            [self::class,'field_myemail'],          // CALLBACK
            self::GROUP ,                           // SLUG_PAGE
            self::SECTION_LOCATION                    // SLUG_SECTION
        );
        add_settings_field(
            'myphone',                              // SLUG_FIELD
            __('Téléphone', 'MyCV'),        // LABEL
            [self::class,'field_myphone'],          // CALLBACK
            self::GROUP ,                           // SLUG_PAGE
            self::SECTION_LOCATION                    // SLUG_SECTION
        );

        // -> Sauvegarder les champs
        register_setting(self::GROUP, 'mylocation');
        register_setting(self::GROUP, 'myemail');
        register_setting(self::GROUP, 'myphone');

        /**
         * SECTION 3 : SECTION_POST ===================================
         *             -> Créer la section
         *             -> Ajouter les éléments du formulaire
         *             -> Sauvegarder les champs
         *
         */
        // -> créer la section
        add_settings_section(
            self::SECTION_POST,                 // SLUG_SECTION
            __('Post', 'MyCV'),         // TITLE
            [self::class, 'display_section_post'],  // CALLBACK
            self::GROUP                         // SLUG_PAGE
        ); // Section 3

        // -> Ajouter les éléments du formulaire
        add_settings_field(
            'job_title',                            // SLUG_FIELD
            __('Titre du job', 'MyCV'),          // LABEL
            [self::class,'field_job_title'],        // CALLBACK
            self::GROUP ,                           // SLUG_PAGE
            self::SECTION_POST                    // SLUG_SECTION
        );

        // -> Sauvegarder les champs
        register_setting(self::GROUP, 'title_job_fr');
        register_setting(self::GROUP, 'title_job_en');
        register_setting(self::GROUP, 'title_job_it');
    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_DETAIL ==========================================
    public static function display_section_detail(){
        ?>
        <p class="section-description">
            <?php _e('Section dédiée aux informations personnels', 'MyCV') ?>
        </p>
        <?php
    }

    // SECTION 2 : SECTION_LOCATION ========================================
    public static function display_section_location(){
    ?>
      <p class="section-description">
        <?php _e('Section dédiée aux informations de contact', 'MyCV') ?>
      </p>
    <?php
    }
    public static function display_section_post(){
    ?>
      <p class="section-description">
        <?php _e('Section dédiée à la traduction du post', 'MyCV') ?>
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
    public static function field_myfullname(){
      $mylastname = esc_attr(get_option('mylastname'));
      $myfirstname = esc_attr(get_option('myfirstname'));
      ?>
        <div>
          <input type="text"
                id="mylastname"
                name="mylastname"
                value="<?php echo $mylastname ?>"
                class="regular-text"
                 placeholder="Nom"
          />
          <input type="text"
                id="myfirstname"
                name="myfirstname"
                value="<?php echo $myfirstname ?>"
                class="regular-text"
                 placeholder="Prénom"
          />
        </div>
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


    // SECTION 2 : SECTION_LOCATION ========================================
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

    // SECTION 3 : SECTION_POST ============================================
    public static function field_job_title(){
        $title_job_fr = esc_attr(get_option('title_job_fr'));
        $title_job_en = esc_attr(get_option('title_job_en'));
        $title_job_it = esc_attr(get_option('title_job_it'));
        ?>
        <div class="grid-cols-3">
          <div class="grid-box">
            <p class="box-title"><?php _e("Français", "mycv") ?></p>
            <div>
              <input type="text"
                     id="title_job_fr"
                     name="title_job_fr"
                     value="<?php echo $title_job_fr ?>"
                     class="regular-text"
                     placeholder="<?php _e("Titre du post en français", "mycv") ?>"
              />
            </div>
          </div>
          <div class="grid-box">
            <p class="box-title"><?php _e("Anglais", "mycv") ?></p>
            <div>
              <input type="text"
                     id="title_job_en"
                     name="title_job_en"
                     value="<?php echo $title_job_en ?>"
                     class="regular-text"
                     placeholder="<?php _e("Titre du post en anglais", "mycv") ?>"
              />
            </div>
          </div>
          <div class="grid-box">
            <p class="box-title"><?php _e("Italien", "mycv") ?></p>
            <div>
              <input type="text"
                     id="title_job_it"
                     name="title_job_it"
                     value="<?php echo $title_job_it ?>"
                     class="regular-text"
                     placeholder="<?php _e("Titre du post en italien", "mycv") ?>"
              />
            </div>
          </div>
        </div>
        <?php
    }

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycv_myprofil')){
    mycv_myprofil::register();
}
