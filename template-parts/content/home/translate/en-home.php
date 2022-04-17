<?php
/**
 * Name file: en-home
 * Description:
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<h3><?php echo esc_attr(get_option('hero_salutation_fr')); ?></h3>
<h3><?php echo esc_attr(get_option('hero_salutation_en')); ?></h3>
<h1>
    <?php if(checked(1, get_option('hero_show_lastname'), false)): ?>
        <?php echo get_option('mylastname'); ?>
    <?php endif; ?>

    <?php if(checked(1, get_option('hero_show_firstname'), false)): ?>
        <?php echo get_option('myfirstname'); ?>
    <?php endif; ?>
</h1>

<h2>
    <?php echo get_option('hero_msg_job_en'); ?>
    <?php if(checked(1, get_option('hero_job_en'), false)): ?>
        <?php echo get_option('title_job_en')?>
    <?php endif; ?>

</h2>

<p>
    <?php if(checked(1, get_option('hero_show_msg_en'), false)): ?>
        <?php echo get_option('talk_aboutme_en', "MyCV") ?>
    <?php endif; ?>
</p>


<div>
    <?php if(checked(1, get_option('hero_add_btn_about'), false)) : ?>
        <a href="#about" class="btn">
            <?php if(checked(1, get_option('hero_show_icon_about'), false)) : ?>
                <i class="icons flaticon-user"></i>
            <?php endif; ?>
            <?php _e("À propos", "MyCV"); ?>
        </a>
    <?php endif; ?>

    <?php if(checked(1, get_option('hero_add_btn_download'), false)) : ?>
        <a href="<?php echo get_option('import_cv_en'); ?>" class="btn" target="_blank">
            <?php if(checked(1, get_option('hero_show_icon_download'), false)) : ?>
                <i class="icons flaticon-download"></i>
            <?php endif; ?>
            <?php _e("Télécharger mon CV", "MyCV"); ?>
        </a>
    <?php endif; ?>

    <?php if(checked(1, get_option('hero_add_btn_contact'), false)) : ?>
        <a href="#contact" class="btn">
            <?php if(checked(1, get_option('hero_show_icon_contact'), false)) : ?>
                <i class="icons flaticon-email"></i>
            <?php endif; ?>
            <?php _e("Contactez moi", "MyCV"); ?>
        </a>
    <?php endif; ?>

</div>