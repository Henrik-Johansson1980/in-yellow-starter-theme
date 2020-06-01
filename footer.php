<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage inyellowstarter
 * @since inyellowstarter 1.0
 */

$has_footer_menu = has_nav_menu( 'footer' );
$has_social_menu = has_nav_menu( 'social' );

?>
	<footer id="site-footer" role="contentinfo" class="site-footer">

		<div class="container">
			<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
				<aside id="sidebar-footer" class="sidebar sidebar-footer widget-area" role="complementary">
					<?php dynamic_sidebar( 'sidebar-footer' ); ?>
				</aside><!-- .sidebar .widget-area -->
			<?php endif; ?>
		</div><!-- .container -->

		<div class="colophon" style="background: rgba(13,13,13, 0.9) url('<?php esc_url( header_image() ); ?>')">
			<div class="container colophon-content">
			<?php

			$footer_top_classes  = '';
			$footer_top_classes .= $has_footer_menu ? ' has-footer-menu' : '';
			$footer_top_classes .= $has_social_menu ? ' has-social-menu' : '';

			if ( $has_footer_menu || $has_social_menu ) {
				?>
				<div class="footer-top<?php echo $footer_top_classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">
					<?php if ( $has_social_menu ) { ?>

						<nav aria-label="<?php esc_attr_e( 'Social links', 'inyellowstarter' ); ?>" class="footer-social-wrapper">

							<ul class="social-menu footer-social reset-list-style social-icons fill-children-current-color">

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

							</ul><!-- .footer-social -->

						</nav><!-- .footer-social-wrapper -->

					<?php } ?>
				</div><!-- .footer-top -->

				<?php } ?>

				<p class="footer-credits">
					<span class="footer-copyright">&copy;
						<?php
						echo esc_html(
							date_i18n(
							/* translators: Copyright date format, see https://www.php.net/date */
								_x( 'Y', 'copyright date format', 'inyellowstarter' )
							)
						);
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
					</span><!-- .footer-copyright -->

					<span class="powered-by-wordpress">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'inyellowstarter' ) ); ?>">
							<?php esc_html_e( 'Powered by WordPress', 'inyellowstarter' ); ?>
						</a>
					</span><!-- .powered-by-wordpress -->

				</p><!-- .footer-credits -->
				<?php if ( $has_footer_menu ) { ?>

				<nav aria-label="<?php esc_attr_e( 'Footer', 'inyellowstarter' ); ?>" role="navigation" class="footer-menu-wrapper">

				<ul class="footer-menu reset-list-style">
					<?php
					wp_nav_menu(
						array(
							'container'      => '',
							'items_wrap'     => '%3$s',
							'theme_location' => 'footer',
						)
					);
					?>
				</ul>

				</nav><!-- .site-nav -->

				<?php } ?>
				<a class="to-the-top" href="#site-header">
					<span class="to-the-top-long">
						<?php
						/* translators: %s: HTML character for up arrow. */
						printf( esc_html__( 'To the top %s', 'inyellowstarter' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
						?>
					</span><!-- .to-the-top-long -->
				</a><!-- .to-the-top -->

			</div><!-- .container -->
		</div><!-- .colophon -->

	</footer><!-- #site-footer -->

	<?php wp_footer(); ?>

	</body>
</html>
