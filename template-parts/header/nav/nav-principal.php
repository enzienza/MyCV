<?php
/**
 * Name file: nav-principal
 * Description: Display the principal navigation
 * Important: this navigation is fix
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>


<div class="nav-principal">
    <?php
    /**
     * [navigation principal]
     */
    wp_nav_menu(array(
        'theme_location' => 'aside',
        'depth'          => 2,
        'container'      => false,
        'menu_class'     => 'navbar-nav w-100 flex-column',
    ));
    ?>
</div>