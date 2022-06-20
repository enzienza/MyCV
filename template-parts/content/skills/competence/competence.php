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

<?php
    wp_reset_postdata();

    $args = array(
        'post_type'      => 'competences',
        'posts_per_page' => -1,
        'orderby'        => 'id',
        'order'          => 'DESC'
    );
    $my_query = new WP_query($args);
    if($my_query->have_posts()) : while($my_query->have_posts()) : $my_query->the_post();
?>
    <div>
        <?php the_title(); ?>

        <?php
            $list_skill = get_post_meta($post->ID, 'list_skill', true);
            foreach ($list_skill as $field) :
        ?>
            <?php echo $field['name']; ?>
            <?php echo $field['percent']; ?>
        <?php endforeach; ?>
    </div>

<?php endwhile; else: ?>
    <div class="no-result">

        <p class="display-1">&#128549;</p>

        <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
            <p class="no-result-msg"><?php echo get_option('skill_else_msg_fr'); ?></p>
        <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
            <p class="no-result-msg"><?php echo get_option('skill_else_msg_en'); ?></p>
        <?php elseif(get_locale() === 'it_IT') : // Partie EN =========== ?>
            <p class="no-result-msg"><?php echo get_option('skill_else_msg_it'); ?></p>
        <?php endif; ?>
    </div>
<?php endif;  wp_reset_postdata(); ?>