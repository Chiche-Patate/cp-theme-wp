<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <header>
            <?php get_template_part('templates/navigation'); ?> <!-- TODO: à créer -->
            <?php get_template_part('templates/page-title'); ?> <!-- TODO: à créer -->
        </header>