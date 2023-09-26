<?php
/* Template Name: Kontaktai Page */
get_header(); ?>

<div class="kontaktai-container">
    <div class="info-container">
        <div class="content">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/blegal_blck_trim.png" alt="Logo" class="logo">
            <p class="text"><?php echo get_theme_mod('kontaktai_text_setting', 'Default Text'); ?></p>
            <div class="address item">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/np_location.svg" alt="Location Icon">
                <span><?php echo get_theme_mod('kontaktai_address', 'Vinco Kudirkos g. 22-9, Vilnius'); ?></span>
            </div>
            <div class="phone item">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/np_phone.svg" alt="Phone Icon">
                <span><?php echo get_theme_mod('kontaktai_phone', '+370 5 238 5240'); ?></span>
            </div>
            <div class="email item">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/np_email.svg" alt="Email Icon">
                <span><?php echo get_theme_mod('kontaktai_email', 'info@blaskevicius.lt'); ?></span>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('template-parts/contact-us'); ?>

<?php get_footer(); ?>
