<?php
/**
 * Name file: MB_info_resume
 * Description: File creating a MetaBox for completing informations the Custom Post Type
 *              -> this Metabox add additional information on the job occupied for the CPT_experience
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

class MB_info_resume{
    /**
     *1 - DEFINIR LES VALEURS (repeter)
     */
    //const TITLE_MB = "Information";
    const META_KEY = 'info_resume';
    const NONCE    = '_info_resume';
    const SCREEN = array('experiences');

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
                __('Information expérience', 'MyCV'),            // TITLE_META_BOX
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
        $current_experience = get_post_meta($POST->ID, 'current_experience', true);
        $is_internship = get_post_meta($POST->ID, 'is_internship', true);
        ?>
        <div class="components-base-control__field">
            <div>
                <p class="font-bold no-align mr-1"><?php _e("Le poste est-il toujours en cours ?", "MyCV"); ?></p>
                <input type="radio" name="current_experience" value="1" <?php checked(1, $current_experience, true) ?>/><?php _e("Oui", "MyCV"); ?>
                <input type="radio" name="current_experience" value="2" <?php checked(2, $current_experience, true) ?>/><?php _e("Non", "MyCV"); ?>
            </div>
            <div>
                <p class="font-bold no-align mr-1"><?php _e("Était-ce un stage ?", "MyCV"); ?></p>
                <input type="radio" name="is_internship" value="1" <?php checked(1, $is_internship, true) ?>/><?php _e("Oui", "MyCV"); ?>
                <input type="radio" name="is_internship" value="2" <?php checked(2, $is_internship, true) ?>/><?php _e("Non", "MyCV"); ?>
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
            if(isset($_POST['current_experience'])) {
                if ($_POST['current_experience'] === '') {
                    delete_post_meta( $POST_ID, 'current_experience', $_POST['current_experience'] );
                } else {
                    update_post_meta( $POST_ID, 'current_experience', $_POST['current_experience'] );
                }
            }

            // save $is_internship -----------------------------------------------------
            if(isset($_POST['is_internship'])) {
                if ($_POST['is_internship'] === '') {
                    delete_post_meta( $POST_ID, 'is_internship', $_POST['is_internship'] );
                } else {
                    update_post_meta( $POST_ID, 'is_internship', $_POST['is_internship'] );
                }
            }
        }
    }
}
if(class_exists('MB_info_resume')){
    MB_info_resume::register();
}