<?php 
/*************************************
 * Content, Class, and Query Filters *
 *************************************/

/**
 * Do not call this function directly, add it to the wp_nav_menu filter
 * Adds .first-menu-item and .last-menu-item to menu.
 * 
 * @param type $output
 * @return type 
 */
function add_menu_class_first_last($output) {
  $output = preg_replace('/class="menu-item/', 'class="first-menu-item menu-item', $output, 1);
  //$output = substr_replace($output, 'class="last-menu-item menu-item last-child', strripos($output, 'class="menu-item'), strlen('class="menu-item'));
  return $output;
}
add_filter('wp_nav_menu', 'add_menu_class_first_last');

/**
 * Do not call this function directly, add it to the body_class filter
 * 
 * Conditionally adds classes to the body class of a page for styling purposes.
 * These examples are from the Kmart Fashion and BirthdayClub themes.
 * 
 * @author Eddie Moya
 * 
 * @param type $classes
 * @return array 
 */
function filter_body_class($classes) {
    
    /**
     * Modify Styles pages on theme options. This example is from Kmart Fashion
     */
    $options = get_option('theme_options');
    
    if(isset($options['brand'])){
        $classes[] = $options['brand'];
    }
    
    if (is_category())
        $classes[] = get_queried_object()->category_nicename;
    
    if (is_page())
        $classes[] = 'page-' .get_queried_object()->post_name;

     if ('section' == get_post_type())
        $classes[] = 'section';

    if(get_query_var('old_post_type')){
        $classes[] = 'archive_' . get_query_var('old_post_type').'s';
    }

    if(isset($_GET['s'])){
        $classes[] = 'search-results';
    }
    
    return $classes;
}
add_filter('body_class', 'filter_body_class');



/**
 * Do not call this function directly, add it to the request filter
 * 
 * Modifies the original WP_Query so that we dont have to continuously re-query 
 * with query_posts from within templates. 
 * 
 * Consider also the 'pre_get_posts', and 'parse_query' filters. As well as
 * other query filters explained in the WP_Query codex page.
 * 
 * @author Eddie Moya
 * 
 * @global WP_Query $wp_query
 * @param WP_Query $query_string
 * @return modified WP_Query object
 */
function custom_primary_query($query = '') {

    /**
     * This is being used for the results list widget.
     */
    if(isset($query->query_vars['is_widget']) && isset($_REQUEST['widget'])){
        if ($query->query_vars['is_widget']['widget_name']== 'results-list' && $_REQUEST['widget'] == 'results-list') {

            $category = (isset($_REQUEST['filter-sub-category'])) ? $_REQUEST['filter-sub-category'] : $_REQUEST['filter-category'];

            unset($query->query_vars['cat']);
            $query->set('cat', $category);
            $query->set('category__in', array($category));
        }
    }

    // if(!empty($query->query_vars['category_name']) && !empty($query->query_vars['post_type']) ){
    //     $query->is_category = false;
    // }
    //return $query;
}
add_action('pre_get_posts', 'custom_primary_query');



/******************************************
 * END  Content, Class, and Query Filters *
 ******************************************/
add_filter( 'widget_form_callback', 'widget_form_extend', 10, 2);
add_filter( 'dynamic_sidebar_params', 'dynamic_sidebar_params' );
add_filter( 'widget_update_callback', 'widget_update', 10, 2 );



function widget_form_extend( $instance, $widget ) {

    if(get_class($widget) == 'WP_Widget_Links'){

        if(!isset($instance['classes'])){
            $instance['classes'] = null;
            $row = '';
            $row .= "<p>\n";
            $row .= "\t<label for='widget-{$widget->id_base}-{$widget->number}-sub-title'>Sub Title:</label>\n";
            if(isset($instance['sub-title'])){
                $row .= "\t<input type='text' name='widget-{$widget->id_base}[{$widget->number}][sub-title]' id='widget-{$widget->id_base}-{$widget->number}-sub-title' class='widefat' value='{$instance['sub-title']}'/>\n";
            }
            $row .= "</p>\n";

            echo $row;
        }
    }
    return $instance;
}





function dynamic_sidebar_params( $params ) {
    global $wp_registered_widgets;
    $widget_id  = $params[0]['widget_id'];
    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number'];

    $opts = $widget_opt[$widget_num];
    
    //Links Widget (built-in)
    if($widget_obj['name'] == 'Links'){
        $params[0]['after_title'] = 
        "\n\t<h4>".$opts['sub-title']
        ."</h4>".$params[0]['after_title']
        ."\n\t<section class='content-body clearfix'>";

        $params[0]['after_widget'] = 
            '</section>'
            .$params[0]['after_widget'];    
    }
    return $params;
}



