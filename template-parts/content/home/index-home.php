<?php
/**
 * Name file: home
 * Description: display home section
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<section id="home" class="hero-wrap" <?php if(checked(1, get_option('add_bg_hero'), false)): ?>style="background-image: url(<?php echo get_option('bg_hero') ?>)"<?php endif;?> >
<!--    <div class="overlay"></div>-->
    <div class="jumb-content">
        <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
            <?php //get_template_part('template-parts/content/home/translate/fr-home') ?>
            <?php require_once ('translate/fr-home.php');?>
        <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
            <?php //get_template_part('template-parts/content/home/translate/en-home') ?>
            <?php require_once ('translate/en-home.php');?>
        <?php elseif(get_locale() === 'it_IT') : // Partie EN =========== ?>
            <?php //get_template_part('template-parts/content/home/translate/it-home') ?>
            <?php require_once ('translate/it-home.php');?>
        <?php endif; ?>
    </div>
</section>