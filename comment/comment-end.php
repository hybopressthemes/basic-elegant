<?php

global $comment_depth;

echo '</div><!-- .comment-content .comment-text .media-body -->';

$closing_tag = $comment_depth > 1 ? 'div' : 'li';

echo '</' . $closing_tag . '><!-- .comment .media -->';
