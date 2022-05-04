<?php
/**
 * Name file: fr-btn
 * Description: display this part if get_locale() is same as 'it_IT'
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<div class="group-btn">
    <?php if(checked(1, get_option('about_add_btn_download'), false)): ?>
        <a href="<?php echo get_option('import_cv_it') ?>" class="btn btn-simple" target="_blank">
            <?php if(checked(1, get_option('about_show_icon_download'), false)): ?>
                <i class="icons flaticon-download"></i>
            <?php endif; ?>
            <?php _e('Télécharger CV', 'MyCV') ?>
        </a>
    <?php endif; ?>

    <?php if(checked(1, get_option('about_add_btn_portfolio'), false)): ?>
        <a href="<?php echo get_option('mysiteweb')?>" class="btn btn-simple" target="_blank">
            <?php if(checked(1, get_option('about_show_icon_portfolio'), false)): ?>
                <i class="icons flaticon-worldwide"></i>
            <?php endif; ?>
            <?php _e('Mon portfolio', 'MyCV') ?>
        </a>
    <?php endif; ?>

    <?php if(checked(1, get_option('about_add_btn_contact'), false)): ?>
        <a href="#contact" class="btn btn-simple">
            <?php if(checked(1, get_option('about_show_icon_contact'), false)): ?>
                <i class="icons flaticon-email"></i>
            <?php endif; ?>
            <?php _e('Contactez moi', 'MyCV') ?>
        </a>
    <?php endif; ?>
</div>