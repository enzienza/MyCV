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

        <?php if(checked(1, get_option('hero_hidden_section'), false)): else : ?>
            <?php //get_template_part('template-parts/content/home/home') ?>
            <?php get_template_part('template-parts/content/home/index', 'home') ?>
        <?php endif;?>

        <?php if(checked(1, get_option('about_hidden_section'), false)) : else : ?>
            <?php get_template_part('template-parts/content/about/index', 'about') ?>
        <?php endif; ?>

        <?php get_template_part('template-parts/content/03-resumes') ?>
        <?php get_template_part('template-parts/content/04-formations') ?>
        <?php get_template_part('template-parts/content/05-skills') ?>
        <?php get_template_part('template-parts/content/06-contact') ?>
<!--    </main>-->
<?php get_footer() ?>