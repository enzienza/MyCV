<?php
/**
 * Name file: about
 * Description:
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<section id="about" class="container">
    <h1>About me</h1>

    <div class="row">
        <div class="col-lg-6 col-12">
            <ul>
                <li>
                    <span>Name : </span>
                    <?php echo get_option('mylastname'); ?> <?php echo get_option('myfirstname'); ?>
                </li>
                <li>
                    <span>Age : </span>
                    37
                </li>
                <li>
                    <span>Country : </span>
                    Liège (Belgium)
                </li>
            </ul>

            <a href="#" class="btn">
                Download CV
                <i class="icons flaticon-download"></i>
            </a>
        </div>
        <div class="col-lg-6 col-12">
            <img src=""
                 alt="<?php echo get_option('mylastname'); ?> <?php echo get_option('myfirstname'); ?>"
                 class=""
            />
        </div>
    </div>
</section>
