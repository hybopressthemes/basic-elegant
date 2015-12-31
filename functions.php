<?php

add_action( 'after_setup_theme', 'child_theme_setup_before_parent', 0 );
add_action( 'after_setup_theme', 'child_theme_setup1', 11 );
add_action( 'after_setup_theme', 'child_theme_setup2', 14 );
add_filter( 'hybopress_posts_pagination_args', 'child_theme_posts_pagination_args' );
add_filter( 'hybopress_hide_page_background', 'child_theme_hide_page_background', 11 );

function child_theme_setup_before_parent() {
}

function child_theme_setup1() {

	// Register site styles and scripts
	add_action( 'wp_enqueue_scripts', 'child_theme_register_styles' );

	// Enqueue site styles and scripts
	add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles' );

	add_filter( 'hybopress_menu_caret', 'child_theme_menu_caret' );
}

function child_theme_setup2() {

	add_filter( 'hybopress_use_cache', 'child_theme_use_cache' );
	remove_action( 'hybopress_post_info_comments', 'hybopress_do_post_info_comments' );

	add_action( 'hybopress_post_info_comments', 'child_theme_do_post_info_comments' );

	remove_action( 'comment_form_defaults', 'hybopress_override_comment_form_defaults' );
	add_action( 'comment_form_defaults', 'child_theme_override_comment_form_defaults' );

}

function child_theme_register_styles() {

	wp_register_style( 'child-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,700|Raleway:400,700' );

	$main_styles = trailingslashit( HYBRID_CHILD_URI ) . "assets/css/child-style.css";

	wp_register_style(
		sanitize_key(  'child-style' ), esc_url( $main_styles ), array( 'skin' ), PARENT_THEME_VERSION, esc_attr( 'all' )
	);

}

function child_theme_enqueue_styles() {
	wp_enqueue_style( 'child-fonts' );
	wp_enqueue_style( 'child-style' );
}

function child_theme_hide_page_background( $show_hide ) {
	return false;
}

function child_theme_posts_pagination_args( $args ) {

		$args['prev_text'] = __( '&laquo;', 'elegant' );
		$args['next_text'] = __( '&raquo;', 'elegant' );

		return $args;

}

function child_theme_use_cache( $use_cache ) {
	return true;
}

function child_theme_menu_caret( $caret ) {
	return '';
}

function child_theme_do_post_info_comments() {

	if ( get_theme_mod( 'disable_comments_meta', 0 ) ) {
		return;
	}

	comments_popup_link( false, false, false, 'comments-link' );
}


function child_theme_override_comment_form_defaults( $defaults ) {

	$defaults['class_submit'] = $defaults['class_submit'] . ' btn btn-primary';

	foreach ( $defaults['fields'] as $key => $field ) {
		$defaults['fields'][$key] = child_theme_make_comment_field_horizontal( $field );
	}

	$defaults['comment_field']        = child_theme_make_comment_field_horizontal( $defaults['comment_field'] );
	$defaults['logged_in_as']         = hybopress_make_comment_notes_help_block( $defaults['logged_in_as'] );
	$defaults['comment_notes_before'] = hybopress_make_comment_notes_help_block( $defaults['comment_notes_before'] );
	$defaults['comment_notes_after']  = hybopress_make_comment_notes_help_block( $defaults['comment_notes_after'] );

	return $defaults;

}


/**
* Rewrite markup to strip paragraph and wrap in horizontal form block markup.
*
* @param string $field
*
* @return string
*/

function child_theme_make_comment_field_horizontal( $field ) {

	$field = preg_replace( '|<p class="(.*?)">|', '<div class="$1 form-group">', $field );

	$field =
	strtr(
		$field,
		array(
			'<label'    => '<label class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left comment-label"', //control-label
			'<input'    => '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 comment-field"><input class="form-control"',
			'<textarea' => '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 comment-field"><textarea cols="45" rows="8" class="form-control"',
			'</p>'      => '</div>',
		)
	);

	$field .= '</div>';

	return $field;

}
