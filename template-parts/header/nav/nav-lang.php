<?php
/**
 * Name file: nav-lang
 * Description: Display languages navigation (switcher)
 * Important: this navigation is fix
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>


<div class="languages">
    <?php
    /**
     * [navigation languages]
     */
    wp_nav_menu(array(
        'theme_location' => 'top',
        'depth'          => 2,
        'container'      => false,
        'menu_class'     => 'nav-lang'
    ));
    ?>
</div>
