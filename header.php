<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Optional meta tags for SEO, social sharing, etc. -->
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="container">
        <div class="logo">
            <?php 
            if ( function_exists( 'the_custom_logo' ) ) {
                the_custom_logo();
            } 
            ?>
        </div>

        <nav class="main-navigation">
            <?php 
            wp_nav_menu( array( 
                'theme_location' => 'primary', 
                'menu_id'        => 'primary-menu',
                'container'      => false 
            ) ); 
            ?>
        </nav>

        <a href="/kontaktai" class="cta-button">Kontaktai</a>
    </div>
</header>