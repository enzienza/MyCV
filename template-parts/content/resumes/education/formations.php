<?php
/**
 * Name file: formation
 * Description: show all CPT_formation of resume section
 * important :
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>



<div class="timeline"></div>

<div class="no-result">
    <?php if(checked(1, get_option('resume_empji_loop'), false)) : ?>
        <p class="display-1">&#128549;</p>
    <?php endif; ?>

    <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
        <p class="no-result-msg">
            <?php echo get_option('resume_loop2_fr'); ?>
        </p>
    <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
        <p class="no-result-msg">
            <?php echo get_option('resume_loop2_en'); ?>
        </p>
    <?php elseif(get_locale() === 'it_IT') : // Partie EN =========== ?>
        <p class="no-result-msg">
            <?php echo get_option('resume_loop2_it'); ?>
        </p>
    <?php endif; ?>
</div>
