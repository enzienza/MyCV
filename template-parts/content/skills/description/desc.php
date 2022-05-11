<?php
/**
 * Name file: desc
 * Description: show desciption on skill section
 * important : use hooks get_locale()
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
    <?php require_once ('fr-desc.php');?>
<?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
    <?php require_once ('en-desc.php');?>
<?php elseif(get_locale() === 'it_IT') : // Partie EN =========== ?>
    <?php require_once ('it-desc.php');?>
<?php endif; ?>