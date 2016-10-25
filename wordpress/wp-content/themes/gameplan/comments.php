<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentytwelve_comment() which is
 * located in the functions.php file.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php echo esc_html__('Comments','cactusthemes');?>
		</h3>
        <div class="dotted"></div>

		<ul class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'cactusthemes_comment', 'style' => 'ul' ) ); ?>
		</ul><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php esc_html_e( 'Comment navigation', 'cactusthemes' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'cactusthemes' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'cactusthemes' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>
	<?php endif; // have_comments() ?>
    <?php if ( comments_open() ){?>
    <h3 class="comments-title">
			<?php echo esc_html__('Leave A Comment ','cactusthemes');?>
	</h3>
    <div class="dotted"></div>
    <?php }?>
	<?php comment_form(array('comment_notes_before'=>'','comment_field'=>'<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" onblur="if(this.value == \'\') this.value = \''.esc_html__('Comment','cactusthemes').'\';" onfocus="if(this.value == \''.esc_html__('Comment','cactusthemes').'\') this.value = \'\';">'.esc_html__('Comment','cactusthemes').'</textarea></p>','title_reply'=>'','comment_notes_after'=>'','id_submit'=>'comment-submit')); ?>
</div><!-- #comments .comments-area -->