function widget_update( $instance, $new_instance ) {
    $instance['sub-title'] = $new_instance['sub-title'];
    return $instance;
}






/**
 * Allows periods to be passed as part of a user slug.
 *
 * @author Eddie Moya, Dan Crimmins
 */
function sanitize_title_with_dots_and_dashes($title, $raw_title = '', $context = 'display') {
    $title = strip_tags($title);
    // Preserve escaped octets.
    $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
    // Remove percent signs that are not part of an octet.
    $title = str_replace('%', '', $title);
    // Restore octets.
    $title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);

    if (seems_utf8($title)) {
        if (function_exists('mb_strtolower')) {
            $title = mb_strtolower($title, 'UTF-8');
        }   
        $title = utf8_uri_encode($title, 200);
    }

    $title = strtolower($title);
    $title = preg_replace('/&.+?;/', '', $title); // kill entities
    
    //Removed this because it was causing 404 on profile page for authors
    //with a . in their screen name
    
    /*if( 'query' == $context ){ 
        $title = str_replace('.', '-', $title); 
    }*/

    if ( 'save' == $context ) {
        // nbsp, ndash and mdash
        $title = str_replace( array( '%c2%a0', '%e2%80%93', '%e2%80%94' ), '-', $title );
        // iexcl and iquest
        $title = str_replace( array( '%c2%a1', '%c2%bf' ), '', $title );
        // angle quotes
        $title = str_replace( array( '%c2%ab', '%c2%bb', '%e2%80%b9', '%e2%80%ba' ), '', $title );
        // curly quotes
        $title = str_replace( array( '%e2%80%98', '%e2%80%99', '%e2%80%9c', '%e2%80%9d' ), '', $title );
        // copy, reg, deg, hellip and trade
        $title = str_replace( array( '%c2%a9', '%c2%ae', '%c2%b0', '%e2%80%a6', '%e2%84%a2' ), '', $title );
    }

    $title = preg_replace( ( 'query' == $context ) ? '/[^%a-z0-9 ._-]/' : '/[^%a-z0-9 _-]/' , '', $title);
    $title = preg_replace('/\s+/', '-', $title);
    $title = preg_replace('|-+|', '-', $title);
    $title = trim($title, '-');

    return $title;
}
remove_filter('sanitize_title', 'sanitize_title_with_dashes');
add_filter('sanitize_title', 'sanitize_title_with_dots_and_dashes', 10, 3);




//add_action('template_redirect', 'template_check');
// function template_check(){
//     $pt = get_query_var('post_type');

//     if(function_exists('is_widget')){
//         if((!is_widget() && is_category() && ($pt != 'section' && $pt != 'page')) || (is_post_type_archive(array('guide', 'question')) || $pt == 'post' )){
//         $templates = array();

//         if(is_category()){
//             $templates[] = 'archive-tax-'.$pt.'.php';
//             $templates[] = 'archive-tax.php';
//         }

//         $templates[] = 'archive-'.$pt.'.php';
//         $templates[] = "archive.php";
//         $template = get_query_template($template_name, $templates);
//         //echo "<pre>";print_r($templates);echo "</pre>";
//         include( $template );
//         exit;
//         } 
//     }

    
// }

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
//add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}



add_filter( "the_excerpt", "add_class_to_excerpt" );
function add_class_to_excerpt( $excerpt ) {
    return str_replace('<p', '<p class="content-excerpt"', $excerpt);
}


add_action('init', 'catch_cookies');
function catch_cookies(){
    //echo "<pre>";print_r($_COOKIE);echo "</pre>";
}


// add_filter('widgetpress_widget_classname', 'featured_guide_class_filter');
// function featured_guide_class_filter($classname){
//     if($classname == 'featured-guide') {
//         $classname = 'featured-post';
//     }
//     return $classname;
// }

// add_filter('widgetpress_pre_add_classes', 'featured_question_class_filter');
// function featured_question_class_filter($params){
//     global $wp_registered_widgets;

//     $widget_id  = $params[0]['widget_id'];
//     $widget_obj = $wp_registered_widgets[$widget_id];
//     $widget_opt = get_option($widget_obj['callback'][0]->option_name);
//     $widget_num = $widget_obj['params'][0]['number'];
//     $widget = $widget_opt[$widget_num];

