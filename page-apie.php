<?php
/* Template Name: About Page */
get_header(); ?>

<div class="about-hero" style="background-image: url('<?php the_field('about_background_image'); ?>');">
    <div class="about-hero-content">
        <!-- <h1><?php the_title(); ?></h1> -->
        <h1>Apie mus</h1>
    </div>
</div>

<div class="about-content">
    <?php
    while (have_posts()) : the_post();
        the_content();
    endwhile;
    ?>
</div>

<?php get_template_part('template-parts/get-in-touch'); ?>
<?php get_footer(); ?>