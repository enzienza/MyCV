<?php
/**
 * Name file: MB_skill
 * Description: File creating a MetaBox for completing informations the Custom Post Type
 *              -> this Metabox adding a array for listing skill so level
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

class MB_skill{
    /**
     *1 - DEFINIR LES VALEURS (repeter)
     */
    //const TITLE_MB = "Information";
    const META_KEY = 'skill_progerss';
    const NONCE    = '_skill_progerss';
    const SCREEN = array('competences');

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
                __('Listez vos compétences', 'MyCV'),            // TITLE_META_BOX
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
        $list_skill = get_post_meta($POST->ID, 'list_skill', true);
        ?>
        <script type="text/javascript">
              jQuery(document).ready(function ($) {
                $('#add-row').on('click', function () {
                  let row = $('.empty-row.screen-reader-text').clone(true);
                  row.removeClass('empty-row screen-reader-text');
                  row.insertBefore('#list_skills tbody>tr:last');
                  return false;
                });

                $('.remove-row').on('click', function () {
                  $(this).parents('tr').remove();
                  return false;
                });
              });
        </script>

        <div class="components-base-control__field">
            <p class="desc">
                <?php _e("Compléter avec le nom des langages/programmes ainsi que le niveau de maîtrise", "MyCV") ?>
            </p>

            <table id="list_skills" width="100%">
                <thead>
                    <tr>
                        <td width="30%"><?php _e('Nom', "MyCV"); ?></td>
                        <td width="10%"><?php _e('Proucent', "MyCV"); ?></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($list_skill) : foreach ($list_skill as $field) { ?>
                        <tr>
                            <td>
                                <input type="text"
                                       class="widefat"
                                       name="name[]"
                                       value="<?php if($field['name'] != '') echo $field['name'] ?>"
                                />
                            </td>
                            <td>
                                <input type="number"
                                       class="widefat"
                                       name="percent[]"
                                       value="<?php if($field['percent'] != '') echo $field['percent'] ?>"
                                       min="10" step="5" max="100"
                                />
                            </td>
                            <td>
                                <a href="#" class="button remove-row"><?php _e('Supprimer', 'MyCV'); ?></a>
                            </td>
                        </tr>

                    <?php } else : // show a blank one ?>
                        <tr>
                            <td><input type="text"  class="widefat"  name="name[]" value="" /></td>
                            <td><input type="number"  class="widefat"  name="percent[]" min="10" step="5" max="100" /></td>
                            <td><a href="#" class="button remove-row"><?php _e('Supprimer', 'MyCV'); ?></a></td>
                        </tr>
                    <?php endif; ?>

                    <!-- empty hidden one for jQuery -->
                    <tr class="empty-row screen-reader-text">
                        <td><input type="text" class="widefat" name="name[]" value="" /></td>
                        <td><input type="number" class="widefat" name="percent[]" value="" min="10" step="5" max="100" /></td>
                        <td><a href="#" class="button remove-row"><?php _e('Supprimer', 'MyCV'); ?></a></td>
                    </tr>
                </tbody>
            </table>

            <p>
                <a id="add-row" class="button" href="#"><?php _e('Ajouter', 'MyCV'); ?></a>
            </p>
        </div>
        <?php
    }

    /**
     *5 - SAUVEGARDER LES DONNEES DE LA METABOX
     */
    public static function save($POST_ID){
        if( current_user_can('publish_posts', $POST_ID)){
            // Check if our nonce is set.
            if ( ! isset( $_POST[self::NONCE] ) ) {
                return $POST_ID;
            }

            $nonce = $_POST[self::NONCE];

            // Verify that the nonce is valid.
            if ( !wp_verify_nonce( $nonce, self::NONCE ) ) {
                return $POST_ID;
            }

            // If this is an autosave, our form has not been submitted, so we don't want to do anything.
            if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
                return $POST_ID;
            }

            // Check the user's permissions.
            if(!current_user_can('edit_post', $POST_ID)) {
                return $POST_ID;
            }

            // Recovery the array get_post_meta() & define a new array
            $old = get_post_meta($POST_ID, 'list_skill', true);
            $new = array();

            // define namespace
            $names = $_POST['name'];
            $percents = $_POST['percent'];

            // counts all elements in array
            $count = count($names);

            // define loop for()
            for ($i = 0; $i < $count; $i++) {

                if ($names[$i] != '') {
                    $new[$i]['name'] = $names[$i];

                    if ($percents[$i] != '') {
                        $new[$i]['percent'] = $percents[$i];
                    };
                }

                if (!empty($new) && $new != $old)
                    update_post_meta($POST_ID, 'list_skill', $new);
                elseif (empty($new) && $old)
                    delete_post_meta($POST_ID, 'list_skill', $old);
            }
        }
        return $POST_ID;
    }
}
if(class_exists('MB_skill')){
    MB_skill::register();
}