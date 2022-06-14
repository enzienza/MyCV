<?php
/**
 * Name file: MB_info_formation
 * Description: File creating a MetaBox for completing informations the Custom Post Type
 *              -> this Metabox allows you to add (or not) a list of additional training information for the CPT_formation
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */

/**
 * Table of Contents:
 *
 * 1 - DEFINIR LES VALEURS (repeter)
 * 2 - DEFINIR LES HOOKS ACTIONS
 * 3 - CONSTRUCTION DE LA METABOX
 * 4 - DEFENIR LA METABOX (template & champs)
 * 5 - SAUVEGARDER LES DONNEES DE LA METABOX
 */

class MB_info_formation{
    /**
     *1 - DEFINIR LES VALEURS (repeter)
     */
    //const TITLE_MB = "Information";
    const META_KEY = 'info_formation';
    const NONCE    = '_info_formation';
    const SCREEN = array('formations');

    /**
     *2 - DEFINIR LES HOOKS ACTIONS
     */
    public static function register(){
        add_action('add_meta_boxes', [self::class, 'add'], 10, 2);
        add_action('save_post', [self::class, 'save']);
    }

    /**
     *3 - CONSTRUCTION DE LA METABOX
     */
    public static function add($postType, $POST){
        if (current_user_can('publish_posts', $POST)) {
            add_meta_box(
                self::META_KEY,             // ID_META_BOX
                __('Information formation', 'MyCV'),            // TITLE_META_BOX
                [self::class, 'render'],        // CALLBACK
                self::SCREEN,            // WP_SCREEN
                'side',             // CONTEXT [ normal | advanced | side ]
                'high'                  // PRIORITY [ high | default | low ]
            );
        }
    }

    /**
     *4 - DEFENIR LA METABOX (template & champs)
     */
    public static function render($POST){
        wp_nonce_field(self::NONCE, self::NONCE);
        $view_details = get_post_meta($POST->ID, 'view_details', true);
        ?>
        <div class="components-base-control__field">
            <div>
                <p class="font-bold no-align mr-1"><?php _e("Afficher le détail du diplôme", "MyCV"); ?></p>
                <input type="radio" name="view_details" value="1" <?php checked(1, $view_details, true) ?>/><?php _e("Oui", "MyCV"); ?>
                <input type="radio" name="view_details" value="2" <?php checked(2, $view_details, true) ?>/><?php _e("Non", "MyCV"); ?>
            </div>
        </div>
        <?php
    }

    /**
     *5 - SAUVEGARDER LES DONNEES DE LA METABOX
     */
    public static function save($POST_ID){
        if( current_user_can('publish_posts', $POST_ID)){

            // save $current_experience -----------------------------------------------------
            if(isset($_POST['view_details'])) {
                if ($_POST['view_details'] === '') {
                    delete_post_meta( $POST_ID, 'view_details', $_POST['view_details'] );
                } else {
                    update_post_meta( $POST_ID, 'view_details', $_POST['view_details'] );
                }
            }

        }
    }
}
if(class_exists('MB_info_formation')){
    MB_info_formation::register();
}