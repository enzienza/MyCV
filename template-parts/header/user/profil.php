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

    <img src="<?php echo esc_attr(get_option('myprofil')) ?>"
         alt="<?php echo esc_attr(get_option('mylastname')); ?> <?php echo esc_attr(get_option('myfirstname')); ?>"
         class="profil rounded-full"
    />

    <h1 class="name font-bold tracking-4">
        <?php echo esc_attr(get_option('mylastname')); ?>
        <?php echo esc_attr(get_option('myfirstname')); ?>
    </h1>
    <p class="font-thin tracking-3">
        <?php echo esc_attr(get_option('title_job_fr')) ?>
    </p>
</div>