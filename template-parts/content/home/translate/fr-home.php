<?php
/**
 * Name file: fr-home
 * Description:
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<?php if(checked(1, get_option('choose_salutation'), false)) : ?>
    <h3 class="uppercase font-light">
        <?php echo esc_attr(get_option('hero_salutation_fr')); ?>
    </h3>
    <h1 class="big-title">
        <span class="higt">
            <?php if(checked(1, get_option('hero_show_firstname'), false)): ?>
                <?php echo get_option('myfirstname'); ?>
            <?php endif; ?>

            <?php if(checked(1, get_option('hero_show_lastname'), false)): ?>
                <?php echo get_option('mylastname'); ?>
            <?php endif; ?>
        </span>
    </h1>

<?php elseif (checked(2, get_option('choose_salutation'), false)) : ?>

    <h3 class="uppercase font-light">
        <?php echo esc_attr(get_option('hero_msg_oneline_fr')); ?>
    </h3>
    <h1 class="big-title">
        <?php echo esc_attr(get_option('hero_msg_twoline_fr')); ?>
        <span class="higt">
            <?php if(checked(1, get_option('hero_show_firstname'), false)): ?>
                <?php echo get_option('myfirstname'); ?>
            <?php endif; ?>

            <?php if(checked(1, get_option('hero_show_lastname'), false)): ?>
                <?php echo get_option('mylastname'); ?>
            <?php endif; ?>
        </span>
    </h1>
<?php endif; ?>


<h2 class="font-light">
    <?php if(checked(1, get_option('hero_show_msg_fr'), false)) : ?>
        <?php echo get_option('hero_msg_job_fr'); ?>
    <?php endif; ?>

    <?php if(checked(1, get_option('hero_add_job'), false)): ?>
        <span class="hight-small">
                <?php echo get_option('title_job_fr')?>
        </span>
    <?php endif; ?>
</h2>

<?php if(checked(1, get_option('hero_about_fr'), false)): ?>
    <p class="desc font-thin">
        <?php echo get_option('talk_short_aboutme_fr') ?>
    </p>
<?php endif; ?>


<div class="group-btn">
    <?php if(checked(1, get_option('hero_add_btn_about'), false)) : ?>
        <a href="#about" class="btn btn-simple">
            <?php if(checked(1, get_option('hero_show_icon_about'), false)) : ?>
                <i class="icons flaticon-user"></i>
            <?php endif; ?>
            <?php _e("?? propos", "MyCV"); ?>
        </a>
    <?php endif; ?>

    <?php if(checked(1, get_option('hero_add_btn_download'), false)) : ?>
        <a href="<?php echo get_option('import_cv_fr'); ?>" class="btn btn-simple" target="_blank">
            <?php if(checked(1, get_option('hero_show_icon_download'), false)) : ?>
                <i class="icons flaticon-download"></i>
            <?php endif; ?>
            <?php _e("T??l??charger CV", "MyCV"); ?>
        </a>
    <?php endif; ?>

    <?php if(checked(1, get_option('hero_add_btn_contact'), false)) : ?>
        <a href="#contact" class="btn btn-simple">
            <?php if(checked(1, get_option('hero_show_icon_contact'), false)) : ?>
                <i class="icons flaticon-email"></i>
            <?php endif; ?>
            <?php _e("Contactez moi", "MyCV"); ?>
        </a>
    <?php endif; ?>

</div>