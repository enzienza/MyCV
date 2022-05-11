<?php
/**
 * Name file: title
 * Description: show the main title of skill section
 * important : use hooks get_locale()
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
    <?php require_once('fr-title.php');?>
<?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
    <?php require_once ('en-title.php');?>
<?php elseif(get_locale() === 'it_IT') : // Partie EN =========== ?>
    <?php require_once ('it-title.php');?>
<?php endif; ?>
