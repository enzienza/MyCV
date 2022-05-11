<?php
/**
 * Name file: resumes
 * Description: display resumes section
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<section id="resumes" class="my-container">
    <div class="title-section">
        <?php require_once("title/title.php"); ?>
    </div>

    <?php if(checked(1, get_option('resume_show_desc'), false)) : ?>
        <div class="desc-section">
            <?php require_once("description/desc.php"); ?>
        </div>
    <?php endif; ?>

    <div class="timeline">
        <?php require_once("timeline/experience.php"); ?>
        <?php //get_template_part('template-parts/') ?>
    </div>
</section>
