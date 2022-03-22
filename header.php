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

    <div class="sidebar-top">
        <!--  Nav-lang  -->
        <?php get_template_part('template-parts/header/nav/nav-lang'); ?>
    </div>
    <div class="sidebar-head">
        <!--  box-user  -->
        <?php get_template_part('template-parts/header/user/profil'); ?>
    </div>
    <div class="sidebar-content">
        <!--  Nav-principal  -->
        <?php get_template_part('template-parts/header/nav/nav-principal'); ?>
    </div>
    <div class="sidebar-footer">
        <!--  Social-Network  -->
        <?php get_template_part('template-parts/header/social/social'); ?>
    </div>
    
</header>