<?php
/**
 * Name file: education
 * Description: display education section
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<section id="educations" class="my-container">
    <div class="title-section">
        <?php require_once("title/title.php"); ?>
    </div>

    <?php if(checked(1, get_option('education_show_desc'), false)) : ?>
        <div class="desc-section">
            <?php require_once("description/desc.php"); ?>
        </div>
    <?php endif; ?>

    <div class="formation">
        <?php require_once("formations/formations.php"); ?>
        <?php //get_template_part('template-parts/') ?>
    </div>
</section>
