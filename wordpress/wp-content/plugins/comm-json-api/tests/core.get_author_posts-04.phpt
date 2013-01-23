--TEST--
core.get_author_posts by author_id
--FILE--
<?php

require_once 'HTTP/Client.php';
$http = new HTTP_Client();
$http->get('http://wordpress.test/?json=core.get_author_posts&author_id=3');
$response = $http->currentResponse();
echo $response['body'];

?>
--EXPECT--
{"status":"ok","count":10,"pages":3,"author":{"id":3,"slug":"chip-bennett","name":"Chip Bennett","first_name":"","last_name":"","nickname":"Chip Bennett","url":"","description":""},"posts":[{"id":358,"type":"post","slug":"readability-test","url":"http:\/\/wordpress.test\/2008\/09\/05\/readability-test\/","status":"publish","title":"Readability Test","title_plain":"Readability Test","content":"<p>All children, except one, grow up. They soon know that they will grow up, and the way Wendy knew was this. One day when she was two years old she was playing in a garden, and she plucked another flower and ran with it to her mother. I suppose she must have looked rather delightful, for Mrs. Darling put her hand to her heart and cried, &#8220;Oh, why can&#8217;t you remain like this for ever!&#8221; This was all that passed between them on the subject, but henceforth Wendy knew that she must grow up. You always know after you are two. Two is the beginning of the end.<\/p>\n<p> <a href=\"http:\/\/wordpress.test\/2008\/09\/05\/readability-test\/#more-358\" class=\"more-link\">Read more<\/a><\/p>\n","excerpt":"All children, except one, grow up. They soon know that they will grow up, and the way Wendy knew was this. One day when she was two years old she was playing in a garden, and she plucked another flower &hellip; <a href=\"http:\/\/wordpress.test\/2008\/09\/05\/readability-test\/\">Continue reading <span class=\"meta-nav\">&rarr;<\/span><\/a>","date":"2008-09-05 00:27:25","modified":"2008-09-05 00:27:25","categories":[{"id":9,"slug":"cat-a","title":"Cat A","description":"","parent":0,"post_count":2}],"tags":[{"id":53,"slug":"chattels","title":"chattels","description":"","post_count":2},{"id":82,"slug":"privation","title":"privation","description":"","post_count":2}],"author":{"id":3,"slug":"chip-bennett","name":"Chip Bennett","first_name":"","last_name":"","nickname":"Chip Bennett","url":"","description":""},"comments":[],"attachments":[],"comment_count":0,"comment_status":"closed"},{"id":188,"type":"post","slug":"layout-test","url":"http:\/\/wordpress.test\/2008\/09\/04\/layout-test\/","status":"publish","title":"Layout Test","title_plain":"Layout Test","content":"<p>This is a sticky post!!! Make sure it sticks!<\/p>\n<p>This should then split into other pages with layout, images, HTML tags, and other things.<\/p>\n","excerpt":"This is a sticky post!!! Make sure it sticks! This should then split into other pages with layout, images, HTML tags, and other things.","date":"2008-09-04 23:02:20","modified":"2008-09-04 23:02:20","categories":[{"id":3,"slug":"aciform","title":"aciform","description":"","parent":0,"post_count":2},{"id":9,"slug":"cat-a","title":"Cat A","description":"","parent":0,"post_count":2},{"id":10,"slug":"cat-b","title":"Cat B","description":"","parent":0,"post_count":1},{"id":11,"slug":"cat-c","title":"Cat C","description":"","parent":0,"post_count":1},{"id":41,"slug":"sub","title":"sub","description":"","parent":3,"post_count":1}],"tags":[{"id":93,"slug":"tag1","title":"tag1","description":"","post_count":1},{"id":94,"slug":"tag2","title":"tag2","description":"","post_count":1},{"id":95,"slug":"tag3","title":"tag3","description":"","post_count":1}],"author":{"id":3,"slug":"chip-bennett","name":"Chip Bennett","first_name":"","last_name":"","nickname":"Chip Bennett","url":"","description":""},"comments":[],"attachments":[],"comment_count":0,"comment_status":"closed"},{"id":128,"type":"post","slug":"images-test","url":"http:\/\/wordpress.test\/2008\/09\/03\/images-test\/","status":"publish","title":"Images Test","title_plain":"Images Test","content":"<h2>Image Alignment Tests: Un-Captioned Images<\/h2>\n<h3 id=\"center-align-no-caption\">Center-align, no caption<\/h3>\n<p>Center-aligned image with no caption, and text before and after. <img src=\"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-landscape1.jpg\" alt=\"\" title=\"test-image-landscape\" width=\"300\" height=\"199\" class=\"aligncenter size-full wp-image-535\" \/> ALorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed odio nibh, tincidunt adipiscing, pretium nec, tincidunt id, enim. Fusce scelerisque nunc vitae nisl. Quisque quis urna in velit dictum pellentesque. Vivamus a quam. Curabitur eu tortor id turpis tristique adipiscing. Morbi blandit. Maecenas vel est. Nunc aliquam, orci at accumsan commodo, libero nibh euismod augue, a ullamcorper velit dui et purus. Aenean volutpat, ipsum ac imperdiet fermentum, dui dui suscipit arcu, vitae dictum purus diam ac ligula.<\/p>\n<h3 id=\"left-align-no-caption\">Left-align, no caption<\/h3>\n<p>Left-aligned image with no caption, and text before and after. <img src=\"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-landscape1.jpg\" alt=\"\" title=\"test-image-landscape\" width=\"300\" height=\"199\" class=\"alignleft size-full wp-image-535\" \/> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed odio nibh, tincidunt adipiscing, pretium nec, tincidunt id, enim. Fusce scelerisque nunc vitae nisl. Quisque quis urna in velit dictum pellentesque. Vivamus a quam. Curabitur eu tortor id turpis tristique adipiscing. Morbi blandit. Maecenas vel est. Nunc aliquam, orci at accumsan commodo, libero nibh euismod augue, a ullamcorper velit dui et purus. Aenean volutpat, ipsum ac imperdiet fermentum, dui dui suscipit arcu, vitae dictum purus diam ac ligula.<\/p>\n<h3 id=\"right-align-no-caption\">Right-align, no caption<\/h3>\n<p>Right-aligned image with no caption, and text before and after. <img src=\"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-landscape1.jpg\" alt=\"\" title=\"test-image-landscape\" width=\"300\" height=\"199\" class=\"alignright size-full wp-image-535\" \/> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed odio nibh, tincidunt adipiscing, pretium nec, tincidunt id, enim. Fusce scelerisque nunc vitae nisl. Quisque quis urna in velit dictum pellentesque. Vivamus a quam. Curabitur eu tortor id turpis tristique adipiscing. Morbi blandit. Maecenas vel est. Nunc aliquam, orci at accumsan commodo, libero nibh euismod augue, a ullamcorper velit dui et purus. Aenean volutpat, ipsum ac imperdiet fermentum, dui dui suscipit arcu, vitae dictum purus diam ac ligula.<\/p>\n<h3 id=\"no-alignment-no-caption\">No alignment, no caption<\/h3>\n<p>None-aligned image with no caption, and text before and after. <img src=\"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-landscape1.jpg\" alt=\"\" title=\"test-image-landscape\" width=\"300\" height=\"199\" class=\"alignnone size-full wp-image-535\" \/> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed odio nibh, tincidunt adipiscing, pretium nec, tincidunt id, enim. Fusce scelerisque nunc vitae nisl. Quisque quis urna in velit dictum pellentesque. Vivamus a quam. Curabitur eu tortor id turpis tristique adipiscing. Morbi blandit. Maecenas vel est. Nunc aliquam, orci at accumsan commodo, libero nibh euismod augue, a ullamcorper velit dui et purus. Aenean volutpat, ipsum ac imperdiet fermentum, dui dui suscipit arcu, vitae dictum purus diam ac ligula.<\/p>\n","excerpt":"Image Alignment Tests: Un-Captioned Images Center-align, no caption Center-aligned image with no caption, and text before and after. ALorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed odio nibh, tincidunt adipiscing, pretium nec, tincidunt id, enim. Fusce scelerisque nunc vitae &hellip; <a href=\"http:\/\/wordpress.test\/2008\/09\/03\/images-test\/\">Continue reading <span class=\"meta-nav\">&rarr;<\/span><\/a>","date":"2008-09-03 09:35:23","modified":"2008-09-03 09:35:23","categories":[],"tags":[],"author":{"id":3,"slug":"chip-bennett","name":"Chip Bennett","first_name":"","last_name":"","nickname":"Chip Bennett","url":"","description":""},"comments":[],"attachments":[{"id":534,"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-landscape-9001.jpg","slug":"test-image-landscape-900","title":"test-image-landscape-900","description":"","caption":"","parent":128,"mime_type":"image\/jpeg","images":{"full":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-landscape-9001.jpg","width":900,"height":598},"thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-landscape-9001.jpg","width":150,"height":99},"medium":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-landscape-9001.jpg","width":300,"height":199},"large":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-landscape-9001.jpg","width":640,"height":425},"post-thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-landscape-9001.jpg","width":297,"height":198}}},{"id":535,"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-landscape1.jpg","slug":"test-image-landscape","title":"test-image-landscape","description":"","caption":"","parent":128,"mime_type":"image\/jpeg","images":{"full":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-landscape1.jpg","width":300,"height":199},"thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-landscape1.jpg","width":150,"height":99},"medium":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-landscape1.jpg","width":300,"height":199},"large":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-landscape1.jpg","width":300,"height":199},"post-thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-landscape1.jpg","width":298,"height":198}}},{"id":536,"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-portrait1.jpg","slug":"test-image-portrait","title":"test-image-portrait","description":"","caption":"","parent":128,"mime_type":"image\/jpeg","images":{"full":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-portrait1.jpg","width":199,"height":300},"thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-portrait1.jpg","width":99,"height":150},"medium":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-portrait1.jpg","width":199,"height":300},"large":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-portrait1.jpg","width":199,"height":300},"post-thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/test-image-portrait1.jpg","width":131,"height":198}}},{"id":543,"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/spectacles1.gif","slug":"spectacles","title":"spectacles","description":"","caption":"","parent":128,"mime_type":"image\/gif","images":{"full":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/spectacles1.gif","width":165,"height":210},"thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/spectacles1.gif","width":117,"height":150},"medium":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/spectacles1.gif","width":165,"height":210},"large":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/spectacles1.gif","width":165,"height":210},"post-thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/spectacles1.gif","width":155,"height":198}}},{"id":544,"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/boat1.jpg","slug":"boat","title":"boat","description":"","caption":"A picture is worth a thousand words","parent":128,"mime_type":"image\/jpeg","images":{"full":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/boat1.jpg","width":435,"height":288},"thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/boat1.jpg","width":150,"height":99},"medium":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/boat1.jpg","width":300,"height":198},"large":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/boat1.jpg","width":435,"height":288},"post-thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2010\/08\/boat1.jpg","width":299,"height":198}}}],"comment_count":0,"comment_status":"closed"},{"id":555,"type":"post","slug":"post-format-test-gallery","url":"http:\/\/wordpress.test\/2008\/06\/10\/post-format-test-gallery\/","status":"publish","title":"Post Format Test: Gallery","title_plain":"Post Format Test: Gallery","content":"\n\t\t<div id='gallery-1' class='gallery galleryid-555 gallery-columns-3 gallery-size-thumbnail'><dl class='gallery-item'>\n\t\t\t<dt class='gallery-icon'>\n\t\t\t\t<a href='http:\/\/wordpress.test\/2008\/06\/10\/post-format-test-gallery\/canola2\/' title='canola2'><img width=\"150\" height=\"112\" src=\"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/canola21.jpg\" class=\"attachment-thumbnail\" alt=\"canola\" title=\"canola2\" \/><\/a>\n\t\t\t<\/dt><\/dl><dl class='gallery-item'>\n\t\t\t<dt class='gallery-icon'>\n\t\t\t\t<a href='http:\/\/wordpress.test\/2008\/06\/10\/post-format-test-gallery\/dsc20040724_152504_532\/' title='dsc20040724_152504_532'><img width=\"150\" height=\"112\" src=\"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20040724_152504_5321.jpg\" class=\"attachment-thumbnail\" alt=\"chunk of resinous blackboy husk\" title=\"dsc20040724_152504_532\" \/><\/a>\n\t\t\t<\/dt>\n\t\t\t\t<dd class='wp-caption-text gallery-caption'>\n\t\t\t\tChunk of resinous blackboy husk, Clarkson, Western Australia. This burns like a spinifex log.\n\t\t\t\t<\/dd><\/dl><dl class='gallery-item'>\n\t\t\t<dt class='gallery-icon'>\n\t\t\t\t<a href='http:\/\/wordpress.test\/2008\/06\/10\/post-format-test-gallery\/dsc20050315_145007_132\/' title='dsc20050315_145007_132'><img width=\"150\" height=\"112\" src=\"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050315_145007_1321.jpg\" class=\"attachment-thumbnail\" alt=\"dsc20050315_145007_132\" title=\"dsc20050315_145007_132\" \/><\/a>\n\t\t\t<\/dt><\/dl><br style=\"clear: both\" \/><dl class='gallery-item'>\n\t\t\t<dt class='gallery-icon'>\n\t\t\t\t<a href='http:\/\/wordpress.test\/2008\/06\/10\/post-format-test-gallery\/dsc20050604_133440_3421\/' title='dsc20050604_133440_3421'><img width=\"150\" height=\"112\" src=\"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050604_133440_34211.jpg\" class=\"attachment-thumbnail\" alt=\"dsc20050604_133440_3421\" title=\"dsc20050604_133440_3421\" \/><\/a>\n\t\t\t<\/dt><\/dl><dl class='gallery-item'>\n\t\t\t<dt class='gallery-icon'>\n\t\t\t\t<a href='http:\/\/wordpress.test\/2008\/06\/10\/post-format-test-gallery\/dsc20050727_091048_222\/' title='dsc20050727_091048_222'><img width=\"150\" height=\"112\" src=\"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050727_091048_2221.jpg\" class=\"attachment-thumbnail\" alt=\"dsc20050727_091048_222\" title=\"dsc20050727_091048_222\" \/><\/a>\n\t\t\t<\/dt><\/dl><dl class='gallery-item'>\n\t\t\t<dt class='gallery-icon'>\n\t\t\t\t<a href='http:\/\/wordpress.test\/2008\/06\/10\/post-format-test-gallery\/dsc20050813_115856_52\/' title='dsc20050813_115856_52'><img width=\"150\" height=\"112\" src=\"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050813_115856_521.jpg\" class=\"attachment-thumbnail\" alt=\"dsc20050813_115856_52\" title=\"dsc20050813_115856_52\" \/><\/a>\n\t\t\t<\/dt><\/dl><br style=\"clear: both\" \/><dl class='gallery-item'>\n\t\t\t<dt class='gallery-icon'>\n\t\t\t\t<a href='http:\/\/wordpress.test\/2008\/06\/10\/post-format-test-gallery\/dsc20050831_165238_332\/' title='dsc20050831_165238_332'><img width=\"150\" height=\"112\" src=\"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050831_165238_3321.jpg\" class=\"attachment-thumbnail\" alt=\"dsc20050831_165238_332\" title=\"dsc20050831_165238_332\" \/><\/a>\n\t\t\t<\/dt><\/dl><dl class='gallery-item'>\n\t\t\t<dt class='gallery-icon'>\n\t\t\t\t<a href='http:\/\/wordpress.test\/2008\/06\/10\/post-format-test-gallery\/dsc20050901_105100_212\/' title='dsc20050901_105100_212'><img width=\"150\" height=\"112\" src=\"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050901_105100_2121.jpg\" class=\"attachment-thumbnail\" alt=\"Seed pods on stem, Woodvale\" title=\"dsc20050901_105100_212\" \/><\/a>\n\t\t\t<\/dt>\n\t\t\t\t<dd class='wp-caption-text gallery-caption'>\n\t\t\t\tSeed pods on stem, Woodvale\n\t\t\t\t<\/dd><\/dl>\n\t\t\t<br style='clear: both;' \/>\n\t\t<\/div>\n\n","excerpt":"","date":"2008-06-10 07:24:14","modified":"2008-06-10 07:24:14","categories":[],"tags":[{"id":80,"slug":"post-formats","title":"Post Formats","description":"","post_count":10}],"author":{"id":3,"slug":"chip-bennett","name":"Chip Bennett","first_name":"","last_name":"","nickname":"Chip Bennett","url":"","description":""},"comments":[],"attachments":[{"id":611,"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/canola21.jpg","slug":"canola2","title":"canola2","description":"","caption":"","parent":555,"mime_type":"image\/jpeg","images":{"full":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/canola21.jpg","width":640,"height":480},"thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/canola21.jpg","width":150,"height":112},"medium":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/canola21.jpg","width":300,"height":225},"large":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/canola21.jpg","width":640,"height":480},"post-thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/canola21.jpg","width":264,"height":198}}},{"id":612,"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20040724_152504_5321.jpg","slug":"dsc20040724_152504_532","title":"dsc20040724_152504_532","description":"","caption":"Chunk of resinous blackboy husk, Clarkson, Western Australia. This burns like a spinifex log.","parent":555,"mime_type":"image\/jpeg","images":{"full":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20040724_152504_5321.jpg","width":640,"height":480},"thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20040724_152504_5321.jpg","width":150,"height":112},"medium":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20040724_152504_5321.jpg","width":300,"height":225},"large":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20040724_152504_5321.jpg","width":640,"height":480},"post-thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20040724_152504_5321.jpg","width":264,"height":198}}},{"id":613,"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050315_145007_1321.jpg","slug":"dsc20050315_145007_132","title":"dsc20050315_145007_132","description":"","caption":"","parent":555,"mime_type":"image\/jpeg","images":{"full":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050315_145007_1321.jpg","width":640,"height":480},"thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050315_145007_1321.jpg","width":150,"height":112},"medium":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050315_145007_1321.jpg","width":300,"height":225},"large":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050315_145007_1321.jpg","width":640,"height":480},"post-thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050315_145007_1321.jpg","width":264,"height":198}}},{"id":615,"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050604_133440_34211.jpg","slug":"dsc20050604_133440_3421","title":"dsc20050604_133440_3421","description":"","caption":"","parent":555,"mime_type":"image\/jpeg","images":{"full":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050604_133440_34211.jpg","width":640,"height":480},"thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050604_133440_34211.jpg","width":150,"height":112},"medium":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050604_133440_34211.jpg","width":300,"height":225},"large":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050604_133440_34211.jpg","width":640,"height":480},"post-thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050604_133440_34211.jpg","width":264,"height":198}}},{"id":616,"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050727_091048_2221.jpg","slug":"dsc20050727_091048_222","title":"dsc20050727_091048_222","description":"","caption":"","parent":555,"mime_type":"image\/jpeg","images":{"full":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050727_091048_2221.jpg","width":640,"height":480},"thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050727_091048_2221.jpg","width":150,"height":112},"medium":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050727_091048_2221.jpg","width":300,"height":225},"large":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050727_091048_2221.jpg","width":640,"height":480},"post-thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050727_091048_2221.jpg","width":264,"height":198}}},{"id":617,"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050813_115856_521.jpg","slug":"dsc20050813_115856_52","title":"dsc20050813_115856_52","description":"","caption":"","parent":555,"mime_type":"image\/jpeg","images":{"full":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050813_115856_521.jpg","width":640,"height":480},"thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050813_115856_521.jpg","width":150,"height":112},"medium":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050813_115856_521.jpg","width":300,"height":225},"large":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050813_115856_521.jpg","width":640,"height":480},"post-thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050813_115856_521.jpg","width":264,"height":198}}},{"id":618,"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050831_165238_3321.jpg","slug":"dsc20050831_165238_332","title":"dsc20050831_165238_332","description":"","caption":"","parent":555,"mime_type":"image\/jpeg","images":{"full":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050831_165238_3321.jpg","width":640,"height":480},"thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050831_165238_3321.jpg","width":150,"height":112},"medium":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050831_165238_3321.jpg","width":300,"height":225},"large":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050831_165238_3321.jpg","width":640,"height":480},"post-thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050831_165238_3321.jpg","width":264,"height":198}}},{"id":619,"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050901_105100_2121.jpg","slug":"dsc20050901_105100_212","title":"dsc20050901_105100_212","description":"","caption":"Seed pods on stem, Woodvale","parent":555,"mime_type":"image\/jpeg","images":{"full":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050901_105100_2121.jpg","width":640,"height":480},"thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050901_105100_2121.jpg","width":150,"height":112},"medium":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050901_105100_2121.jpg","width":300,"height":225},"large":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050901_105100_2121.jpg","width":640,"height":480},"post-thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20050901_105100_2121.jpg","width":264,"height":198}}}],"comment_count":0,"comment_status":"closed"},{"id":559,"type":"post","slug":"post-format-test-aside","url":"http:\/\/wordpress.test\/2008\/06\/09\/post-format-test-aside\/","status":"publish","title":"Post Format Test: Aside","title_plain":"Post Format Test: Aside","content":"<p>\u201cI never tried to prove nothing, just wanted to give a good show. My life has always been my music, it&#8217;s always come first, but the music ain&#8217;t worth nothing if you can&#8217;t lay it on the public. The main thing is to live for that audience, &#8217;cause what you&#8217;re there for is to please the people.\u201d<\/p>\n","excerpt":"\u201cI never tried to prove nothing, just wanted to give a good show. My life has always been my music, it&#8217;s always come first, but the music ain&#8217;t worth nothing if you can&#8217;t lay it on the public. The main &hellip; <a href=\"http:\/\/wordpress.test\/2008\/06\/09\/post-format-test-aside\/\">Continue reading <span class=\"meta-nav\">&rarr;<\/span><\/a>","date":"2008-06-09 07:51:54","modified":"2008-06-09 07:51:54","categories":[],"tags":[{"id":80,"slug":"post-formats","title":"Post Formats","description":"","post_count":10}],"author":{"id":3,"slug":"chip-bennett","name":"Chip Bennett","first_name":"","last_name":"","nickname":"Chip Bennett","url":"","description":""},"comments":[],"attachments":[],"comment_count":0,"comment_status":"closed"},{"id":562,"type":"post","slug":"post-format-test-chat","url":"http:\/\/wordpress.test\/2008\/06\/08\/post-format-test-chat\/","status":"publish","title":"Post Format Test: Chat","title_plain":"Post Format Test: Chat","content":"<p>John: foo<br \/>\nMary: bar<br \/>\nJohn: foo 2<\/p>\n","excerpt":"John: foo Mary: bar John: foo 2","date":"2008-06-08 07:59:31","modified":"2008-06-08 07:59:31","categories":[],"tags":[{"id":80,"slug":"post-formats","title":"Post Formats","description":"","post_count":10}],"author":{"id":3,"slug":"chip-bennett","name":"Chip Bennett","first_name":"","last_name":"","nickname":"Chip Bennett","url":"","description":""},"comments":[],"attachments":[],"comment_count":0,"comment_status":"closed"},{"id":565,"type":"post","slug":"post-format-test-link","url":"http:\/\/wordpress.test\/2008\/06\/07\/post-format-test-link\/","status":"publish","title":"Post Format Test: Link","title_plain":"Post Format Test: Link","content":"<p><a href=\"http:\/\/make.wordpress.org\/themes\" title=\"The WordPress Theme Review Team Website\">The WordPress Theme Review Team Website<\/a><\/p>\n","excerpt":"The WordPress Theme Review Team Website","date":"2008-06-07 08:06:53","modified":"2008-06-07 08:06:53","categories":[],"tags":[{"id":80,"slug":"post-formats","title":"Post Formats","description":"","post_count":10}],"author":{"id":3,"slug":"chip-bennett","name":"Chip Bennett","first_name":"","last_name":"","nickname":"Chip Bennett","url":"","description":""},"comments":[],"attachments":[],"comment_count":0,"comment_status":"closed"},{"id":674,"type":"post","slug":"post-format-test-image-attached","url":"http:\/\/wordpress.test\/2008\/06\/06\/post-format-test-image-attached\/","status":"publish","title":"Post Format Test: Image (Attached)","title_plain":"Post Format Test: Image (Attached)","content":"<div id=\"attachment_675\" class=\"wp-caption aligncenter\" style=\"width: 445px\"><a href=\"http:\/\/wpthemetestdata.wordpress.com\/2008\/06\/06\/post-format-test-image-attached\/boat-2\/\" rel=\"attachment wp-att-675\"><img src=\"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/boat1.jpg\" alt=\"boat\" title=\"boat\" width=\"435\" height=\"288\" class=\"size-full wp-image-675\" \/><\/a><p class=\"wp-caption-text\">A picture is worth a thousand words<\/p><\/div>\n","excerpt":"","date":"2008-06-06 09:42:19","modified":"2008-06-06 09:42:19","categories":[],"tags":[{"id":80,"slug":"post-formats","title":"Post Formats","description":"","post_count":10}],"author":{"id":3,"slug":"chip-bennett","name":"Chip Bennett","first_name":"","last_name":"","nickname":"Chip Bennett","url":"","description":""},"comments":[],"attachments":[{"id":675,"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/boat1.jpg","slug":"boat-2","title":"boat","description":"","caption":"A picture is worth a thousand words","parent":674,"mime_type":"image\/jpeg","images":{"full":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/boat1.jpg","width":435,"height":288},"thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/boat1.jpg","width":150,"height":99},"medium":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/boat1.jpg","width":300,"height":198},"large":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/boat1.jpg","width":435,"height":288},"post-thumbnail":{"url":"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/boat1.jpg","width":299,"height":198}}}],"comment_count":0,"comment_status":"closed"},{"id":568,"type":"post","slug":"post-format-test-image-linked","url":"http:\/\/wordpress.test\/2008\/06\/06\/post-format-test-image-linked\/","status":"publish","title":"Post Format Test: Image (Linked)","title_plain":"Post Format Test: Image (Linked)","content":"<div id=\"attachment_612\" class=\"wp-caption aligncenter\" style=\"width: 650px\"><a href=\"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20040724_152504_5321.jpg\"><img src=\"http:\/\/wordpress.test\/wp-content\/uploads\/2011\/01\/dsc20040724_152504_5321.jpg\" alt=\"chunk of resinous blackboy husk\" title=\"dsc20040724_152504_532\" width=\"640\" height=\"480\" class=\"size-full wp-image-612\" \/><\/a><p class=\"wp-caption-text\">Chunk of resinous blackboy husk, Clarkson, Western Australia. This burns like a spinifex log.<\/p><\/div>\n","excerpt":"","date":"2008-06-06 08:09:39","modified":"2008-06-06 08:09:39","categories":[],"tags":[{"id":80,"slug":"post-formats","title":"Post Formats","description":"","post_count":10}],"author":{"id":3,"slug":"chip-bennett","name":"Chip Bennett","first_name":"","last_name":"","nickname":"Chip Bennett","url":"","description":""},"comments":[],"attachments":[],"comment_count":0,"comment_status":"closed"},{"id":575,"type":"post","slug":"post-format-test-quote","url":"http:\/\/wordpress.test\/2008\/06\/05\/post-format-test-quote\/","status":"publish","title":"Post Format Test: Quote","title_plain":"Post Format Test: Quote","content":"<blockquote><p>Only one thing is impossible for God: To find any sense in any copyright law on the planet.<br \/>\n<cite><a href=\"http:\/\/www.brainyquote.com\/quotes\/quotes\/m\/marktwain163473.html\">Mark Twain<\/a><\/cite><\/p><\/blockquote>\n","excerpt":"Only one thing is impossible for God: To find any sense in any copyright law on the planet. Mark Twain","date":"2008-06-05 08:13:15","modified":"2008-06-05 08:13:15","categories":[],"tags":[{"id":80,"slug":"post-formats","title":"Post Formats","description":"","post_count":10}],"author":{"id":3,"slug":"chip-bennett","name":"Chip Bennett","first_name":"","last_name":"","nickname":"Chip Bennett","url":"","description":""},"comments":[],"attachments":[],"comment_count":0,"comment_status":"closed"}]}