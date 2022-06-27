<?php
/**
 * Name file: skill
 * Description: display skill section
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<section id="skills" class="my-container">
    <div class="title-section">
        <?php require_once("title/title.php"); ?>
    </div>

    <?php if(checked(1, get_option('skill_show_desc'), false)) : ?>
        <div class="desc-section">
            <?php require_once("description/desc.php"); ?>
        </div>
    <?php endif; ?>

    <div class="skill-content">
        <?php require_once("competence/competence.php"); ?>
        <?php require_once("competence/languages.php"); ?>
        <?php //get_template_part('template-parts/') ?>
    </div>
</section>
