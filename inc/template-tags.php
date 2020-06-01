<?php
/**
 * Custom template tags for this theme
 *
 * @package WordPress
 * @subpackage inyellowstarter
 * @since inyellowstarter 1.0
 */

if ( ! function_exists( 'inyellowstarter_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function inyellowstarter_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>, Updated: <time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			'<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			'<i class="far fa-clock"></i>',
			esc_url( get_permalink() ),
			wp_kses_post( $time_string )
		);
	}
endif;

if ( ! function_exists( 'inyellowstarter_posted_by' ) ) :
	/**
	 * Prints HTML with meta information about theme author.
	 */
	function inyellowstarter_posted_by() {
		printf(
			/* translators: 1: SVG icon. 2: Post author, only visible to screen readers. 3: Author link. */
			'<span class="byline">%1$s<span class="screen-reader-text">%2$s</span><span class="author vcard"><a class="url fn n" href="%3$s">%4$s</a></span></span>',
			'<i class="fas fa-user"></i>',
			esc_html__( 'Posted by', 'inyellowstarter' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
endif;

if ( ! function_exists( 'inyellowstarter_comment_count' ) ) :
	/**
	 * Prints HTML with the comment count for the current post.
	 */
	function inyellowstarter_comment_count() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			echo '<i class="fas fa-comment-dots"></i>';

			/* translators: %s: Post title. Only visible to screen readers. */
			comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'inyellowstarter' ), get_the_title() ) );

			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'inyellowstarter_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function inyellowstarter_entry_footer() {

		// Hide author, post date, category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			if ( ! is_single() ) {
				// Posted by.
				inyellowstarter_posted_by();
			}

			// Edit post link.
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Post title. Only visible to screen readers. */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'inyellowstarter' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link"><i class="fas fa-edit"></i></span>'
			);

			echo '<br />';

			/* translators: Used between list items, there is a space after the comma. */
			$categories_list = get_the_category_list( __( ', ', 'inyellowstarter' ) );
			if ( $categories_list ) {
				printf(
					/* translators: 1: SVG icon. 2: Posted in label, only visible to screen readers. 3: List of categories. */
					'<span class="cat-links">%1$s<span class="screen-reader-text">%2$s</span>%3$s</span>',
					'<i class="far fa-folder-open"></i>',
					esc_html__( 'Posted in', 'inyellowstarter' ),
					wp_kses_post( $categories_list )
				); // phpcs ignore.
			}

			if ( is_single() ) {
				/* translators: Used between list items, there is a space after the comma. */
				$tags_list = get_the_tag_list( '', __( ', ', 'inyellowstarter' ) );
				if ( $tags_list ) {
					printf(
						/* translators: 1: SVG icon. 2: Posted in label, only visible to screen readers. 3: List of tags. */
						'<span class="tags-links">%1$s<span class="screen-reader-text">%2$s </span>%3$s</span>',
						'<i class="fas fa-tags"></i>',
						esc_html__( 'Tags:', 'inyellowstarter' ),
						wp_kses_post( $tags_list )
					); // phpcs ignore.
				}
			}

			if ( ! is_singular() ) {
				// Posted on.
				inyellowstarter_posted_on();
				// Comment count.
				inyellowstarter_comment_count();

				// Author avatar.
				printf(
					'<span class="author-avatar"><a href="%1$s"><img src="%2$s" /></a></span>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_url( get_avatar_url( get_the_author_meta( 'ID' ) ) )
				);
			}
		}
	}
endif;

/**
 * Entry header meta
 */
function inyellowstarter_entry_header() {
	?>
	<div class="entry-meta">
		<?php
		/* translators: Used between list items, there is a space after the comma. */
		$categories_list = get_the_category_list( __( ', ', 'inyellowstarter' ) );
		if ( $categories_list ) {
			printf(
				/* translators: 1: SVG icon. 2: Posted in label, only visible to screen readers. 3: List of categories. */
				'<span class="cat-links">%1$s<span class="screen-reader-text">%2$s</span>%3$s</span>',
				'<i class="far fa-folder-open"></i>',
				esc_html__( 'Posted in', 'inyellowstarter' ),
				wp_kses_post( $categories_list )
			); // phpcs ignore.
		}

		// Posted on.
		inyellowstarter_posted_on();
		?>
	</div>
	<?php
}

/**
 * Entry Sidebar meta
 */
function inyellowstarter_entry_sidebar() {
	?>
	<div class="entry-meta">
		<?php
		// Posted by.
		inyellowstarter_posted_by();
		// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Post title. Only visible to screen readers. */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'inyellowstarter' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link"><i class="fas fa-edit"></i></span>'
		);
		// Author avatar.
		printf(
			'<span class="author-avatar"><a href="%1$s"><img src="%2$s" /></a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_url( get_avatar_url( get_the_author_meta( 'ID' ) ) )
		);
		?>
	</div>
	<?php
}

/**
 * Archives
 */
/**
 * Filters the archive title and styles the word before the first colon.
 *
 * @param string $title Current archive title.
 *
 * @return string $title Current archive title.
 */
function inyellowstarter_get_the_archive_title( $title ) {

	$regex = apply_filters(
		'inyellowstarter_get_the_archive_title_regex',
		array(
			'pattern'     => '/(\A[^\:]+\:)/',
			'replacement' => '<span class="color-accent">$1</span>',
		)
	);

	if ( empty( $regex ) ) {

		return $title;

	}

	if ( is_home() ){
		return get_bloginfo( 'name' );
	}

	return preg_replace( $regex['pattern'], $regex['replacement'], $title );

}

add_filter( 'get_the_archive_title', 'inyellowstarter_get_the_archive_title' );
