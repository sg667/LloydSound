<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lloydsound_2021
 */

get_header();
?>
<?php // Get all pages and place them into an ordered array
    $homepagePages = array(
        'numberposts' => -1,
        'post_type' => 'page',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'add_to_homepage',
                'value' => 'yes',
            ),
            array(
                'key' => 'order',
                'orderby' => 'meta_value',
                'order' => 'DESC'
            )
        )
    );
?>
	<main id="primary" class="site-main">
        <section id="home-content" class="front-embed" aria-label="introduction">
            <div class="embed-content-container">
            <?php
            while ( have_posts() ) : the_post();

                the_content();

            endwhile; // End of the loop.
            ?>
            </div>
        </section>
        <?php
        $page_query = new WP_Query($homepagePages);

        if ($page_query->have_posts() ) :
            while ( $page_query->have_posts() ) : $page_query->the_post();
                $featured_image = get_the_post_thumbnail_url(get_the_ID());
        ?>

            <section class="front-embed <?php if ($featured_image) : ?>has-bg-image<?php endif; ?>" id="section-<?php the_ID() ?>" aria-label="<?php the_title() ?>" style="<?php if ($featured_image) : ?>background: url('<?php echo $featured_image; ?>'); background-size:cover;<?php endif; ?>">
                <div class="embed-content-container">
                <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                    <?php 
                    // Variables for Grid
                    $postsToAdd = array(
                        'numberposts' => -1,
                        'post_type' => 'post',
                        'meta_query' => array(
                            'relation' => 'AND',
                            array(
                                'key' => 'add_to_grid',
                                'value' => 'yes',
                            ),
                            array(
                                'key' => 'page_slug',
                                'value' => $post->post_name,
                            ),
                            array(
                                'key' => 'post_order',
                                'orderby' => 'meta_value',
                                'order' => 'DESC'
                            )
                        )
                    );
                    $gridQuery = new WP_Query($postsToAdd);

                        //Start Loop for Grid
                        if ($gridQuery -> have_posts()) : ?>

                        <div class="flex-grid">
                        
                        <?php while ($gridQuery -> have_posts()) : $gridQuery -> the_post(); ?>
                            <?php $post_featured_image = get_the_post_thumbnail_url(get_the_ID()); ?>
                                

                                <div class="grid-object <?php if ($post_featured_image) : ?>post-has-bg-image<?php endif; ?>" style="<?php if ($post_featured_image) : ?>background: url('<?php echo $post_featured_image; ?>'); background-size:cover;<?php endif; ?>">
                                    <?php if (get_field('link_url', get_the_ID())) : ?>
                                        <a href="<?php get_field('link_url', get_the_ID())[1]?>" aria-labelledby="heading-<?php get_the_ID() ?>">
                                    <?php endif; ?>
                                   
                                    <div class="grid-content">
                                        <h3 id="heading-<?php get_the_ID() ?>"><?php the_title(); ?></h3>
                                        <?php the_content(); ?>
                                    </div>
                                   
                                    <?php if (get_field('link_url', get_the_ID())) : ?>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                
                    <?php endwhile; ?>

                </div>
                <?php endif;
                    wp_reset_postdata();
                ?>  
                </div>
            </section>

        <?php 
            endwhile;
        endif;
        wp_reset_postdata();
        ?>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
