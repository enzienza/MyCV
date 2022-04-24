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
<section id="about" class="">
    <div class="title">
        <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
            <h1><?php echo get_option('about_title_fr') ?></h1>
        <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
            <h1><?php echo get_option('about_title_en') ?></h1>
        <?php elseif(get_locale() === 'it_IT') : // Partie EN =========== ?>
            <h1><?php echo get_option('about_title_it') ?></h1>
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
                    <?php require_once ('translate/fr-about.php');?>
                <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
                    <?php //require_once ('translate/en-about.php');?>
                <?php elseif(get_locale() === 'it_IT') : // Partie EN =========== ?>
                    <?php //require_once ('translate/it-about.php');?>
                <?php endif; ?>
            </div>
            <div class="col-lg-4 col-12">
                <?php if(checked(1, get_option('about_show_picture'), false)) : ?>
                    <img src="<?php echo get_option('myavatar') ?>"
                         alt="<?php echo get_option('mylastname'); ?> <?php echo get_option('myfirstname'); ?>"
                         class=""
                    />
                <?php elseif(checked(2, get_option('about_show_picture'), false)) : ?>
                    <img src="<?php echo get_option('myprofil') ?>"
                         alt="<?php echo get_option('mylastname'); ?> <?php echo get_option('myfirstname'); ?>"
                         class=""
                    />
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
