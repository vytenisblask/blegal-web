<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
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
        <img src="<?php echo get_template_directory_uri(); ?>/assets/np_burger-menu.svg" class="menu-toggle" alt="Menu Toggle" data-state="burger">
            <?php 
            wp_nav_menu( array( 
                'theme_location' => 'primary', 
                'menu_id'        => 'primary-menu',
                'container'      => false 
            ) ); 
            ?>
            <a href="/kontaktai" class="cta-button mobile-cta">Kontaktai</a> <!-- Mobile version of the CTA -->
        </nav>
        <a href="/kontaktai" class="cta-button desktop-cta">Kontaktai</a> <!-- Desktop version of the CTA -->
    </div>
</header>