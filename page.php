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
<?php
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
?>
	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;

		endwhile; // End of the loop.
		?>
		<?php
			$gridQuery = new WP_Query($postsToAdd);

			if ($gridQuery -> have_posts()) : ?>

			<div class="flex-grid">
			<?php while ($gridQuery -> have_posts()) : $gridQuery -> the_post(); ?>
				<?php $post_featured_image = get_the_post_thumbnail_url(get_the_ID()); ?>
					<div class="grid-object" style="<?php if ($post_featured_image) : ?>background: url('<?php echo $post_featured_image; ?>'); background-size:cover;<?php endif; ?>">
						<div class="grid-content">
							<h3><?php the_title(); ?></h3>
							<?php the_content(); ?>
						</div>
					</div>
			<?php endwhile; ?>
			</div>
		<?php endif;
			wp_reset_postdata();
		?>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
