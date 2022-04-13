<?php
/**
 * Name file: home
 * Description:
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>

<section id="home" class="container">

    <h3>Hello, My name is</h3>
    <h1>
        <?php echo get_option('mylastname'); ?> <?php echo get_option('myfirstname'); ?>
    </h1>
    <h2>I'm a front-end developper junior</h2>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aspernatur consectetur eveniet fuga fugit ipsa,
        labore laudantium natus nemo obcaecati perspiciatis quasi quibusdam quis,
        reprehenderit similique voluptate voluptates? Dolor, esse.
    </p>
    <div>
        <a href="#about" class="btn">
            About me
            <i class="icons flaticon-user"></i>
        </a>
        <a href="#" class="btn">
            Download CV
            <i class="icons flaticon-download"></i>
        </a>
    </div>

</section>