<?php
/* Template Name: Komanda Page */
get_header(); ?>

<div class="page-title-strip">
    <h1><?php the_title(); ?></h1>
</div>

<div class="komanda-grid">
    <?php
    $args = array(
        'post_type' => 'team_member',
        'posts_per_page' => -1,
    );

    $team_members = new WP_Query($args);

    if ($team_members->have_posts()) :
        while ($team_members->have_posts()) : $team_members->the_post(); 
            $image = get_field('team_member_photo');
            $bgStyle = !empty($image) ? "background-image: url('". esc_url($image['url']) ."');" : "";
            ?>             
            <div class="team-member-wrapper">
                <div class="team-member" data-link="<?php the_permalink(); ?>" style="<?php echo $bgStyle; ?>">
                    <a href="<?php the_field('linkedin_link'); ?>" class="linkedin-icon-link">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/linkedin_gr.svg" alt="LinkedIn">
                    </a>
                </div>
                <div class="team-member-info">
                    <h3 class="team-member-name"><?php the_field('team_member_name'); ?> <?php the_field('team_member_surname'); ?></h3>
                    <p class="team-member-title"><?php the_field('team_member_job_title'); ?></p>
                </div>
            </div>
        <?php endwhile;
        wp_reset_postdata();
    else : ?>
        <p><?php _e('Sorry, no team members found.', 'text_domain'); ?></p>
    <?php endif; ?>
</div>


<?php get_template_part('template-parts/get-in-touch'); ?>

<?php get_footer(); ?>