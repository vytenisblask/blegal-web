<?php
/* Template Name: Naujienos Page */
get_header(); ?>

<div class="page-title-strip">
    <h1><?php the_title(); ?></h1>
</div>

<div class="naujienos-container">
    <div class="naujienos-grid">

        <?php
        $args = array(
            'post_type' => 'naujienos',
            'posts_per_page' => -1
        );
        $naujienos = new WP_Query($args);

        if ($naujienos->have_posts()) : 
            while ($naujienos->have_posts()) : $naujienos->the_post(); ?>

                <div class="naujienos-item">
                    <div class="naujienos-image">
                        <img src="<?php the_field('image_field'); ?>" alt="<?php the_title(); ?>">
                    </div>
                    <div class="naujienos-content">
                        <h2><?php the_title(); ?></h2>
                        <p><?php echo substr(get_the_excerpt(), 0, 75) . (strlen(get_the_excerpt()) > 45 ? "..." : ""); ?></p>
                        <a href="<?php the_permalink(); ?>">Skaityti toliau &#8594;</a>
                    </div>
                </div>

            <?php endwhile;
        endif; 
        wp_reset_postdata();
        ?>

    </div>
</div>


<?php get_template_part('template-parts/get-in-touch'); ?>

<?php get_footer(); ?>