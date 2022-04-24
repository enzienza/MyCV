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

class mycv_mycustome{

    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     *     afin d'evite les fautes de frappe
     */
    // page info - level 1
    //const INFO_TITLE = 'Mon profile';
    //const INFO_MENU  = 'Mon profile';
    const PERMITION  = 'manage_options';
    const DASHICON   = 'dashicons-admin-multisite';
    const GROUP      = 'mycustome';
    const NONCE      = '_mycustome';

    //definir les sections de la page d'option
    const SECTION_DETAIL = 'section_detail';
    const SECTION_LOCATION = 'section_location';
    const SECTION_POST = 'section_post';


    /**
     * 2 - DEFINIR LES HOOKS ACTIONS
     */
    public static function register(){
        add_action('admin_menu', [self::class, 'addMenu']);
        //add_action('admin_init', [self::class, 'registerSettings']);
        //add_action('admin_enqueue_scripts', [self::class, 'registerScripts']);
    }

    /**
     * 3 - CONSTRUCTION DE LA PAGE
     */
    public static function addMenu(){
        add_menu_page(
            __('Theme Options', 'MyCV'),       // TITLE_PAGE
            __('Theme Options', 'MyCV'),        // TITLE_MENU
            self::PERMITION,           // CAPABILITY
            self::GROUP,              // SLUG_PAGE
            [self::class, 'render'],            // CALLBACK
            self::DASHICON,             // icon
            4                           // POSITION
        );
    }

    /**
     * 4 - TEMPLATE DES PAGES
     */
    public static function render(){
        ?>
        <div class="wrap">
            <h1 class="wp-heagin-inline"><?php _e("Page d'option du theme", 'MyCV') ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer les différents éléments de notre theme', 'MyCV') ?>
            </p><!--./description-->
            <?php settings_errors(); ?>
        </div><!--./wrap-->

        <table class="widefat importers striped">

            <tr class="importer-item">
                <td class="import-system">
                    <span class="importer-title">Header</span>
                    <span class="importer-action">
                      <a href="?page=mycustome_header" class="install-now">Gérer la section</a>
                    </span>
                </td>
                <td class="desc">
                    <span class="importer-desc">
                      Lien pour gérer l'affichage de l'header
                    </span>
                </td>
            </tr>

            <tr class="importer-item">
                <td class="import-system">
                    <span class="importer-title">Accueil</span>
                    <span class="importer-action">
                      <a href="?page=mycustome_home" class="install-now">Gérer la section</a>
                    </span>
                </td>
                <td class="desc">
                    <span class="importer-desc">
                      Lien pour gérer l'affichage de la section accueil
                    </span>
                </td>
            </tr>

            <tr class="importer-item">
                <td class="import-system">
                    <span class="importer-title">À propos</span>
                    <span class="importer-action">
                      <a href="?page=mycustome_about" class="install-now">Gérer la section</a>
                    </span>
                </td>
                <td class="desc">
                    <span class="importer-desc">
                      Lien pour gérer l'affichage de la section è propos
                    </span>
                </td>
            </tr>

            <tr class="importer-item">
                <td class="import-system">
                    <span class="importer-title">Expérience</span>
                    <span class="importer-action">
                      <a href="?" class="install-now">Gérer la section</a>
                    </span>
                </td>
                <td class="desc">
                    <span class="importer-desc">
                      Lien pour gérer l'affichage de la section expérience
                    </span>
                </td>
            </tr>

            <tr class="importer-item">
                <td class="import-system">
                    <span class="importer-title">Formation</span>
                    <span class="importer-action">
                      <a href="?" class="install-now">Gérer la section</a>
                    </span>
                </td>
                <td class="desc">
                    <span class="importer-desc">
                      Lien pour gérer l'affichage de la section formation
                    </span>
                </td>
            </tr>

            <tr class="importer-item">
                <td class="import-system">
                    <span class="importer-title">Compétence</span>
                    <span class="importer-action">
                      <a href="?" class="install-now">Gérer la section</a>
                    </span>
                </td>
                <td class="desc">
                    <span class="importer-desc">
                      Lien pour gérer l'affichage de la section compétence
                    </span>
                </td>
            </tr>

            <tr class="importer-item">
                <td class="import-system">
                    <span class="importer-title">Contact</span>
                    <span class="importer-action">
                      <a href="?" class="install-now">Gérer la section</a>
                    </span>
                </td>
                <td class="desc">
                    <span class="importer-desc">
                      Lien pour gérer l'affichage de la section contact
                    </span>
                </td>
            </tr>

            <tr class="importer-item">
                <td class="import-system">
                    <span class="importer-title">Erreur 404</span>
                    <span class="importer-action">
                      <a href="?" class="install-now">Gérer la page</a>
                    </span>
                </td>
                <td class="desc">
                    <span class="importer-desc">
                      Lien pour gérer l'affichage de la la page d'erreur
                    </span>
                </td>
            </tr>

        </table>
        <?php
    }

    /**
     * 5 - ENREGISTRER LES PARAMETTRES D'OPTIONS
     */
//    public static function registerSettings(){}

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */



    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */


    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */

    /**
     * 9 - AJOUT STYLE ET SCRIPT
     */
}

if(class_exists('mycv_mycustome')){
    mycv_mycustome::register();
}
