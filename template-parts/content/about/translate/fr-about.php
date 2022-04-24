<?php
/**
 * Name file: fr-about
 * Description: display this part if get_locale() is same as 'fr_FR'
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>
<ul>
    <?php if(checked(1, get_option('about_show_fullname'), false)) : ?>
        <li>
            <span><?php _e('Nom', "MyCV");?> : </span>
            <?php echo get_option('mylastname'); ?> <?php echo get_option('myfirstname'); ?>
        </li>
    <?php endif; ?>

    <?php if(checked(1, get_option('about_show_age'), false)) : ?>
        <li>
            <span><?php _e('Age', "MyCV"); ?> : </span>
            <?php
            $dateOfBirth = new DateTime(get_option('myBirthday'));
            $myAge = $dateOfBirth -> diff(new DateTime);
            echo $myAge -> y;
            ?>
        </li>
    <?php endif; ?>


    <?php if(checked(1, get_option('about_show_country'), false)) : ?>
        <li>
            <span><?php _e('Localité', "MyCV"); ?> : </span>
            <?php echo get_option('mylocation'); ?>
        </li>
    <?php endif; ?>

    <?php if(checked(1, get_option('about_show_job'), false)) : ?>
        <li>
            <span><?php _e('Poste', "MyCV"); ?> : </span>
            <?php echo get_option('title_job_fr'); ?>
        </li>
    <?php endif; ?>

</ul>
<div class="group-btn">
    <?php if(checked(1, get_option('about_add_btn_download'), false)): ?>
        <a href="<?php echo get_option('import_cv_fr') ?>" class="btn btn-simple" target="_blank">
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