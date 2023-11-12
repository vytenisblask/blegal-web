<?php
/* Template Name: Komanda Vidinis Page */
get_header(); ?>

<div class="page-title-strip">
    <h1><?php the_field('team_member_name'); ?> <?php the_field('team_member_surname'); ?></h1>
</div>

<div class="team-member-single">
    <div class="team-member-photo" style="background-image: url('<?php the_field('team_member_photo'); ?>')"></div>
    <div class="team-member-details">
        <div class="post-content">
            <?php the_field('team_member_description'); ?>
        </div>
    </div>
</div>


<?php get_template_part('template-parts/get-in-touch'); ?>

<?php get_footer(); ?>