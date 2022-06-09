<?php
/**
 * Name file: cpt_formations
 * Description: This file allow create a Custom Post Type for formations
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */



if(!function_exists('CPT_formations')){
    function CPT_formations(){
        /**
         * définir les options du label
         * @var array
         */
        $labels = array(
            'name'               => _x('Formations', 'MyCV'),
            'singular_name'      => _x('Formation', 'MyCV'),
            'menu_name'          => _x('Formations', 'MyCV'),
            'name_admin_bar'     => __('Formation', 'MyCV'),
            'all_items'          => __('Toutes les formations', 'MyCV'),
            'add_new'            => __('Ajouter', 'MyCV'),
            'add_new_item'       => __('Ajouter une nouvelle formation', 'MyCV'),
            'new_item'           => __('Nouvelle formation', 'MyCV'),
            'edit_item'          => __('Modifier la formation', 'MyCV'),
            'view_item'          => __('Afficher la formation', 'MyCV'),
            'view_items'         => __('Afficher les formations', 'MyCV'),
            'search_items'       => __('Chercher dans les formations', 'MyCV'),
            'not_found'          => __('Aucune formation trouvée', 'MyCV'),
            'not_fount_in_trash' => __('Aucune formation trouvée dans la corbeille', 'MyCV'),
            'filter_items_list'  => __('Filtrer la liste des formations', 'MyCV'),
            'attributes'         => __('Attributs de la formation', 'MyCV')
        );

        /**
         * définir les option de rewrite
         * @var array
         */
        $rewrite = array(
            'slug'         => 'formations',
            //'with_front'   => true,
            //'hierarchical' => false,
        );

        /**
         * définir les option de supports
         * @var array
         */
        $supports = array(
            'title',           // titre
            'editor',          // editeur
            //'thumbnail',       // image à la une
            //'author',          // auteur du post
            //'excerpt',         // extrait
            //'comments'         // commentaires autorisé
        );

        /**
         * définir l'icon SVG
         * @var array
         */
        $iconSVG = 'data:image/svg+xml;base64,' . base64_encode(
                '<svg width="36px" height="34px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                            <path fill="black" 
                                  d="m502.024 156.633c5.987-2.128 9.983-7.797 9.976-14.151-.008-6.354-4.018-12.013-10.009-14.127l-241-85.031c-3.229-1.14-6.752-1.14-9.981 0l-241 85.031c-5.992 2.113-10.002 7.773-10.01 14.127s3.989 12.023 9.976 14.151l95.469 33.94v97.847c0 16.149 16.847 29.806 50.073 40.59 28.961 9.4 64.647 14.577 100.483 14.577s71.521-5.177 100.483-14.577c33.226-10.784 50.073-24.44 50.073-40.59v-97.847l39.417-14.013v135.584c-17.529 6.198-30.125 22.927-30.125 42.552 0 19.624 12.596 36.354 30.125 42.552v57.285c0 8.284 6.716 15 15 15s15-6.716 15-15v-57.285c17.529-6.198 30.125-22.927 30.125-42.552 0-19.624-12.596-36.354-30.125-42.552v-146.25zm-41.051 213.187c-8.34 0-15.125-6.785-15.125-15.125s6.785-15.125 15.125-15.125 15.125 6.785 15.125 15.125-6.785 15.125-15.125 15.125zm-204.973-296.445 196.069 69.179-196.069 69.703-196.069-69.704zm120.556 212.784c-2.875 2.898-13.167 9.839-36.396 16.466-24.781 7.069-54.67 10.962-84.16 10.962s-59.378-3.893-84.16-10.962c-23.229-6.627-33.521-13.567-36.396-16.466v-84.921l115.531 41.072c1.625.578 3.325.867 5.024.867 1.7 0 3.399-.289 5.024-.867l115.531-41.072v84.921z"
                            />
                      </svg>'
            );

        /**
         * définir les arguments du custom post type
         * @var array
         */
        $args = array(
            'labels'            => $labels,
            'rewrite'           => $rewrite,
            'supports'          => $supports,
            'public'            => true,
            'hierarchical'      => false,               // parent / child
            //'hierarchical'      => true,              // parent / child
            //'has_archive'       => true,              // c'est une archive => archive-{$post-type}
            'has_archive'       => false,               // c'est une page => page-{$post-type}
            //'show_in_rest'      => true,              // oui => afficher editeur Gutemberg
            'show_in_rest'      => false,               // non => afficher editeur Gutemberg
            'show_in_menu'      => true,
            'show_in_nav_menus' => false,
            'query_var'         => true,
            'capability_type'   => 'post',
            'menu_position'     => 8,
            //'menu_icon'         => 'dashicons-images-alt',
            'menu_icon'         => $iconSVG,
        );

        register_post_type('formations', $args);
    }
}
add_action('init', 'CPT_formations');