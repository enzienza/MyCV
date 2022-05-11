<?php
/**
 * Name file: competence
 * Description: show all CPT_competence of skill section
 * important :
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<!--  if loop -> ok  [Post-type  => 'experiences']  -->

<!--  else  -->
<div class="no-result">
    <!--  PROVISOIR  -->
    <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
        <?php echo get_option('skill_else_msg_fr'); ?>
    <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
        <?php echo get_option('skill_else_msg_en'); ?>
    <?php elseif(get_locale() === 'it_IT') : // Partie EN =========== ?>
        <?php echo get_option('skill_else_msg_it'); ?>
    <?php endif; ?>
</div>
<!--  endif  -->
