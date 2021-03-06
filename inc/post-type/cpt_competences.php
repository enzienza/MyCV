<?php
/**
 * Name file: cpt_competences
 * Description: This file allow create a Custom Post Type for competences
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */



if(!function_exists('CPT_competences')){
    function CPT_competences(){
        /**
         * définir les options du label
         * @var array
         */
        $labels = array(
            'name'               => _x('Compétences', 'MyCV'),
            'singular_name'      => _x('Compétence', 'MyCV'),
            'menu_name'          => _x('Compétences', 'MyCV'),
            'name_admin_bar'     => __('Compétence', 'MyCV'),
            'all_items'          => __('Toutes les compétences', 'MyCV'),
            'add_new'            => __('Ajouter', 'MyCV'),
            'add_new_item'       => __('Ajouter une nouvelle compétence', 'MyCV'),
            'new_item'           => __('Nouvelle compétence', 'MyCV'),
            'edit_item'          => __('Modifier la compétence', 'MyCV'),
            'view_item'          => __('Afficher la compétence', 'MyCV'),
            'view_items'         => __('Afficher les compétences', 'MyCV'),
            'search_items'       => __('Chercher dans les compétences', 'MyCV'),
            'not_found'          => __('Aucune compétence trouvée', 'MyCV'),
            'not_fount_in_trash' => __('Aucune compétence trouvée dans la corbeille', 'MyCV'),
            'filter_items_list'  => __('Filtrer la liste des compétences', 'MyCV'),
            'attributes'         => __('Attributs de la compétence', 'MyCV')
        );

        /**
         * définir les option de rewrite
         * @var array
         */
        $rewrite = array(
            'slug'         => 'competences',
            //'with_front'   => true,
            //'hierarchical' => false,
        );

        /**
         * définir les option de supports
         * @var array
         */
        $supports = array(
            'title',           // titre
            //'editor',          // editeur
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
                          d="m507.863 193.145s-73.229-53.012-73.26-53.035c-4.322-3.129-10.753-2.23-13.973 2.23-3.198 4.429-2.198 10.771 2.241 13.961l56.001 40.55-40.21 10.572c-6.53-10.392-18.093-17.319-31.252-17.319-10.718 0-20.379 4.596-27.124 11.915l-88.039-44.528c.455-2.31.7-4.694.7-7.136 0-16.835-11.354-31.061-26.807-35.454v-72.048s83.799 60.664 83.8 60.665c4.323 3.129 10.747 2.237 13.973-2.23 3.199-4.43 2.18-10.767-2.23-13.972l-100.048-72.417c-1.72-1.239-3.751-1.899-5.871-1.899-2.111 0-4.141.649-5.852 1.899l-245.768 177.595c-3.541 2.561-5.001 7.071-3.641 11.222l94.336 288.003c1.35 4.11 5.161 7.281 9.492 7.281h304.084c4.341 0 8.162-2.78 9.503-6.911l93.585-287.754c1.351-4.14-.118-8.64-3.64-11.19zm-100.454 16.959c9.31 0 16.884 7.564 16.884 16.863s-7.574 16.864-16.884 16.864c-9.311 0-16.885-7.565-16.885-16.864s7.575-16.863 16.885-16.863zm-124.231-34.791 88.044 44.534c-.351 1.785-.573 3.614-.656 5.48l-104.427 27.455v-66.972c6.624-1.884 12.494-5.568 17.039-10.497zm-49.167 140.818 22.153-32.616 75.47 110.39-89.299-45.762c.537-2.5.827-5.09.827-7.748 0-9.287-3.461-17.775-9.151-24.264zm-16.757-10.934c-3.469-1.083-7.155-1.667-10.976-1.667-6.409 0-12.44 1.645-17.697 4.531l-62.212-66.086 113.548 29.854zm5.908 35.198c0 9.299-7.574 16.864-16.884 16.864s-16.884-7.565-16.884-16.864 7.574-16.864 16.884-16.864 16.884 7.565 16.884 16.864zm-91.924-122.857 96.605-43.48c4.712 5.596 11.055 9.77 18.291 11.794v66.93l-114.498-30.103c-.015-1.745-.148-3.462-.398-5.141zm124.825-84.047c9.31 0 16.884 7.565 16.884 16.864s-7.574 16.864-16.884 16.864-16.884-7.565-16.884-16.864 7.574-16.864 16.884-16.864zm-9.929-91.19v72.559c-15.529 4.345-26.955 18.607-26.955 35.496 0 1.863.142 3.694.41 5.484l-96.586 43.473c-6.771-8.056-16.917-13.188-28.243-13.188-13.635 0-25.556 7.438-31.939 18.462l-30.255-7.955zm-134.49 180.687c0 9.299-7.574 16.864-16.884 16.864s-16.884-7.565-16.884-16.864 7.574-16.864 16.884-16.864c9.309 0 16.884 7.565 16.884 16.864zm-86.262-7.564 32.519 8.549c.526 19.872 16.852 35.879 36.859 35.879 6.143 0 11.935-1.517 17.034-4.183l62.501 66.398c-3.111 5.403-4.901 11.658-4.901 18.327 0 8.77 3.085 16.83 8.22 23.165l-69.964 103.009zm98.264 263.199 70.293-103.493c3.861 1.374 8.013 2.129 12.34 2.129 10.486 0 19.957-4.403 26.678-11.449l90.603 46.43c-.538 2.501-.827 5.092-.827 7.751 0 20.327 16.546 36.864 36.884 36.864 4.705 0 9.202-.895 13.343-2.506l16.835 24.625zm219.085-58.632c0-9.299 7.574-16.863 16.884-16.863s16.884 7.564 16.884 16.863-7.574 16.864-16.884 16.864-16.884-7.565-16.884-16.864zm62.569 46.22-16.347-23.911c4.73-6.198 7.547-13.929 7.547-22.309 0-13.401-7.194-25.152-17.924-31.606l7.424-30.585c1.3-5.36-2-10.78-7.36-12.07-.78-.189-1.58-.29-2.37-.29-4.62 0-8.6 3.141-9.7 7.63-.01 0-7.301 30.067-7.301 30.067-3.393.032-6.676.527-9.794 1.419l-77.076-112.739 102.745-27.013c3.324 5.982 8.265 10.945 14.229 14.302l-1.583 6.514c-1.3 5.359 2 10.779 7.359 12.08.78.189 1.57.279 2.37.279 4.62 0 8.62-3.14 9.71-7.64l1.589-6.543c19.686-.744 35.474-16.974 35.474-36.829 0-.115-.008-.228-.009-.342l42.576-11.194z"
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
            'menu_position'     => 9,
            //'menu_icon'         => 'dashicons-images-alt',
            'menu_icon'         => $iconSVG,
        );

        register_post_type('competences', $args);
    }
}
add_action('init', 'CPT_competences');