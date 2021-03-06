<?php
/**
 * Name file: admin-experiences
 * Description: This file allows you to customize the administration columns of the chosen Custom Post type
 *              use hooks : manage_{$post-type}_posts_columns() && manage_{$post-type}_posts_custom_column()
 *
 * @Post-Type experiences
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

        // this column displays if the experiment is still in progress
        if ($column === 'current_experience'){
            $currect = get_post_meta($postId, 'current_experience', true);

            if(!empty($currect)){
                if(checked(1, $currect, false)){
                    ?>
                        <p class="is-current">
                            <?php _e("En cours", "MyCV"); ?>
                        </p>
                    <?php
                } elseif(checked(2, $currect, false)){
                    ?>
                        <p class="no-current">
                            <?php _e("Travail fini", "MyCV"); ?>
                        </p>
                    <?php
                }

            } else {
                echo "";
            }
        }

        // this column displays if the experience is an internship
        if ($column === 'is_internship'){
            $internship = get_post_meta($postId, 'is_internship', true);

            if(!empty($internship)){
                if(checked(1, $internship, false)){
                    ?>
                    <p class="is-stage">
                        <?_e("C'est un stage", "MyCV");?>
                    </p>
                    <?php
                } elseif(checked(2, $internship, false)){
                    ?>
                    <p class="no-stage">
                        <?_e("Non", "MyCV");?>
                    </p>
                    <?php
                }

            } else {
                echo "";
            }
        }
    },
    10,
    2
);