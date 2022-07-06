<?php
/**
 * Template Name: default
 *
 * Description: The page template to display all pages
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>


<?php get_header(); ?>
    <section class="my-container">
        <?php if(have_posts()) : while(have_posts()) : the_post();?>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>
    </section>
<?php get_footer(); ?>