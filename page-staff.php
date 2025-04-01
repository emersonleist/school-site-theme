<?php
/**
 * Template Name: Staff Page
 */

get_header(); ?>

<main class="staff-page">
    <header class="page-header">
        <h1><?php the_title(); ?></h1>
        <div class="page-intro">
            <?php the_content(); // Editable intro text ?>
        </div>
    </header>

    <?php
    $terms = get_terms([
        'taxonomy'   => 'staff_department',
        'hide_empty' => true,
    ]);

    if ($terms) :
        foreach ($terms as $term) :
            ?>
            <section class="staff-department">
                <h2><?php echo esc_html($term->name); ?></h2>
                <div class="staff-list">
                    <?php
                    $staff_query = new WP_Query([
                        'post_type'      => 'staff',
                        'posts_per_page' => -1,
                        'tax_query'      => [
                            [
                                'taxonomy' => 'staff_department',
                                'field'    => 'slug',
                                'terms'    => $term->slug,
                            ],
                        ],
                    ]);

                    if ($staff_query->have_posts()) :
                        while ($staff_query->have_posts()) : $staff_query->the_post();
                            ?>
                            <article class="staff-member">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="staff-photo">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="staff-info">
                                    <h3><?php the_title(); ?></h3>
                                    <div class="staff-details">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </article>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </section>
            <?php
        endforeach;
    else :
        echo '<p>No staff members found.</p>';
    endif;
    ?>

</main>

<?php get_footer(); ?>
