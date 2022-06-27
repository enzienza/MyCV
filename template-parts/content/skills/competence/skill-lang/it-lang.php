<?php
/**
 * Name file: it-lang
 * Description: display the block for italian language
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>


<?php if(checked(1, get_option('italian_level'), false)) : ?>
<div class="language-item bg-conic-16">
<?php elseif(checked(2, get_option('italian_level'), false)) : ?>
<div class="language-item bg-conic-33">
<?php elseif(checked(3, get_option('italian_level'), false)) : ?>
<div class="language-item bg-conic-49">
<?php elseif(checked(4, get_option('italian_level'), false)) : ?>
<div class="language-item bg-conic-66">
<?php elseif(checked(5, get_option('italian_level'), false)) : ?>
<div class="language-item bg-conic-82">
<?php elseif(checked(6, get_option('italian_level'), false)) : ?>
<div class="language-item bg-conic-99">
<?php endif; ?>
    <div class="language-content">
        <span class="language-name"><?php _e("Italien", "MyCV"); ?></span>
        <?php if(checked(1, get_option('italian_level'), false)) : ?>
            <span class="language-level">A1</span>
        <?php elseif(checked(2, get_option('italian_level'), false)) : ?>
            <span class="language-level">A2</span>
        <?php elseif(checked(3, get_option('italian_level'), false)) : ?>
            <span class="language-level">B1</span>
        <?php elseif(checked(4, get_option('italian_level'), false)) : ?>
            <span class="language-level">B2</span>
        <?php elseif(checked(5, get_option('italian_level'), false)) : ?>
            <span class="language-level">C1</span>
        <?php elseif(checked(6, get_option('italian_level'), false)) : ?>
            <span class="language-level">C2</span>
        <?php endif; ?>
        <?php if(checked(1, get_option('italian_isnative'), false)): ?>
            <span class="language-is-native"><?php _e("Langue maternelle", "MyCV"); ?></span>
        <?php endif; ?>
    </div>
</div>
