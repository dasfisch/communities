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
	
		<h2>[Forums logo] Forums Header</h2>
		
	<?php else: ?>
	
	<?php if(bbp_is_topic()) echo 'Is a Topic';?>
	<?php var_dump($_GET);?>
		<h2>Header for Subforums/Topics</h2>
		
	<?php endif;?>
</div>