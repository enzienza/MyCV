<?php
/**
 * Name file: formation
 * Description: show all CPT_formation of resume section
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
        'post_type'      => 'formations',
        'posts_per_page' => -1,
        'orderby'        => 'id',
        'order'          => 'DESC'
    );
    $my_query = new WP_query($args);
    if($my_query->have_posts()) : while($my_query->have_posts()) : $my_query->the_post();
?>
    <div class="timeline">
        <div class="timeline-card shadow">
            <div class="timeline-item">
                <div class="timeline-date">
                <span>
                    <?php echo get_post_meta(get_the_ID(), 'year', true); ?>
                </span>
                </div>
                <div class="timeline-content">
                    <div class="timeline-title">
                        <h2><?php the_title(); ?></h2>
                        <h3><?php echo get_post_meta(get_the_ID(), 'name_company', true); ?></h3>
                    </div>
                </div>
                <?php if(checked(1, get_post_meta(get_the_ID(), 'view_details', true), false)) : ?>
                    <a class="detail-link collapsed"
                       href="#detail-<?php echo the_ID() ?>"
                       type="button"
                       data-toggle="collapse"
                       data-target="#detail-<?php echo the_ID() ?>"
                       aria-expanded="false"
                       aria-controls="detail-<?php echo the_ID() ?>"
                    >
                    </a>
                <?php endif; ?>
            </div>

            <?php if(checked(1, get_post_meta(get_the_ID(), 'view_details', true), false)) : ?>
                <div class="timeline-collapse collapse" id="detail-<?php echo the_ID() ?>">
                    <div class="collapse-card">
                        <!--<div class="collapse-title">-->
                            <!--<h4><?php //_e("Mes tâches", "MyCV"); ?></h4>-->
                        <!--</div>-->
                        <div class="collapse-body">
                            <?php the_content(); ?>
                        </div>
                        <!--<div class="collapse-footer">-->
                        <!--<?php //echo get_post_meta(get_the_ID(), 'locality_company', true); ?>-->
                        <!--(--><?php //echo get_post_meta(get_the_ID(), 'country_company', true); ?><!--)-->
                        <!--</div>-->
                    </div>
                </div>
            <?php endif; ?>
        </div>


    </div>
<?php endwhile; else: ?>
    <div class="no-result">
        <?php if(checked(1, get_option('resume_empji_loop'), false)) : ?>
            <p class="display-1">&#128549;</p>
        <?php endif; ?>

        <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
            <p class="no-result-msg">
                <?php echo get_option('resume_loop2_fr'); ?>
            </p>
        <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
            <p class="no-result-msg">
                <?php echo get_option('resume_loop2_en'); ?>
            </p>
        <?php elseif(get_locale() === 'it_IT') : // Partie EN =========== ?>
            <p class="no-result-msg">
                <?php echo get_option('resume_loop2_it'); ?>
            </p>
        <?php endif; ?>
    </div>
<?php endif;  wp_reset_postdata(); ?>