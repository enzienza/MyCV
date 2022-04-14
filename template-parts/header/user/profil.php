<?php
/**
 * Name file: profile
 * Description:
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<div class="sidebar-head">

    <?php if(checked(1, get_option('sidebar_display_picture'), false)): ?>

        <?php if(checked(1, get_option('sidebar_choose_picture'), false)): ?>
            <img src="<?php echo esc_attr(get_option('myavatar')) ?>"
                 alt="<?php echo esc_attr(get_option('mylastname')); ?> <?php echo esc_attr(get_option('myfirstname')); ?>"
                 class="profil rounded-full"
            />
        <?php endif; ?>

        <?php if(checked(2, get_option('sidebar_choose_picture'), false)): ?>
            <img src="<?php echo esc_attr(get_option('myprofil')) ?>"
                     alt="<?php echo esc_attr(get_option('mylastname')); ?> <?php echo esc_attr(get_option('myfirstname')); ?>"
                     class="profil rounded-full"
                />
        <?php endif; ?>

        <?php if(checked(3, get_option('sidebar_choose_picture'), false)): ?>
            <img src="<?php echo esc_attr(get_option('mylogo')) ?>"
                 alt="<?php echo esc_attr(get_option('mylastname')); ?> <?php echo esc_attr(get_option('myfirstname')); ?>"
                 class="profil rounded-full invert"
            />
        <?php endif; ?>

    <?php endif; ?>

    <h1 class="name font-bold tracking-4">
        <?php if(checked(1, get_option('sidebar_display_lastname'), false)): ?>
            <?php echo esc_attr(get_option('mylastname')); ?>
        <?php endif; ?>
        <?php if(checked(1, get_option('sidebar_display_firstname'), false)): ?>
            <?php echo esc_attr(get_option('myfirstname')); ?>
        <?php endif; ?>
    </h1>
    <?php if(checked(1, get_option('sidebar_display_job'), false)): ?>
        <p class="font-thin tracking-3">
            <?php if (get_locale() === 'fr_FR') : ?>
                <?php echo esc_attr(get_option('title_job_fr')) ?>
            <?php elseif(get_locale() === 'en_GB') : ?>
                <?php echo esc_attr(get_option('title_job_en')) ?>
            <?php elseif(get_locale() === 'it_IT') : ?>
                <?php echo esc_attr(get_option('title_job_it')) ?>
            <?php endif; ?>
        </p>
    <?php endif; ?>
</div>