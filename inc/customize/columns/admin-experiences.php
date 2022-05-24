<?php
/**
 * Name file: admin-experiences
 * Description:
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */

/** ------------------------------------
 *  Step 1
 *  [Ajouter les columns]
 */
add_filter(
    'manage_experiences_posts_columns',
    function($columns){
        return[
            'cb'                => '<input type="checkbox" />',
            'title'             => $columns['title'],
            'year'              => __('Année', 'MyCV'),
            'name_company'      => __('Établissement', 'MyCV'),
            'language_fr'       => '',
            'language_en'       => '',
            'language_it'       => '',
            'date'              => $columns['date']
        ];
    }
);

/** ------------------------------------
 *  Step 2
 *  [Afficher le contenu souhaiter]
 */
add_filter(
    'manage_experiences_posts_custom_column',
    function($column, $postId){
        if ($column === 'year'){
            if(!empty(get_post_meta($postId, 'year', true))){
                ?>
                <p>
                    <?php echo get_post_meta(get_the_ID(), 'year', true) ?>
                </p>
                <?php
            } else {
                echo "";
            }
        }
        if ($column === 'name_company'){
            if(!empty(get_post_meta($postId, 'name_company', true))){
                ?>
                <p>
                    <?php echo get_post_meta(get_the_ID(), 'name_company', true) ?>
                </p>
                <?php
            } else {
                echo "";
            }
        }
    },
    10,
    2
);