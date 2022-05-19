<?php
/**
 * Name file: cpt_experiences
 * Description: This file allow create a Custom Post Type for experiences
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */



if(!function_exists('CPT_experiences')){
    function CPT_experiences(){
        /**
         * définir les options du label
         * @var array
         */
        $labels = array(
            'name'               => _x('Expériences', 'MyCV'),
            'singular_name'      => _x('Expérience', 'MyCV'),
            'menu_name'          => _x('Expériences', 'MyCV'),
            'name_admin_bar'     => __('Expérience', 'MyCV'),
            'all_items'          => __('Toutes les expériences', 'MyCV'),
            'add_new'            => __('Ajouter', 'MyCV'),
            'add_new_item'       => __('Ajouter une nouvelle expérience', 'MyCV'),
            'new_item'           => __('Nouvelle expérience', 'MyCV'),
            'edit_item'          => __('Modifier l\'expérience', 'MyCV'),
            'view_item'          => __('Afficher l\'expérience', 'MyCV'),
            'view_items'         => __('Afficher les expériences', 'MyCV'),
            'search_items'       => __('Chercher dans les expérience', 'MyCV'),
            'not_found'          => __('Aucune expérience trouvée', 'MyCV'),
            'not_fount_in_trash' => __('Aucune expérience trouvée dans la corbeille', 'MyCV'),
            'filter_items_list'  => __('Filtrer la liste des expériences', 'MyCV'),
            'attributes'         => __('Attributs de l\'expérience', 'MyCV')
        );

        /**
         * définir les option de rewrite
         * @var array
         */
        $rewrite = array(
            'slug'         => 'experiences',
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
                          d="m497.09375 60.003906c-.03125 0-.0625-.003906-.09375-.003906h-136v-15c0-24.8125-20.1875-45-45-45h-120c-24.8125 0-45 20.1875-45 45v15h-136c-8.351562 0-15 6.84375-15 15v330c0 24.8125 20.1875 45 45 45h422c24.8125 0 45-20.1875 45-45v-329.683594c0-.019531 0-.039062 0-.058594-.574219-9.851562-6.632812-15.199218-14.90625-15.253906zm-316.09375-15.003906c0-8.269531 6.730469-15 15-15h120c8.269531 0 15 6.730469 15 15v15h-150zm295.1875 45-46.582031 139.742188c-2.042969 6.136718-7.761719 10.257812-14.226563 10.257812h-84.378906v-15c0-8.285156-6.714844-15-15-15h-120c-8.285156 0-15 6.714844-15 15v15h-84.378906c-6.464844 0-12.183594-4.121094-14.226563-10.257812l-46.582031-139.742188zm-175.1875 150v30h-90v-30zm181 165c0 8.269531-6.730469 15-15 15h-422c-8.269531 0-15-6.730469-15-15v-237.566406l23.933594 71.796875c6.132812 18.40625 23.289062 30.769531 42.6875 30.769531h84.378906v15c0 8.285156 6.714844 15 15 15h120c8.285156 0 15-6.714844 15-15v-15h84.378906c19.398438 0 36.554688-12.363281 42.6875-30.769531l23.933594-71.796875zm0 0"
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
            'hierarchical'      => false,
            //'hierarchical'      => true,              // parent / child
            //'has_archive'       => true,              // c'est une archive => archive-{$post-type}
            'has_archive'       => false,               // c'est une page => page-{$post-type}
            //'show_in_rest'      => true,              // oui => afficher editeur Gutemberg
            'show_in_rest'      => false,               // non => afficher editeur Gutemberg
            'show_in_menu'      => true,
            'show_in_nav_menus' => false,
            'query_var'         => true,
            'capability_type'   => 'post',
            'menu_position'     => 7,
            //'menu_icon'         => 'dashicons-images-alt',
            'menu_icon'         => $iconSVG,
        );

        register_post_type('experiences', $args);
    }
}
add_action('init', 'CPT_experiences');