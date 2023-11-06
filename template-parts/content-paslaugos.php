<?php
$args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'display_on_front_page',
            'value' => '1',
        ),
    ),
);

$query = new WP_Query($args);

echo '<div class="paslaugos-grid-wrapper">';
if ($query->have_posts()) :
        echo '<div class="paslaugos-grid">';
    
    // Loop through the posts
    while ($query->have_posts()) : $query->the_post();
        $icon = get_field('icon');
        ?>       
        <a href="<?php the_permalink(); ?>" class="post-item">
            <?php
            if ($icon):
                $icon_content = file_get_contents($icon['url']);
                echo $icon_content;
            endif;
            ?>
            <h2 class="post-title"><?php the_title(); ?></h2>
        </a>  
    <?php endwhile;
    
    echo '</div>';
    
    // Reset post data
    wp_reset_postdata();
    
    echo '<a href="/paslaugos" class="all-services-link">visos paslaugos &#8594;</a>';

else : 
    echo '<p>Sorry, no featured posts are available.</p>';
endif;

echo '</div>';