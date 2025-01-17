<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Verdandi
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php _e('Comments', 'verdandi'); ?>
		</h2><!-- .comments-title -->

		<?php
        the_comments_navigation(array(
            'prev_text' =>'<i class="material-icons">< </i><span class="hidden-sm">' . __('Older comments', 'verdandi') . '</span>',
            'next_text' => '<span class="hidden-sm">' . __('Newer comments', 'verdandi') . '</span><i class="material-icons"> ></i>',
        )); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
                    'avatar_size' => 32,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php 
        the_comments_navigation(array(
            'prev_text' =>'<i class="material-icons">< </i><span class="hidden-sm hidden-md">' . __('Older comments', 'verdandi') . '</span>',
            'next_text' => '<span class="hidden-sm hidden-md">' . __('Newer comments', 'verdandi') . '</span><i class="material-icons"> ></i>',
        ));

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'verdandi' ); ?></p>
		<?php
		endif;

	endif; // Check for have_comments().

	comment_form();
	?>

</div><!-- #comments -->
