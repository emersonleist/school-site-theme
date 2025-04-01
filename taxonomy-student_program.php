<?php get_header(); ?>

<h1><?php single_term_title(); ?></h1>

<?php
if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <div class="student-card">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('student-thumb-small'); ?>
                <h2><?php the_title(); ?></h2>
            </a>

            <div class="student-programs">
                <?php
                $terms = get_the_terms(get_the_ID(), 'student_program');
                if ($terms && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        $term_link = get_term_link($term);
                        echo '<a href="' . esc_url($term_link) . '" class="student-term">' . esc_html($term->name) . '</a> ';
                    }
                }
                ?>
            </div>
        </div>
    <?php endwhile;
else :
    echo '<p>No students found in this program.</p>';
endif;
?>

<?php get_footer(); ?>
