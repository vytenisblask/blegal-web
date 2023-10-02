<?php
/* Template Name: Naujienos Vidinis Page */
get_header(); ?>

<!-- Hero Section -->
<div class="post-hero" style="background-image: url('<?php the_field('image_field'); ?>" alt="<?php the_title(); ?>')">
    <div class="post-hero-content">

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