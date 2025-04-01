<?php get_header(); ?>
<h1><?php single_term_title(); ?></h1>
<?php
if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <div>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('student-thumb-small'); ?>
                <h2><?php the_title(); ?></h2>
            </a>
        </div>
    <?php endwhile;
else :
    echo '<p>No students found in this program.</p>';
endif;
?>
<?php get_footer(); ?>
