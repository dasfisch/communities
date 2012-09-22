<?php

    $i = 0;

    $categories = get_the_category( $post->ID );

    $crest_options = array(
        "user_id" => $post->post_author,
        "width"		=> "span2"
    );

    $post_actions = array(
        "post_id"        => $post->ID,
        "type"      => $post->post_type,
        "options"   => array( "follow", "flag", "share" ),
        "url"       => get_permalink( $post->ID ),
        "sub_type"  => $post->post_type,
        'type'      => 'posts',
        'actions'   => $post->actions,
        "url"       => get_permalink( $post->ID )
    );
    $post_date = strtotime( $post->post_date );
?>
<section class="span12">
	<section class="span8">
		<article class="content-container question span12">
			
			<header class="content-header">
					<h3>Question</h3>
			</header>
			
			<section class="content-body clearfix">
				
				<?php get_partial( 'parts/crest', $crest_options ); ?>
				
				<div class="span10">
					
					<div class="content-details clearfix">
					    <?php get_partial( 'parts/space_date_time', array( "timestamp" => $post_date ) ); ?>
					</div>
					
					<h1 class="content-headline"><?php the_title(); ?></h1>
					
					<?php the_content(); ?>	
					<?php get_partial( 'parts/forms/post-n-comment-actions', $post_actions ); ?>
					
				</div> <!-- END SPAN10 -->
				
			</section> <!-- END CONTENT BODY -->

		</article> <!-- END CONTENT CONTAINER QUESTION -->
		
		<?php
      comments_template('/parts/commentForm.php');
      comments_template('/parts/comments.php');
    ?>
		
	</section> <!-- END SPAN 8 -->

	<section class="span4">
		<?php display_dropzone('question-right-rail'); ?>
	</section>

</section>
<?php
    if(is_user_logged_in()) {
?>
        <script type="text/javascript">
            $(document).ready(function() {
                $.each($(".ugc-comment-answer_form form"), function() {
                    if (($(this).get(0)).style.display != 'block') {
                        $(this).addClass('hide');
                    }
                });
                $(".ugc-comment-answer_form a").on('click', function(event) {
                	event.preventDefault();
                	$(this).parents(".ugc-comment-answer_form").children("form").slideToggle("slow");
                });

                // Make the cancel buttons collapse the forms, too.
                $('.ugc-comment-answer_form .azure').on('click', function(event) {
                		event.preventDefault();
                    $(this).parents(".ugc-comment-answer_form").children("form").slideToggle("slow");
                });
            });
        </script>
<?php
    } 
?>
