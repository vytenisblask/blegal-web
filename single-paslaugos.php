<?php
/* Template Name: Paslaugos Vidinis Page */
get_header(); ?>

<!-- Hero Section -->
<div class="post-hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/da4eF61ZGFY.jpg')">
    <div class="post-hero-content">
        <a href="/paslaugos" class="back-to-listing">
           &#8592; visos paslaugos
        </a>
        <!-- Display SVG icon 
        <?php $icon = get_field('icon'); ?>
        <?php if($icon): ?>
            <div class="post-icon">
                <?php echo file_get_contents(esc_url($icon['url'])); ?>
            </div>
        <?php endif; ?>-->
        <h1 class="post-title"><?php the_title(); ?></h1>
    </div>
</div>

<!-- Post Content -->
<div class="post-content">
    <?php while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
</div>

<?php get_template_part('template-parts/get-in-touch'); ?>

<?php get_footer(); ?>