<?php
/**
 * Name file: contact
 * Description:
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<section id="contact" class="my-container">
    <section id="educations" class="my-container">
        <div class="title-section">
            <?php require_once("title/title.php"); ?>
        </div>

        <?php if(checked(1, get_option('contact_show_desc'), false)) : ?>
            <div class="desc-section">
                <?php require_once("description/desc.php"); ?>
            </div>
        <?php endif; ?>

        <div class="content"></div>

        <?php if(checked(1, get_option('contact_show_network'), false)) : ?>
            <div class="desc-section">
                <?php require_once("social/network.php"); ?>
            </div>
        <?php endif; ?>
    </section>
</section>
