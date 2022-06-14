<?php
/**
 * Name file: MB_company
 * Description: File creating a MetaBox for completing informations the Custom Post Type
 *              -> this Metabox adding the year for CPT_experience
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

class MB_company{
    /**
     *1 - DEFINIR LES VALEURS (repeter)
     */
    //const TITLE_MB = "Information";
    const META_KEY = 'company_info';
    const NONCE    = '_company_info';
    const SCREEN = array('experiences', 'formations');

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
                __('Entreprise', 'MyCV'),       // TITLE_META_BOX
                [self::class, 'render'],        // CALLBACK
                self::SCREEN,            // WP_SCREEN
                'advanced',             // CONTEXT [ normal | advanced | side ]
                'high'                  // PRIORITY [ high | default | low ]
            );
        }
    }

    /**
     *4 - DEFENIR LA METABOX (template & champs)
     */
    public static function render($POST){
        wp_nonce_field(self::NONCE, self::NONCE);
        $name_company = get_post_meta($POST->ID, 'name_company', true);
        $locality_company = get_post_meta($POST->ID, 'locality_company', true);
        $country_company = get_post_meta($POST->ID, 'country_company', true);
        ?>
        <div class="components-base-control__field">
            <p class="desc">
                <?php _e("Compléter avec les informations de l'entreprise", "MyCV") ?>
            </p>
            <div>
                <label for=""><?php _e("Nom", "MyCV") ?></label>
                <input type="text"
                       name="name_company"
                       id="name_company"
                       value="<?php echo $name_company ?>"
                       placeholder="<?php _e('', 'MyCV'); ?>"
                />
            </div>
            <div>
                <label for=""><?php _e("Localité", "MyCV") ?></label>
                <input type="text"
                       name="locality_company"
                       id="locality_company"
                       value="<?php echo $locality_company ?>"
                       placeholder="<?php _e('', 'MyCV'); ?>"
                />
            </div>
            <div>
                <label for=""><?php _e("Pays", "MyCV") ?></label>
                <input type="text"
                       name="country_company"
                       id="country_company"
                       value="<?php echo $country_company ?>"
                       placeholder="<?php _e('', 'MyCV'); ?>"
                />
            </div>
        </div>
        <?php
    }

    /**
     *5 - SAUVEGARDER LES DONNEES DE LA METABOX
     */
    public static function save($POST_ID){
        if( current_user_can('publish_posts', $POST_ID)){

            // save $name_company -----------------------------------------------------
            if(isset($_POST['name_company'])) {
                if ($_POST['name_company'] === '') {
                    delete_post_meta( $POST_ID, 'name_company', $_POST['name_company'] );
                } else {
                    update_post_meta( $POST_ID, 'name_company', $_POST['name_company'] );
                }
            }

            // save $locality_company -----------------------------------------------------
            if(isset($_POST['locality_company'])) {
                if ($_POST['locality_company'] === '') {
                    delete_post_meta( $POST_ID, 'locality_company', $_POST['locality_company'] );
                } else {
                    update_post_meta( $POST_ID, 'locality_company', $_POST['locality_company'] );
                }
            }

            // save $country_company -----------------------------------------------------
            if(isset($_POST['country_company'])) {
                if ($_POST['country_company'] === '') {
                    delete_post_meta( $POST_ID, 'country_company', $_POST['country_company'] );
                } else {
                    update_post_meta( $POST_ID, 'country_company', $_POST['country_company'] );
                }
            }
        }
    }
}
if(class_exists('MB_company')){
    MB_company::register();
}