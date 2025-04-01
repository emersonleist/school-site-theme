<?php get_header(); ?>

<h1>Students</h1>

<?php
$args = array(
    'post_type' => 'students',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
);
$students = new WP_Query($args);

if ($students->have_posts()) :
    while ($students->have_posts()) : $students->the_post(); ?>
        <div class="student-card">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('student-thumb-medium'); ?>
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
    wp_reset_postdata();
else :
    echo '<p>No students found.</p>';
endif;
?>

<?php get_footer(); ?>
