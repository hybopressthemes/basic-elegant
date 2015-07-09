<?php

printf( '<li %s>', hybrid_get_attr( 'comment' ) );

	printf( '<article>' );

		printf( '<header class="%s">', 'comment-meta clearfix' );

			echo get_avatar( $comment, apply_filters( 'hybopress_comment_gravatar_size', 60 ) );
			hybrid_comment_reply_link();


			printf( '<cite %s>', hybrid_get_attr( 'comment-author' ) );

				echo get_comment_author_link();

			echo '</cite><br />';

			printf( '<time %s>', hybrid_get_attr( 'comment-published' ) );

				printf( __( '%s ago', 'elegant' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) );

			echo '</time>';

			printf( '<a %s>', hybrid_get_attr( 'comment-permalink' ) );

				_e( 'Permalink', 'elegant' );

			echo '</a>';

			edit_comment_link();

		echo '</header><!-- .comment-meta -->';

		printf( '<div class="%s">', 'comment-content' );

if ( '0' == $comment->comment_approved ) {
	printf( '<p class="%s">', 'text-info text-uppercase' );

		printf( '<em class="%s">', 'comment-awaiting-moderation' );

			_e( 'Your comment is awaiting moderation.', 'elegant' );

		echo '</em>';

	echo '</p>';

}

			comment_text();

		echo '<!-- .comment-content -->';

	echo '</article>';

/* No closing </li> is needed.  WordPress will know where to add it. */
