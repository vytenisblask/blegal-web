<?php
/* Template Name: Karjera Page */
get_header(); ?>

<div class="about-hero" style="background-image: url('<?php the_field('karjera_background_image'); ?>');">
    <div class="about-hero-content">
        <h1><?php the_title(); ?></h1>
        <!-- <h1>Prisijunk prie mūsų</h1> -->
    </div>
</div>

<?php
$args = array(
    'post_type' => 'darbo_skelbimai',
    'posts_per_page' => -1, // Display all posts
);

$query = new WP_Query($args);

if ($query->have_posts()) : ?>
    <div class="job-posts-container">
        <h2>Šiuo metu ieškome:</h2>
        <div class="job-posts">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="job-post">
                    <?php the_title(); ?>
                </a>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif; wp_reset_postdata(); ?>

<?php get_template_part('template-parts/karjera-whywork'); ?>

<?php get_template_part('template-parts/karjera-contact'); ?>

<?php get_footer(); ?>