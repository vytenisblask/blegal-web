<?php
$args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'display_on_front_page', // ACF field name
            'value' => '1', // 1 for true
        ),
    ),
);

$query = new WP_Query($args);

// Start the outer wrapper div
echo '<div class="paslaugos-grid-wrapper">';

// Check if we have posts to display
if ($query->have_posts()) :
    
    // Start the grid div
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
    
    // End the grid div
    echo '</div>';
    
    // Reset post data
    wp_reset_postdata();
    
    // Output the link to the "paslaugos" listing page
    echo '<a href="/paslaugos" class="all-services-link">visos paslaugos &#8594;</a>';

else : 
    // Output a message if no posts are available
    echo '<p>Sorry, no featured posts are available.</p>';
endif;

// End the outer wrapper div
echo '</div>';

