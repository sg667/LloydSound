<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lloydsound_2021
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'ls21' ); ?></a>

	<header id="masthead" class="site-header" style="background: url('<?php header_image(); ?>'); background-size: cover; background-repeat: no-repeat; background-position: center;">
	<?php// the_header_image_tag(); ?>
		<div class="header-container">
			<div class="site-branding">
				<?php
				if (is_front_page()) :
				?>
				<h1><?php the_custom_logo(); ?></h1>
				<?php else : ?>
				<p><?php the_custom_logo(); ?></p>
				<?php endif;

				if ( is_active_sidebar('contact-1') ) :
					dynamic_sidebar('contact-1');
				endif;

				$ls21_description = get_bloginfo( 'description', 'display' );
				?>
			</div><!-- .site-branding -->
			<div class="header-right">
				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'ls21' ); ?></button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav><!-- #site-navigation -->
				<?php 
				if ( $ls21_description || is_customize_preview() ) : ?>
					<p class="front-description"><?php echo $ls21_description ?></p>
			<?php endif; ?>
			</div>
		</div>
	</header><!-- #masthead -->
