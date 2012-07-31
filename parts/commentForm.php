<?php
    $fields =  array();

    $args = array(
        'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
        'comment_field'        => '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
        'must_log_in'          => null,
        'logged_in_as'         => null,
        'comment_notes_before' => null,
        'comment_notes_after'  => null,
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'title_reply'          => null,
        'title_reply_to'       => __( 'Leave a Reply to %s' ),
        'cancel_reply_link'    => null,
        'label_submit'         => __( 'Post' ),
    );

    $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

    if ( comments_open() ) : ?>
    <div class="commentForm" xmlns="http://www.w3.org/1999/html">
            <div class="top">
                <span class="commentTotal"><?php comments_number( '', '1 comment', '% comments' ); ?></span>
                <span class="leaveComment">Leave a comment <span class="smaller">&#9660;</span></span>
            </div>
            <?php
                if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) :
                    echo $args['must_log_in'];
                    do_action( 'comment_form_must_log_in_after' );
                else : ?>
                    <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
                        <?php
                            do_action( 'comment_form_top' );

                            if ( is_user_logged_in() ) :
                                echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
                            endif;

                            echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
                            echo $args['comment_notes_after'];
                        ?>
                            <p class="form-submit">
                                <button type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" class="<?php echo theme_option("brand"); ?>_button"><?php echo esc_attr( $args['label_submit'] ); ?></button>
                                <button type="submit" class="<?php echo theme_option("brand"); ?>_button azure">Cancel</button>
                                <?php comment_id_fields( $post_id ); ?>
                            </p>
                        <?php do_action( 'comment_form', $post_id ); ?>
                    </form>
                <?php endif; ?>
        </div><!-- #respond -->
    <?php
        do_action( 'comment_form_after' );
    else :
        do_action( 'comment_form_comments_closed' );
    endif;