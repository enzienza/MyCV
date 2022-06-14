<?php
/**
 * Name file: admin-formations
 * Description: This file allows you to customize the administration columns of the chosen Custom Post type
 *              use hooks : manage_{$post-type}_posts_columns() && manage_{$post-type}_posts_custom_column()
 *
 * @Post-Type formations
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
    'manage_formations_posts_columns',
    function($columns){
        return[
            'cb'                => '<input type="checkbox" />',
            'title'             => $columns['title'],
            'name_company'      => __('Établissement', 'MyCV'),
            'year'              => __('Année', 'MyCV'),
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
    'manage_formations_posts_custom_column',
    function($column, $postId){
        // this column displays the name of the company
        if ($column === 'name_company'){
            $name_company = get_post_meta($postId, 'name_company', true);

            if(!empty($name_company)){
                echo $name_company;
            } else {
                echo "";
            }
        }

        // this column displays the year
        if ($column === 'year'){
            $year = get_post_meta(get_the_ID(), 'year', true);

            if(!empty($year)){
                echo $year;
            } else {
                echo "";
            }
        }

    },
    10,
    2
);