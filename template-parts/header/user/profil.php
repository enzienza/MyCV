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

<div class="profil">

    <img src="<?php echo esc_attr(get_option('myprofil')) ?>"
         alt="<?php echo esc_attr(get_option('mylastname')); ?> <?php echo esc_attr(get_option('myfirstname')); ?>"
         class=" rounded-full"
    />

    <h1 class="name">
        <?php echo esc_attr(get_option('mylastname')); ?>
        <?php echo esc_attr(get_option('myfirstname')); ?>
    </h1>
    <p>
        <?php echo esc_attr(get_option('title_job_fr')) ?>
    </p>
</div>