//     echo "<pre>";print_r($widget_obj);echo "</pre>";

//     return $params;
//}

/**
 * Handles posting of comment (of any with screen name
 * @param array - comment data
 * @author Dan Crimmins
 */
function post_comment_screen_name($commentdata) {
	
    
    if(isset($_POST['screen-name'])) {
        
    	//sanitize
    	$clean_screen_name = sanitize_text_field($_POST['screen-name']);

        //Attempt to set screen name
        $response = set_screen_name($clean_screen_name);

        /*var_dump($response);
        exit;*/

        //If setting screen name fails
        if($response !== true) {

            //Create QS
            $qs = '?comment=' . urlencode($_POST['comment']) . '&cid=' . $commentdata['comment_parent'] . '&comm_err=' . urlencode($response['message']);

            //Create return URL
            $linkparts = explode('#', get_comment_link());
            $url = ($commentdata['comment_parent'] == 0) ? $linkparts[0] . $qs .'#commentform' : $linkparts[0] . $qs .'#comment-' .$commentdata['comment_parent'];
            
            //Redirect to return url
            header('Location: ' . $url);
            exit;
        }
        
    }
    
    
    return $commentdata;
    
}

add_filter( 'preprocess_comment',  'post_comment_screen_name');

function limit_search($query) {
    if ($query->is_search)
        $query->set('post_type',array('post','question','guide'));

    return $query;
}
add_filter('pre_get_posts','limit_search');


function filter_before_widget($html, $dropzone, $widget){

    $meta = (object)$widget->get('meta');
    if($meta->widgetpress_widget_classname = 'Featured_Post_Widget'){
        $query = get_post($meta->post__in_1);
       // echo "<pre>";print_r($query);echo "</pre>";
        if($query->post_type == 'question'){
            if($meta->limit > 1){
                $html = str_replace('featured-post', 'featured-category-question', $html);
            } else { 
                $html = str_replace('featured-post', 'featured-question', $html);
            }
        }

    }

    if($meta->widgetpress_widget_classname = 'Results_List_Widget'){

        if($meta->query_type == 'users'){
            $html = str_replace('results-list', 'results-list_users', $html);
           }

    }
    //echo "<pre>";print_r();echo "</pre>";

    return $html;

}

add_action('template_redirect', 'template_redirect');

function template_redirect(){

    if(isset($_GET['s'])){
        $templates[] = 'search.php';

        $template = get_query_template($template_name, $templates);
        //echo "<pre>";print_r($templates);echo "</pre>";
        include( $template );
        exit;
        }
}

add_filter('widgetpress_before_widget', 'filter_before_widget', 10, 3);

function disallow_admin_access() {
    global $current_user;

    if(!is_ajax()) {
        $show_admin = (current_user_can("access_admin") || $current_user->caps["administrator"] == 1) ? true : false;
        if (!$show_admin) {
            wp_redirect(home_url());
            exit();
        }
    }
}

add_filter('admin_init', 'disallow_admin_access');

/**
 * When a search query occurs, check for profanity. If there is 
 * profanity, then clear out search, redirect to home with blank search.
 * 
 * @param void
 */
function search_profanity_filter() {
	
	if(isset($_GET['s'])) {
		
		if(strpos(sanitize_text($_GET['s']), '**') !== false) {
			
			$url = home_url('/') . '?s=';
			wp_redirect($url);
		}
	}
}

add_action('init', 'search_profanity_filter');

function force_list_class( $data , $postarr ) {
    $data['post_content'] = str_replace( '<ol>', '<ol class="bullets">', $data['post_content']);
    $data['post_content'] = str_replace( '<ul>', '<ul class="bullets">', $data['post_content']);
    return $data;
}

add_filter( 'wp_insert_post_data' , 'force_list_class' , '99', 2 );

function force_list_class_inline( $data ) {
    $data = str_replace( '<ol>', '<ol class="bullets">', $data);
    $data = str_replace( '<ul>', '<ul class="bullets">', $data);
    echo $data;
}
add_filter( 'the_content', 'force_list_class_inline' );
add_filter( 'the_excerpt', 'force_list_class_inline' );


/**
 * WP Polls - this replaces the get_poll() function used in a hook in WidgetPress.
 *
 * This function overwrites the call to get_poll() - but only in the WidgetPress compatible version of the widget.
 *
 * The purpose is to make the widget show the form even when users are logged out.
 */


