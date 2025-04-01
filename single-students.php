<?php get_header(); ?>
<h1><?php the_title(); ?></h1>
<?php
if (has_post_thumbnail()) {
    the_post_thumbnail('student-thumb-medium');
}
the_content();

// Show taxonomy terms
$terms = get_the_terms(get_the_ID(), 'student_program');
if ($terms) {
    echo '<h3>Program(s):</h3>';
    foreach ($terms as $term) {
        echo '<span>' . esc_html($term->name) . '</span> ';
    }
}
?>
<?php get_footer(); ?>
