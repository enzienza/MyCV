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
        <h1>this is title 1</h1>
        <h2>this is title 2</h2>
        <h3>this is title 3</h3>
    </main>
<?php get_footer() ?>