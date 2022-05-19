<?php
/**
 * Name file: en-error
 * Description: display this part if get_locale() is same as 'en_GB'
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<div class="error container">
    <div class="error-code">
        404
    </div><!--//error-code-->

    <h1 class="text-hightlight">
        <?php echo get_option('maintext_error_en'); ?>
    </h1><!--//text-hightlight-->

    <div class="error-desc">
        <p>
            <?php echo get_option('message_error_en'); ?>
        </p>

        <?php if(checked(1, get_option('errorpage_btn_homepage'), false)) : ?>
            <div>
                <a href="<?php echo esc_url( site_url( '/en' ) ); ?>">
                    <?php _e("Retour à la page d'accueil", "MyCV"); ?>
                </a>
            </div>
        <?php endif; ?>
    </div><!--//error-desc-->
</div><!--//error-->
