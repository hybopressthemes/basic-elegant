<?php

printf( '<li %s>', hybrid_get_attr( 'comment' ) );

	printf( '<header class="%s">', 'comment-meta' );

		printf( '<cite %s>', hybrid_get_attr( 'comment-author' ) );

			echo get_comment_author_link();

		echo '</cite><br />';

		printf( '<time %s>', hybrid_get_attr( 'comment-published' ) );

			printf( __( '%s ago', 'hybopress' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) );

		echo '</time>';

		printf( '<a %s>', hybrid_get_attr( 'comment-permalink' ) );

			_e( 'Permalink', 'hybopress' );

		echo '</a>';

		edit_comment_link();

	echo '</header><!-- .comment-meta -->';

/* No closing </li> is needed.  WordPress will know where to add it. */
