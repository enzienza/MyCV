<?php
/**
 * Name file: index
 * Description: The main template file
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>


<?php get_header() ?>
    <main>
        <?php get_template_part('template-parts/components/switch-theme') ?>
        <h1>this is main page</h1>
    </main>
<?php get_footer() ?>