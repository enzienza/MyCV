<?php
/**
 * Name file: about
 * Description: display about section
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>
<section id="about" class="my-container">
    <div class="title-section">
        <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
            <h1><?php echo get_option('about_title_fr') ?></h1>
        <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
            <h1><?php echo get_option('about_title_en') ?></h1>
        <?php elseif(get_locale() === 'it_IT') : // Partie EN =========== ?>
            <h1><?php echo get_option('about_title_it') ?></h1>
        <?php endif; ?>
    </div>
    <div class="grid grid-cols-2 about-grid">
        <div class="about-content">
            <?php
            /**
             * get_option => about_design_section
             * 1 => description (index add hooks get_locale)
             * 2 => list personal details (index add hooks get_locale)
             * 3 => description + list personal details
             */
            ?>
            <?php if(checked(1, get_option('about_design_section'), false)) : ?>
                <?php require_once("description/desc.php"); ?>
            <?php elseif (checked(2, get_option('about_design_section'), false)) : ?>
                <?php require_once("details/list.php"); ?>
            <?php elseif (checked(3, get_option('about_design_section'), false)) : ?>
                <?php require_once("description/desc.php"); ?>
                <?php require_once("details/list.php"); ?>
            <?php endif; ?>
            <?php require_once("button/button.php"); ?>
        </div>
        <div class="about-image">
            <?php if(checked(1, get_option('about_show_picture'), false)) : ?>
                <img src="<?php echo get_option('myavatar') ?>"
                     alt="<?php echo get_option('mylastname'); ?> <?php echo get_option('myfirstname'); ?>"
                     class="morph"
                />
            <?php elseif(checked(2, get_option('about_show_picture'), false)) : ?>
                <img src="<?php echo get_option('myprofil') ?>"
                     alt="<?php echo get_option('mylastname'); ?> <?php echo get_option('myfirstname'); ?>"
                     class="morph"
                />
            <?php endif; ?>
        </div>
    </div>
</section>
