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
            'name_company'      => __('Établissement', 'MyCV'),
            'year'              => __('Année', 'MyCV'),
            'current_experience'=> __('État', 'MyCV'),
            'is_internship'     => __('Stage', 'MyCV'),
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
        // this column displays the name of the company
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

        // this column displays the year
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

        // this column displays if the experiment is still in progress
        if ($column === 'current_experience'){
            $internship = get_post_meta($postId, 'current_experience', true);

            if(!empty(get_post_meta($postId, 'current_experience', true))){
                if(checked(1, $internship, false)){
                    _e("C'est en cours", "MyCV");
                } elseif(checked(2, $internship, false)){
                    _e("Travail fini", "MyCV");
                }

            } else {
                echo "";
            }
        }

        // this column displays if the experience is an internship
        if ($column === 'is_internship'){
            $internship = get_post_meta($postId, 'is_internship', true);

            if(!empty(get_post_meta($postId, 'is_internship', true))){
                if(checked(1, $internship, false)){
                    _e("C'est un stage", "MyCV");
                } elseif(checked(2, $internship, false)){
                    _e("Non", "MyCV");
                }

            } else {
                echo "";
            }
        }
    },
    10,
    2
);