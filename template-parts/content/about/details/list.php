<?php
/**
 * Name file:
 * Description: show list for personal detail on about section
 * important : use hooks get_locale()
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
    <?php require_once ('fr-list.php');?>
<?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
    <?php require_once ('en-list.php');?>
<?php elseif(get_locale() === 'it_IT') : // Partie EN =========== ?>
    <?php require_once ('it-list.php');?>
<?php endif; ?>
