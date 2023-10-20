<?php

function theme_nav_breadcrumb() {

	/* === OPTIONS === */
	$text['404']	  = __('Error 404', 'beritaxx'); 

	$show_current     = 0; 
	$show_on_home     = 0;
	$show_on_404      = 0;
	$show_home_link   = 1;
	$show_title	      = 1;
	$delimiter	      = ' <i class="fas fa-chevron-right"></i> '; 
	$before		      = '<span class="current">';
	$after		      = '</span>'; 

	global $post;
	$home_link	      = home_url('/');
	$link_before      = '<span>';
	$link_after       = '</span>';
	$link_attr	      = ' itemprop="url"';
	$link		      = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
	
	if (isset($post->post_parent)) {
		$parent_id	= $parent_id_2 = $post->post_parent;
	}
	
	$frontpage_id     = get_option('page_on_front');

	if (!$show_on_404 && is_404() ) {
		return;
	}

	if ( is_home() || is_front_page() || (empty($post)) ) {

		if ($show_on_home == 1)
			echo '<div class="beritaxx_schema" itemscope itemtype="https://schema.org/WebPage"><div class="schema_inner" itemprop="breadcrumb"><a href="' . esc_html( $home_link ) . '">' . esc_html_e( 'Home', 'beritaxx' ) . '</a></div></div>';

	} else {

		echo '<div class="beritaxx_schema" itemscope itemtype="https://schema.org/WebPage"><div class="schema_inner" itemprop="breadcrumb">';
		if ($show_home_link == 1) {
			echo '<span>';
			echo '<a href="' . esc_url( $home_link ) . '" itemprop="url">';
			esc_html_e( 'Home', 'beritaxx' );
			echo '</a>';
			echo '</span>';
			if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
		}

		if ( is_category() ) {
			$this_cat = get_category(get_query_var('cat'), false);
			if ($this_cat->parent != 0) {
				$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
				if ($show_current == 0) 
					$cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
			    	$cats = str_replace('<a', '<span><a itemprop="url"', $cats);
			     	$cats = str_replace('</a>', '</a></span>', $cats);
				if ($show_title == 0) 
					$cats = preg_replace('/ title="(.*?)"/', '', $cats);
			    	echo $cats;
			}
			if ($show_current == 1) echo '<span>' . single_cat_title('', false) . '</span>';

		} elseif ( is_search() ) {
			echo '<span class="current">' . esc_html( get_search_query()) . '</span>';

		} elseif ( is_day() ) {
			echo '<span><a href="' . esc_url( get_year_link(get_the_time('Y') ) ).'">' . esc_html( get_the_time('Y') ) .'</a></span>' . $delimiter;
			echo '<span><a href="' . esc_url( get_month_link(get_the_time('Y'),get_the_time('m') ) ).'">' .  esc_html( get_the_time('F') ) .'</a></span>' . $delimiter;
			echo '<span class="current">' . esc_html( get_the_time('d') ) . '</span>';

		} elseif ( is_month() ) {
			echo '<span><a href="' . esc_url( get_year_link(get_the_time('Y') ) ).'">' . esc_html( get_the_time('Y') ) .'</a></span>' . $delimiter;
			echo '<span class="current">' . esc_html( get_the_time('F') ) . '</span>';

		} elseif ( is_year() ) {
			echo '<span class="current">' . esc_html( get_the_time('Y') ) . '</span>';

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<span><a href="' . esc_html( $home_link ) . esc_html( $slug['slug'] ) . '/">' . esc_html( $post_type->labels->singular_name ) .'</a></span>';
				if ($show_current == 1) echo $delimiter . '<span>' . esc_html( get_the_title() ) . '</span>';
			} else {
				$cat = get_the_category(); 
				$cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($show_current == 0) 
					$cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
			    	$cats = str_replace('<a', '<span><a itemprop="url"', $cats);
			    	$cats = str_replace('</a>', '</a></span>', $cats);
				if ($show_title == 0) 
					$cats = preg_replace('/ title="(.*?)"/', '', $cats);
			    	echo $cats;
				if ($show_current == 1) echo '<span class="current">' . esc_html( get_the_title() ) . '</span>';
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo '<span class="current">' . esc_html( $post_type->labels->singular_name ) . '</span>';

		} elseif ( is_attachment() ) {
			esc_html_e('Attachment', 'beritaxx');

		} elseif ( is_page() && !$parent_id ) {
			if ($show_current == 1)
				echo '<span class="current">' . esc_html( get_the_title() ) . '</span>';

		} elseif ( is_page() && $parent_id ) {
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo $delimiter;
				}
			}
			if ($show_current == 1) {
				if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
				echo '<span class="current">' . esc_html( get_the_title() ) . '</span>';
			}

		} elseif ( is_tag() ) {
			echo '<span class="current">' . single_tag_title('', false) . '</span>';

		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo '<span class="current">' . esc_html( $userdata->display_name ) . '</span>';

		} elseif ( has_post_format() && !is_singular() ) {
			echo esc_html( get_post_format_string( get_post_format() ) );

		} elseif ( is_404() ) {
			echo '<span class="current">' . esc_html_e( 'Error 404', 'beritaxx' ) . '</span>';
		}


		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
			esc_html_e(' / Page : ', 'beritaxx') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
		}

		echo '</div></div><!-- .breadcrumbs -->';

	}
}