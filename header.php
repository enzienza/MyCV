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
<body <?php body_class(); ?> data-spy="scroll" data-target="#btn-menu">


<header class="sidebar">

    <!--  Nav-lang  -->
    <?php get_template_part('template-parts/header/nav/nav-lang'); ?>

    <?php if(checked(1, get_option('sidebar_hidden_user'), false)): else: ?>
        <!--  box-user  -->
        <?php get_template_part('template-parts/header/user/profil'); ?>
    <?php endif; ?>
    <!--  Nav-principal  -->
    <?php get_template_part('template-parts/header/nav/nav-principal'); ?>

    <?php if(checked(1, get_option('sidebar_hidden_social'), false)): else: ?>
        <!--  Social-Network  -->
        <?php get_template_part('template-parts/header/social/social'); ?>
    <?php endif; ?>
</header>

<!--  BTN-MOBILE  -->
<button class="btn-menu" id="btn-menu" type="button">
    <div class="btn-menu__burger"></div>
</button>