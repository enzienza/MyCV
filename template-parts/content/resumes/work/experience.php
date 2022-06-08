<?php
/**
 * Name file: experience
 * Description: show all CPT_experience of resume section
 * important :
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<!--  if loop -> ok  [Post-type  => 'experiences']  -->

<?php
    wp_reset_postdata();

    $args = array(
        'post_type'      => 'experiences',
        'posts_per_page' => -1,
        'orderby'        => 'id',
        'order'          => 'DESC'
    );
    $my_query = new WP_query($args);
    if($my_query->have_posts()) : while($my_query->have_posts()) : $my_query->the_post();
?>
<div class="timeline-card shadow">
    <div class="timeline-item">
        <div class="timeline-date">
            <span>
                <?php echo get_post_meta(get_the_ID(), 'year', true); ?>
                <?php if(checked(1, get_post_meta(get_the_ID(), 'current_experience', true), false)) : ?>
                    <?php _e("à aujourd'hui", "MyCV") ?>
                <?php endif; ?>
            </span>
        </div>
        <div class="timeline-content">
            <div class="timeline-title">
                <h2><?php the_title(); ?></h2>
                <h3><?php echo get_post_meta(get_the_ID(), 'name_company', true); ?></h3>
                <?php if(checked(1, get_post_meta(get_the_ID(), 'is_internship', true), false)) : ?>
                    <p><?php _e("Stage", "MyCV") ?></p>
                <?php endif; ?>
            </div>
        </div>
        <a class="detail-link collapsed"
           href="#detail-<?php echo the_ID() ?>"
           type="button"
           data-toggle="collapse"
           data-target="#detail-<?php echo the_ID() ?>"
           aria-expanded="false"
           aria-controls="detail-<?php echo the_ID() ?>"
        >
        </a>
    </div>
    <div class="timeline-collapse collapse" id="detail-<?php echo the_ID() ?>">
        <div class="collapse-card">
            <div class="collapse-title">
                <h4><?php _e("Mes tâches", "MyCV"); ?></h4>
            </div>
            <div class="collapse-body">
                <?php the_content(); ?>
            </div>
            <div class="collapse-footer">
                <?php echo get_post_meta(get_the_ID(), 'locality_company', true); ?>
                (<?php echo get_post_meta(get_the_ID(), 'country_company', true); ?>)
            </div>
        </div>
    </div>
</div>


<?php endwhile; else: ?>
    <div class="no-result">
    <!--  PROVISOIR  -->
        <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
            <?php echo get_option('resume_else_msg_fr'); ?>
        <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
            <?php echo get_option('resume_else_msg_en'); ?>
        <?php elseif(get_locale() === 'it_IT') : // Partie EN =========== ?>
            <?php echo get_option('resume_else_msg_it'); ?>
        <?php endif; ?>
    </div>
<?php endif;  wp_reset_postdata(); ?>