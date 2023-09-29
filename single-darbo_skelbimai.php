<?php
/* Template Name: Skelbimas Vidinis Page */
get_header(); ?>

<!-- Hero Section -->
<div class="post-hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/da4eF61ZGFY.jpg')">
    <div class="post-hero-content">
        <h1 class="post-title"><?php the_title(); ?></h1>
    </div>
</div>

<div class="job-wrap">
    <main class="job-description">
        <?php
        while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </main>
</div>

<?php get_template_part('template-parts/karjera-contact'); ?>

<?php get_footer(); ?>