remove_action('widgetpress_compat_wp_polls-get_poll', 'get_poll');
add_action('widgetpress_compat_wp_polls-get_poll', 'comm_get_poll');

function comm_get_poll($temp_poll_id = 0, $display = true){
    global $wpdb, $polls_loaded;
    // Poll Result Link
    if(isset($_GET['pollresult'])) {
        $pollresult_id = intval($_GET['pollresult']);
    } else {
        $pollresult_id = 0;
    }
    $temp_poll_id = intval($temp_poll_id);
    // Check Whether Poll Is Disabled
    if(intval(get_option('poll_currentpoll')) == -1) {
        if($display) {
            echo stripslashes(get_option('poll_template_disable'));
            return;
        } else {
            return stripslashes(get_option('poll_template_disable'));
        }       
    // Poll Is Enabled
    } else {
        // Hardcoded Poll ID Is Not Specified
        switch($temp_poll_id) {
            // Random Poll&& array_key_exists($poll_form_id, $poll_cookie)
            case -2:
                $poll_id = $wpdb->get_var("SELECT pollq_id FROM $wpdb->pollsq WHERE pollq_active = 1 ORDER BY RAND() LIMIT 1");
                break;
            // Latest Poll
            case 0:
                // Random Poll
                if(intval(get_option('poll_currentpoll')) == -2) {
                    $random_poll_id = $wpdb->get_var("SELECT pollq_id FROM $wpdb->pollsq WHERE pollq_active = 1 ORDER BY RAND() LIMIT 1");
                    $poll_id = intval($random_poll_id);
                    if($pollresult_id > 0) {
                        $poll_id = $pollresult_id;
                    } elseif(intval($_POST['poll_id']) > 0) {
                        $poll_id = intval($_POST['poll_id']);
                    }
                // Current Poll ID Is Not Specified
                } elseif(intval(get_option('poll_currentpoll')) == 0) {
                    // Get Lastest Poll ID
                    $poll_id = intval(get_option('poll_latestpoll'));
                } else {
                    // Get Current Poll ID
                    $poll_id = intval(get_option('poll_currentpoll'));
                }
                break;
            // Take Poll ID From Arguments
            default:
                $poll_id = $temp_poll_id;
        }
    }
    
    // Assign All Loaded Poll To $polls_loaded
    if(empty($polls_loaded)) {
        $polls_loaded = array();
    }
    if(!in_array($poll_id, $polls_loaded)) {
        $polls_loaded[] = $poll_id;
    }

    // User Click on View Results Link
    if($pollresult_id == $poll_id) {
        if($display) {
            echo display_pollresult($poll_id);
            return;
        } else {
            return display_pollresult($poll_id);
        }
    // Check Whether User Has Voted
    } else {
        $poll_active = $wpdb->get_var("SELECT pollq_active FROM $wpdb->pollsq WHERE pollq_id = $poll_id");
        $poll_active = intval($poll_active);
        $check_voted = (is_user_logged_in()) ? check_voted($poll_id) : 0;
        if($poll_active == 0) {
            $poll_close = intval(get_option('poll_close'));
        } else {
            $poll_close = 0;
        }
        if(intval($check_voted) > 0 || (is_array($check_voted) && sizeof($check_voted) > 0) || ($poll_active == 0 && $poll_close == 1)) {
            if($display) {
                echo display_pollresult($poll_id, $check_voted);
                return;
            } else {
                return display_pollresult($poll_id, $check_voted);
            }
        } elseif(!check_allowtovote() || ($poll_active == 0 && $poll_close == 3)) {
            $disable_poll_js = '<script type="text/javascript">jQuery("#polls_form_'.$poll_id.' :input").each(function (i){jQuery(this).attr("disabled","disabled")});</script>';
            if($display) {
                echo comm_display_pollvote($poll_id).$disable_poll_js;
                return;
            } else {
                return comm_display_pollvote($poll_id).$disable_poll_js;
            }           
        } elseif($poll_active == 1) {
            if($display) {
                echo comm_display_pollvote($poll_id);
                return;
            } else {
                return comm_display_pollvote($poll_id);
            }
        }
    }   
}

