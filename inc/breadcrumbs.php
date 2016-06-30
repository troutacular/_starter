<?php

/**
 * Breacrumbs
 *
 * Breadcrumb navigation for current post/page and ancestors
 *
 * @return  void
 *
 * @todo rewrite to recuce complexity
 * @package _starter
 */
function _starter_bread_crumbs() {

	/* === OPTIONS === */
	$text['home']		= 'Home'; // text for the 'Home' link
	$text['category']	= '%s'; // text for a category page
	$text['search']		= 'Search Results for "%s" Query'; // text for a search results page
	$text['tag']		= 'Posts Tagged "%s"'; // text for a tag page
	$text['author']		= 'Articles Posted by %s'; // text for an author page
	$text['404']		= 'Error 404'; // text for the 404 page

	$show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
	$show_on_home   = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
	$show_title	 	= 1; // 1 - show the title for the links, 0 - don't show
	$delimiter		= ''; // delimiter between crumbs, use css to set the delimiter as a content element :before
	$before			= '<li class="current">'; // tag before the current crumb
	$after			= '</li>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post;
	$home_link		= home_url();
	$link_before	= '<li>';
	$link_after		= '</li>';
	$link_attr		= '';
	$link			= $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
	$parent_id		= $parent_id_2 = $post->post_parent;
	$frontpage_id	= get_option( 'page_on_front' );

	if ( is_home() || is_front_page() ) {

		if ( 1 === $show_on_home ) {
			echo '<ul class="breadcrumbs"><a href="' . esc_url( $home_link ) . '">' . esc_html( $text['home'] ) . '</a></ul>';
		}
	}

	if ( ! is_home() || ! is_front_page() ) {

		echo '<ul class="breadcrumbs">';
		if ( 1 === $show_home_link ) {
			printf( $link, $home_link, $text['home'] );
			if ( 0 === $frontpage_id || $parent_id !== $frontpage_id ) {
				echo $delimiter;
			}
		}

		if ( is_category() ) {
			$this_cat = get_category( get_query_var( 'cat' ), false );
			if ( 0 !== $this_cat->parent ) {
				$cats = get_category_parents( $this_cat->parent, true, $delimiter );
				if ( 0 === $show_current ) {
					$cats = preg_replace( "#^(.+)$delimiter$#", '$1', $cats );
				}
				$cats = str_replace( '<a', $link_before . '<a' . $link_attr, $cats );
				$cats = str_replace( '</a>', '</a>' . $link_after, $cats );
				if ( 0 === $show_title ) {
					$cats = preg_replace( '/ title="(.*?)"/', '', $cats );
				}
				echo $cats;
			}
			if ( 1 === $show_current ) {
				echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
			}
		} elseif ( is_search() ) {
			echo $before . sprintf( $text['search'], get_search_query() ) . $after;

		} elseif ( is_day() ) {
			echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . $delimiter;
			echo sprintf( $link, get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ), get_the_time( 'F' ) ) . $delimiter;
			echo $before . get_the_time( 'd' ) . $after;

		} elseif ( is_month() ) {
			echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . $delimiter;
			echo $before . get_the_time( 'F' ) . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time( 'Y' ) . $after;

		} elseif ( is_single() && ! is_attachment() ) {
			if ( get_post_type() !== 'post' ) {
				$post_type = get_post_type_object( get_post_type() );
				$slug = $post_type->rewrite;
				printf( $link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name );
				if ( 1 === $show_current ) {
					echo $delimiter . $before . get_the_title() . $after;
				}
			}
			if ( get_post_type() === 'post' ) {
				$cat = get_the_category();
				$cat = $cat[0];
				$cats = get_category_parents( $cat, true, $delimiter );
				if ( 0 === $show_current ) {
					$cats = preg_replace( "#^(.+)$delimiter$#", '$1', $cats );
				}
				$cats = str_replace( '<a', $link_before . '<a' . $link_attr, $cats );
				$cats = str_replace( '</a>', '</a>' . $link_after, $cats );
				if ( 0 === $show_title ) {
					$cats = preg_replace( '/ title="(.*?)"/', '', $cats );
				}
				echo $cats;
				if ( 1 === $show_current ) {
					echo $before . get_the_title() . $after;
				}
			}
		} elseif ( ! is_single() && ! is_page() && get_post_type() !== 'post' && ! is_404() ) {
			$post_type = get_post_type_object( get_post_type() );
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) {
			if ( 1 === $show_current ) {
				echo $delimiter . $before . get_the_title() . $after;
			}
		} elseif ( is_page() && ! $parent_id ) {
			if ( 1 === $show_current ) {
				echo $before . get_the_title() . $after;
			}
		} elseif ( is_page() && $parent_id ) {
			if ( $parent_id !== $frontpage_id ) {
				$breadcrumbs = array();
				while ( $parent_id ) {
					$page = get_page( $parent_id );
					if ( $parent_id !== $frontpage_id ) {
						$breadcrumbs[] = sprintf( $link, get_permalink( $page->ID ), get_the_title( $page->ID ) );
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse( $breadcrumbs );
				$breadcrumbs_count = count( $breadcrumbs );
				for ( $i = 0; $i < $breadcrumbs_count; $i++ ) {
					echo $breadcrumbs[ $i ];
					if ( $breadcrumbs_count - 1 !== $i ) {
						echo $delimiter;
					}
				}
			}
			if ( 1 === $show_current ) {
				if ( 1 === $show_home_link || ( 0 !== $parent_id_2 && $parent_id_2 !== $frontpage_id ) ) {
					echo $delimiter;
				}
				echo $before . get_the_title() . $after;
			}
		} elseif ( is_tag() ) {
			echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;

		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata( $author );
			echo $before . sprintf( $text['author'], $userdata->display_name ) . $after;

		} elseif ( is_404() ) {
			echo $before . esc_html( $text['404'] ) . $after;
		}

		if ( get_query_var( 'paged' ) ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
				echo $before;
			}
			echo _e( 'Page', '_starter' ) . ' ' . get_query_var( 'paged' );
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
				echo $after;
			}
		}

		echo '</ul>';

	}
}
