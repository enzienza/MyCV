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
    <div class="desc-section">
        <?php require_once("description/desc.php"); ?>
    </div>
    <div class="timeline">
        <?php require_once("timeline/experience.php"); ?>
        <?php //get_template_part('template-parts/') ?>
    </div>
</section>
