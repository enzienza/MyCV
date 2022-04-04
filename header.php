<?php
/**
 * Name file: header
 * Description: Header file for the MyCV WordPress default theme.
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */
?>


<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <!-- ============= META ============= -->
    <meta <?php bloginfo('charset'); ?>>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- ============= INFORMATIONS  ============= -->
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="author" content="Enza Lombardo">

    <title><?php bloginfo('title'); ?></title>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>


<header class="sidebar">

    <!--  Nav-lang  -->
    <?php get_template_part('template-parts/header/nav/nav-lang'); ?>

    <!--  box-user  -->
    <?php get_template_part('template-parts/header/user/profil'); ?>

    <!--  Nav-principal  -->
    <?php get_template_part('template-parts/header/nav/nav-principal'); ?>

    <!--  Social-Network  -->
    <?php get_template_part('template-parts/header/social/social'); ?>

</header>

<!--  BTN-MOBILE  -->
<button class="btn-menu" id="btn-menu" type="button">
    <div class="icon-1" id="a"></div>
    <div class="icon-2" id="b"></div>
    <div class="icon-3" id="c"></div>
    <div class="clear"></div>
</button>