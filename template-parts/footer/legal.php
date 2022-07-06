<?php
/**
 * Name file: legal
 * Description:
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<div id="legal">
    <ul class="legal-list">
        <?php if(checked(1, get_option('privacy_pocily'), false)) : ?>
            <li class="legal-item">
                <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
                    <a href="<?php echo esc_url(home_url().'/politique-de-confidentialite'); ?>">
                        <?php _e("Mentions légales", "MyCV") ?>
                    </a>
                <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
                    <a href="<?php echo esc_url(home_url().'/privacy-policy'); ?>">
                        <?php _e("Mentions légales", "MyCV") ?>
                    </a>
                <?php elseif(get_locale() === 'it_IT') : // Partie IT =========== ?>
                    <a href="<?php echo esc_url(home_url().'/politica-sulla-privacy'); ?>">
                        <?php _e("Mentions légales", "MyCV") ?>
                    </a>
                <?php endif; ?>

            </li>
        <?php endif; ?>

        <?php if(checked(1, get_option('cookie_pocily'), false)) : ?>
            <li class="legal-item">
                <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
                    <a href="<?php echo esc_url(home_url().'/politique-en-matiere-de-cookies'); ?>">
                        <?php _e("Cookies", "MyCV") ?>
                    </a>
                <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
                    <a href="<?php echo esc_url(home_url().'/cookie-policy'); ?>">
                        <?php _e("Cookies", "MyCV") ?>
                    </a>
                <?php elseif(get_locale() === 'it_IT') : // Partie IT =========== ?>
                    <a href="<?php echo esc_url(home_url().'/politica-sui-cookie'); ?>">
                        <?php _e("Cookies", "MyCV") ?>
                    </a>
                <?php endif; ?>
            </li>
        <?php endif; ?>
    </ul>
</div>
