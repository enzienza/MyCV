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
<!--    <main>-->
        <?php get_template_part('template-parts/components/switch-theme') ?>

        <?php get_template_part('template-parts/content/01-home') ?>
        <?php get_template_part('template-parts/content/02-about') ?>
        <?php get_template_part('template-parts/content/03-resumes') ?>
        <?php get_template_part('template-parts/content/04-formations') ?>
        <?php get_template_part('template-parts/content/05-skills') ?>
        <?php get_template_part('template-parts/content/06-contact') ?>
<!--    </main>-->
<?php get_footer() ?>