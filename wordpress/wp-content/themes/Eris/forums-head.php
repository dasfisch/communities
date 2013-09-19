<?php
/**
 * Forums Head
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="forums-head">
	<?php if(bbp_is_forum_archive()):?>
	
		<h1><?php echo get_option('_bbp_forum_archive_heading', 'Forums Header Text');?></h1>
		<p><?php echo get_option('_bbp_forum_archive_subheading', 'Forums Sub-header Text');?></p>
		
	<?php else: ?>
	
		<h1><?php header_breadcrumbs();?></h1>
		
		<?php //For topics (subforums list) page only
			if(has_subforums()): ?>
			
			<p><?php forum_description(); ?></p>
		
		<?php endif;?>
		
	<?php endif;?>
</div>