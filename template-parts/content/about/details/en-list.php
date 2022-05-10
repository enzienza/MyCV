<?php
/**
 * Name file: fr-list
 * Description: display this part if get_locale() is same as 'en_GB'
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<div class="about-detail">
    <h3><?php _e("Détails personnels", "MyCV"); ?></h3>
    <ul>
        <?php if(checked(1, get_option('about_show_fullname'), false)) : ?>
            <li>
                <span class="detail-title"><?php _e('Nom', "MyCV");?></span>
                <span class="detail-separater"></span>
                <?php echo get_option('mylastname'); ?> <?php echo get_option('myfirstname'); ?>
            </li>
        <?php endif; ?>

        <?php if(checked(1, get_option('about_show_age'), false)) : ?>
            <li>
                <span class="detail-title"><?php _e('Âge', "MyCV"); ?></span>
                <span class="detail-separater"></span>
                <?php
                $dateOfBirth = new DateTime(get_option('myBirthday'));
                $myAge = $dateOfBirth -> diff(new DateTime);
                echo $myAge -> y;
                ?>
            </li>
        <?php endif; ?>


        <?php if(checked(1, get_option('about_show_country'), false)) : ?>
            <li>
                <span class="detail-title"><?php _e('Localité', "MyCV"); ?></span>
                <span class="detail-separater"></span>
                <?php echo get_option('mylocation'); ?> (<?php echo get_option('mycountry')?>)
            </li>
        <?php endif; ?>

        <?php if(checked(1, get_option('about_show_job'), false)) : ?>
            <li>
                <span class="detail-title"><?php _e('Poste', "MyCV"); ?></span>
                <span class="detail-separater"></span>
                <?php echo get_option('title_job_en'); ?>
            </li>
        <?php endif; ?>

    </ul>
</div>
