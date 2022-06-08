<?php
/**
 * Name file: experience
 * Description: show all CPT_formation of education section
 * important :
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>



<div class="timeline"></div>

<div class="no-result">
    <p class="display-1">&#128549;</p>
    <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
        <p class="no-result-msg">
            <?php echo get_option('education_else_msg_fr'); ?>
        </p>
    <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
        <p class="no-result-msg">
            <?php echo get_option('education_else_msg_en'); ?>
        </p>
    <?php elseif(get_locale() === 'it_IT') : // Partie EN =========== ?>
        <p class="no-result-msg">
            <?php echo get_option('education_else_msg_it'); ?>
        </p>
    <?php endif; ?>
</div>
