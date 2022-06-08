<?php
/**
 * Name file: resumes
 * Description: display resumes section
 * Important: navigation tabs between experiences and formations
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<section id="resumes" class="my-container">
    <div class="title-section">
        <?php require_once("title/title.php"); ?>
    </div>

    <?php if(checked(1, get_option('resume_show_desc'), false)) : ?>
        <div class="desc-section">
            <?php require_once("description/desc.php"); ?>
        </div>
    <?php endif; ?>

    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a
                    class="nav-link active"
                    id="tab-experience"
                    data-toggle="tab"
                    href="#experience"
                    role="tab"
                    aria-controls="experience"
                    aria-selected="true"
                >
                    <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
                        <p><?php echo esc_attr(get_option('resume_tab_one_fr')); ?></p>
                    <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
                        <p><?php echo esc_attr(get_option('resume_tab_one_en')); ?></p>
                    <?php elseif(get_locale() === 'it_IT') : // Partie EN =========== ?>
                        <p><?php echo esc_attr(get_option('resume_tab_one_it')); ?></p>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link"
                    id="tab-formation"
                    data-toggle="tab"
                    href="#formation"
                    role="tab"
                    aria-controls="formation"
                    aria-selected="true"
                >
                    <?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
                        <p><?php echo esc_attr(get_option('resume_tab_two_fr')); ?></p>
                    <?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
                        <p><?php echo esc_attr(get_option('resume_tab_two_en')); ?></p>
                    <?php elseif(get_locale() === 'it_IT') : // Partie EN =========== ?>
                        <p><?php echo esc_attr(get_option('resume_tab_two_it')); ?></p>
                    <?php endif; ?>
                </a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div
                class="tab-pane fade show active"
                id="experience"
                role="tabpanel"
                aria-labelledby="tab-experience"
            >
                <?php require_once("work/experience.php"); ?>
            </div>
            <div
                class="tab-pane fade"
                id="formation"
                role="tabpanel"
                aria-labelledby="tab-formation"
            >
                <?php require_once("education/formations.php"); ?>
            </div>
        </div>
    </div>

</section>
