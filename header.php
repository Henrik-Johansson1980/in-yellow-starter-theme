<?php
/**
 * Header file for the InYellow Starter theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage inyellowstarter
 * @since inyellowstarter 1.0
 */

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'twentynineteen' ); ?></a>

	<header id="site-header" class="site-header <?php echo is_singular() ? 'is-singular' : 'is-archive'; ?>" role="banner">
		<div class="site-header-top">
			<div class="site-header-top-left">
				<!-- Social Nav / Login -->
				<?php
				if ( has_nav_menu( 'social' ) ) {
					wp_nav_menu(
						array(
							'theme_location'  => 'social',
							'container'       => 'div',
							'container_id'    => 'menu-social',
							'container_class' => 'menu',
							'menu_id'         => 'menu-social-items',
							'menu_class'      => 'menu-items',
							'depth'           => 1,
							'link_before'     => '<span class="screen-reader-text">',
							'link_after'      => '</span>',
							'fallback_cb'     => '',
						)
					);
				}
				?>

				<?php if ( ! is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wp_login_url() ); ?>" class="site-admin-link site.login">Login</a>
				<?php else : ?>
					<a href="<?php echo esc_url( wp_logout_url() ); ?>" class="site-admin-link site-logout">Logout</a>
				<?php endif; ?>

			</div> <!-- site-header-top-left -->

			<div class="site-header-top-center">
				<!-- Site Branding -->
				<div class="site-branding">
					<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
						<a href="<?php echo esc_url( get_bloginfo( 'url' ) ); ?>" class="site-logo">
							<?php the_custom_logo(); ?>
						</a>
					<?php endif; ?>
					<div class="site-identity">
						<a href="<?php echo esc_url( get_bloginfo( 'url' ) ); ?>" class="site-title-link">
							<h1 class="site-title"><?php echo esc_attr( get_bloginfo( 'name' ) ); ?></h1>
						</a>
						<p class="site-description"><?php echo esc_attr( get_bloginfo( 'description' ) ); ?></p>
					</div>
				</div>
			</div> <!-- site-header-top-center -->

			<div class="site-header-top-right">
				<!-- Search -->
				<?php get_search_form(); ?>
			</div> <!-- site-header-top-right -->
		</div> <!-- Header top section -->

		<nav class="site-navigation" aria-label="<?php esc_attr_e( 'Header Menu', 'inyellowstarter' ); ?>" role="navigation">
			<ul class="header-menu">
				<?php
				if ( has_nav_menu( 'header' ) ) {
						wp_nav_menu(
							array(
								'container'      => 'div',
								'items_wrap'     => '%3$s',
								'theme_location' => 'header',
							)
						);
				} else {
					wp_list_pages(
						array(
							'match_menu_classes'  => true,
							'show_sub_menu_icons' => true,
							'title_li'            => false,
						)
					);
				}
				?>
			</ul>
		</nav> <!--Main navigation-->
	</header>
