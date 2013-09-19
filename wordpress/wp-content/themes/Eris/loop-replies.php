<?php

/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_replies_loop' ); ?>

<ul id="topic-<?php bbp_topic_id(); ?>-replies" class="forums bbp-replies">

	<li class="bbp-header">
	
		<div id="replies-top"></div>
		<div class="bbp-reply-content">

				<?php _e( 'Post', 'bbpress' ); ?>

				<?php //bbp_user_subscribe_link(); ?>

				<?php //bbp_user_favorites_link(); ?>

		
		</div><!-- .bbp-reply-content -->

	</li><!-- .bbp-header -->

	<li class="bbp-body">

		<?php while ( bbp_replies() ) : bbp_the_reply(); ?>

			<?php bbp_get_template_part( 'loop', 'single-reply' ); ?>

		<?php endwhile; ?>

	</li><!-- .bbp-body -->

	<li class="bbp-footer">
		<a href="#replies-top">Back to Top &#9650;</a>
	</li><!-- .bbp-footer -->

</ul><!-- #topic-<?php bbp_topic_id(); ?>-replies -->

<?php do_action( 'bbp_template_after_replies_loop' ); ?>