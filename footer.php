<?php
/**
 * Name file: footer
 * Description: The template for displaying the footer
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>


<?php get_template_part('template-parts/components/scrollTop') ?>

<footer class="footer">
    <small class="">
        <?php if(checked(1, get_option('type_footer'), false)) : ?>
            <?php get_template_part('template-parts/footer/copyright') ?>
        <?php elseif(checked(2, get_option('type_footer'), false)) : ?>
            <div class="my-container flex-between">
                <?php get_template_part('template-parts/footer/copyright') ?>
                <?php get_template_part('template-parts/footer/legal') ?>
            </div>
        <?php endif; ?>
    </small>
</footer>
<?php wp_footer(); ?>

</body>
</html>