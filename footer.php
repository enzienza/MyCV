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
    <small class="copyright">
        Copyright © <?php bloginfo('name'); ?> 2022 |
        Designed by © <a href="http://enzalombardo.be/" target="_blank">Enza Lombardo</a>
    </small>
</footer>
<?php wp_footer(); ?>

</body>
</html>