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
        <section id="about" style="height: 80vh; background: #4ad295"><div class="title"><h1>A propos</h1></div></section>
        <section id="resumes" style="height: 80vh; background: #8f4ec7"><div class="title"><h1>Experience</h1></div></section>
        <section id="formations" style="height: 80vh; background: aquamarine"><div class="title"><h1>Formation</h1></div></section>
        <section id="contact" style="height: 80vh; background: burlywood">
            <h1>this is title 1</h1>
            <h2>this is title 2</h2>
            <h3>this is title 3</h3>
        </section>
<!--    </main>-->
<?php get_footer() ?>