### Function: Display Voting Form
function comm_display_pollvote($poll_id, $display_loading = true) {
	global $wpdb;
	
	// Temp Poll Result
	$temp_pollvote = '';
	// Get Poll Question Data
	$poll_question = $wpdb->get_row("SELECT pollq_id, pollq_question, pollq_totalvotes, pollq_timestamp, pollq_expiry, pollq_multiple, pollq_totalvoters FROM $wpdb->pollsq WHERE pollq_id = $poll_id LIMIT 1");
	// Poll Question Variables
	$poll_question_text = stripslashes($poll_question->pollq_question);
	$poll_question_id = intval($poll_question->pollq_id);
	$poll_question_totalvotes = intval($poll_question->pollq_totalvotes);
	$poll_question_totalvoters = intval($poll_question->pollq_totalvoters);
	$poll_start_date = mysql2date(sprintf(__('%s @ %s', 'wp-polls'), get_option('date_format'), get_option('time_format')), gmdate('Y-m-d H:i:s', $poll_question->pollq_timestamp)); 
	$poll_expiry = trim($poll_question->pollq_expiry);
	if(empty($poll_expiry)) {
		$poll_end_date  = __('No Expiry', 'wp-polls');
	} else {
		$poll_end_date  = mysql2date(sprintf(__('%s @ %s', 'wp-polls'), get_option('date_format'), get_option('time_format')), gmdate('Y-m-d H:i:s', $poll_expiry));
	}
	
	 
	//Is there a cookie set for this poll (if so, contains the choice(s) user made before prompted to login)
	$poll_form_id = "polls_form_$poll_question_id";
	$poll_input_name = "poll_$poll_question_id";
	$poll_cookie = (isset($_COOKIE['form-data'])) ? json_decode(urldecode(stripslashes(str_replace("'", "\"", $_COOKIE['form-data']))), true) : false;
	$poll_cookie_exists = ($poll_cookie && array_key_exists($poll_form_id, $poll_cookie)) ? true : false;
	
	$poll_multiple_ans = intval($poll_question->pollq_multiple);
	$template_question = stripslashes(get_option('poll_template_voteheader'));
	$template_question = str_replace("%POLL_QUESTION%", $poll_question_text, $template_question);
	$template_question = str_replace("%POLL_ID%", $poll_question_id, $template_question);
	$template_question = str_replace("%POLL_TOTALVOTES%", $poll_question_totalvotes, $template_question);
	$template_question = str_replace("%POLL_TOTALVOTERS%", $poll_question_totalvoters, $template_question);
	$template_question = str_replace("%POLL_START_DATE%", $poll_start_date, $template_question);
	$template_question = str_replace("%POLL_END_DATE%", $poll_end_date, $template_question);
	
	if($poll_multiple_ans > 0) {
		$template_question = str_replace("%POLL_MULTIPLE_ANS_MAX%", $poll_multiple_ans, $template_question);
	} else {
		$template_question = str_replace("%POLL_MULTIPLE_ANS_MAX%", '1', $template_question);
	}
	// Get Poll Answers Data
	$poll_answers = $wpdb->get_results("SELECT polla_aid, polla_answers, polla_votes FROM $wpdb->pollsa WHERE polla_qid = $poll_question_id ORDER BY ".get_option('poll_ans_sortby').' '.get_option('poll_ans_sortorder'));
	// If There Is Poll Question With Answers
	if($poll_question && $poll_answers) {
		// Display Poll Voting Form
		$temp_pollvote .= "<div id=\"polls-$poll_question_id\" class=\"wp-polls\">\n";
		$temp_pollvote .= "\t<form id=\"polls_form_$poll_question_id\" class=\"wp-polls-form\" action=\"".htmlspecialchars($_SERVER['REQUEST_URI'])."\" method=\"post\">\n";
		$temp_pollvote .= "\t\t<p style=\"display: none;\"><input type=\"hidden\" id=\"poll_{$poll_question_id}_nonce\" name=\"wp-polls-nonce\" value=\"".wp_create_nonce('poll_'.$poll_question_id.'-nonce')."\" /></p>\n";
		$temp_pollvote .= "\t\t<p style=\"display: none;\"><input type=\"hidden\" name=\"poll_id\" value=\"$poll_question_id\" /></p>\n";
		if($poll_multiple_ans > 0) {
			$temp_pollvote .= "\t\t<p style=\"display: none;\"><input type=\"hidden\" id=\"poll_multiple_ans_$poll_question_id\" name=\"poll_multiple_ans_$poll_question_id\" value=\"$poll_multiple_ans\" /></p>\n";
		}
		// Print Out Voting Form Header Template
		$temp_pollvote .= "\t\t$template_question\n";
		foreach($poll_answers as $poll_answer) {
			// Poll Answer Variables
			$poll_answer_id = intval($poll_answer->polla_aid); 
			$poll_answer_text = stripslashes($poll_answer->polla_answers);
			$poll_answer_votes = intval($poll_answer->polla_votes);
			$template_answer = stripslashes(get_option('poll_template_votebody'));
			$template_answer = str_replace("%POLL_ID%", $poll_question_id, $template_answer);
			$template_answer = str_replace("%POLL_ANSWER_ID%", $poll_answer_id, $template_answer);
			$template_answer = str_replace("%POLL_ANSWER%", $poll_answer_text, $template_answer);
			$template_answer = str_replace("%POLL_ANSWER_VOTES%", number_format_i18n($poll_answer_votes), $template_answer);
			
			
			
			if($poll_multiple_ans > 0) { //Multi-answer checkbox
				
				if($poll_cookie_exists) {
					
					if(in_array($poll_answer_id, $poll_cookie[$poll_form_id][$poll_input_name])) {
						
						$template_answer = select_it(str_replace("%POLL_CHECKBOX_RADIO%", 'checkbox', $template_answer));
					}
					
				} else {
				
					
					$template_answer = str_replace("%POLL_CHECKBOX_RADIO%", 'checkbox', $template_answer);
				}
				
			} else { //Single answer radio
				
				if($poll_cookie_exists) {
						
					if(in_array($poll_answer_id, $poll_cookie[$poll_form_id][$poll_input_name])) {
						
						$template_answer = select_it(str_replace("%POLL_CHECKBOX_RADIO%", 'radio', $template_answer));
					}
					
				} else {
					
						$template_answer = str_replace("%POLL_CHECKBOX_RADIO%", 'radio', $template_answer);
				}
				
			}
			// Print Out Voting Form Body Template
			$temp_pollvote .= "\t\t$template_answer\n";
		}
		// Determine Poll Result URL
		$poll_result_url = $_SERVER['REQUEST_URI'];
		$poll_result_url = preg_replace('/pollresult=(\d+)/i', 'pollresult='.$poll_question_id, $poll_result_url);
		if(isset($_GET['pollresult']) && intval($_GET['pollresult']) == 0) {
			if(strpos($poll_result_url, '?') !== false) {
				$poll_result_url = "$poll_result_url&amp;pollresult=$poll_question_id";
			} else {
				$poll_result_url = "$poll_result_url?pollresult=$poll_question_id";
			}
		}
		// Voting Form Footer Variables
		$template_footer = stripslashes(get_option('poll_template_votefooter'));
		$template_footer = str_replace("%POLL_ID%", $poll_question_id, $template_footer);
		$template_footer = str_replace("%POLL_RESULT_URL%", $poll_result_url, $template_footer);
		$template_footer = str_replace("%POLL_START_DATE%", $poll_start_date, $template_footer);
		$template_footer = str_replace("%POLL_END_DATE%", $poll_end_date, $template_footer);
		if($poll_multiple_ans > 0) {
			$template_footer = str_replace("%POLL_MULTIPLE_ANS_MAX%", $poll_multiple_ans, $template_footer);
		} else {
			$template_footer = str_replace("%POLL_MULTIPLE_ANS_MAX%", '1', $template_footer);
		}
		// Print Out Voting Form Footer Template
		$temp_pollvote .= "\t\t$template_footer\n";
		$temp_pollvote .= "\t</form>\n";
		$temp_pollvote .= "</div>\n";
		if($display_loading) {
			$poll_ajax_style = get_option('poll_ajax_style');
			if(intval($poll_ajax_style['loading']) == 1) {
				$temp_pollvote .= "<div id=\"polls-$poll_question_id-loading\" class=\"wp-polls-loading\"><img src=\"".plugins_url('wp-polls/images/loading.gif')."\" width=\"16\" height=\"16\" alt=\"".__('Loading', 'wp-polls')." ...\" title=\"".__('Loading', 'wp-polls')." ...\" class=\"wp-polls-image\" />&nbsp;".__('Loading', 'wp-polls')." ...</div>\n";
			}
		}
	} else {
		$temp_pollvote .= stripslashes(get_option('poll_template_disable'));
	}
	
	//Add JS to submit form if there is a poll cookie
	if($poll_cookie_exists) {
		
		$temp_pollvote .= "\n\n <script>poll_vote(". $poll_question_id .");</script>";
	
	}
	
	// Return Poll Vote Template
	return $temp_pollvote;
}
