<?php
/**
 * Name file: languages
 * Description: show languages level in skill section
 * important :
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>


<div class="skill-group scroll fadeInUp">
    <h2 class="skill-title"><?php _e("Langues", "MyCV") ?></h2>
    <div class="language-grid">
        <div class="language-wrapper">
            <?php require_once('skill-lang/fr-lang.php');?>
        </div>
        <div class="language-wrapper">
            <?php require_once('skill-lang/en-lang.php');?>
        </div>
        <div class="language-wrapper">
            <?php require_once('skill-lang/it-lang.php');?>
        </div>
    </div>
</div>
