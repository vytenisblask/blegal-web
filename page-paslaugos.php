<?php
/* Template Name: Paslaugos Page */
get_header(); ?>

<div class="page-title-strip">
    <h1><?php the_title(); ?></h1>
</div>

<div class="paslaugos-grid">
    <?php
    $args = array('post_type' => 'post', 'posts_per_page' => -1);
    $query = new WP_Query($args);
    
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); 
            $icon = get_field('icon');
            ?>
            <a href="<?php the_permalink(); ?>" class="post-item">
                <?php 
                if($icon): 
                    $icon_content = file_get_contents($icon['url']);
                    echo $icon_content;
                endif; 
                ?>
                <h2 class="post-title"><?php the_title(); ?></h2>
            </a>
        <?php endwhile; 
        wp_reset_postdata();
    else : ?>
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; ?>
</div>



<?php get_template_part('template-parts/get-in-touch'); ?>

<?php get_footer(); ?>