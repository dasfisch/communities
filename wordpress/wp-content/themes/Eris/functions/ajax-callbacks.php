<?php
/**
 * @author Eddie Moya
 * 
 * Ajax callback for getting subcategories
 */
function get_subcategories_ajax(){

    if(isset($_POST['category_id'])){
        $parent = absint((int)$_POST['category_id']);
            wp_dropdown_categories(array(
                'depth'=> 1,
                'child_of' => $parent,
                'hierarchical' => true,
                'hide_if_empty' => true,
                'class' => 'input_select',
                'name' => 'sub-category',
                'id' => 'sub-category',
                'echo' => true
            ));
        exit();
    }
}
add_action('wp_ajax_get_subcategories_ajax', 'get_subcategories_ajax');
add_action('wp_ajax_nopriv_get_subcategories_ajax', 'get_subcategories_ajax');


/**
 * @author Eddie Moya
 * 
 */
function get_template_ajax(){
    if( isset($_POST['template']) ){
        get_template_part($_POST['template']);
    } else {
        echo "<!-- No template selected -->";
    }
    exit();
    
}

add_action('wp_ajax_nopriv_get_template_ajax', 'get_template_ajax');
add_action('wp_ajax_get_template_ajax', 'get_template_ajax');

/**
 * @author Eddie Moya
 * 
 */
function get_posts_ajax(){
    if( isset($_POST['template']) ){
        global $wp_query;
       
            $query['cat'] = $_POST['category'];

            if(isset($_GET['s'])) { 
                $query['s'] = $_GET['s'];
            }

            if(isset($_POST['post_type'])){
                $query['post_type'] = array($_POST['post_type']);
            }

            if(isset($_POST['order'])){
                $query['order'] = $_POST['order'];
            }

            $wp_query = new WP_Query($query);
        $path = (isset($_POST['path'])) ? $_POST['path'] : 'parts';
      
        loop(array($_POST['template'], 'post'), $_POST['special'], $path, 'parts/no-results');
        wp_reset_query();

    } else {
        echo "<!-- No template selected -->";
    }
    exit();
}

add_action('wp_ajax_nopriv_get_posts_ajax', 'get_posts_ajax');
add_action('wp_ajax_get_posts_ajax', 'get_posts_ajax');

/**
 * @author Eddie Moya
 * 
 */
function get_users_ajax(){

    $category = array($_POST['category']);
    $hide_untaxed = ($category > 0);
    
    if(class_exists('Results_List_Widget')){
        $users = Results_List_Widget::query_users(array('hide_untaxed' => $hide_untaxed, 'terms' => $category, 'cap' => 'post_as_expert', 'order' => $_POST['order']));
        get_partial($_POST['path'].'/'.$_POST['template'], array('users' => $users));
    }
    
    exit();
}

add_action('wp_ajax_nopriv_get_users_ajax', 'get_users_ajax');
add_action('wp_ajax_get_users_ajax', 'get_users_ajax');

/**
 * @author Dan Crimmins
 * 
 * Handles 'More' ajax pagination requests
 * 
 * @returns string - HTML output
 */
function profile_paginate() {
     
    $uid = $_POST['uid'];
    $type = $_POST['type'];
    $page = $_POST['page'];
    
    
    require_once get_template_directory() . '/classes/communities_profile.php';
    
    //User Profile object
    $user_activities = new User_Profile($uid);
    
    ob_start();
    
        //Comments
        if($type == 'answer' || $type == 'comment') {
            
            $activities = $user_activities->page($page)
                                            ->get_user_comments_by_type($type)
                                            ->comments;
                  
                                                                                                        
            include(get_template_directory() . '/parts/profile-comments.php');
        }
        
        //Posts
        if($type == 'posts' || $type == 'guides' || $type == 'question') {
            
        	
	        if($type == 'question') {
					
					$activities = $user_activities->page($page)
													->get_user_posts_by_type($type)
													->get_expert_answers()
													->posts;
													
						/*echo '<pre>';
						var_dump($activities);
						exit;*/							
				
				} else {
					
					$activities = $user_activities->page($page)
													->get_user_posts_by_type($type)
													->posts;
												
				}
                                            
            include(get_template_directory() . '/parts/profile-posts.php');
        }
        
        //Actions
        if($type == 'follow' || $type == 'upvote') {
            
            $activities = $user_activities->page($page)
                                            ->get_actions($type)
                                            ->activities;
            
            include(get_template_directory() . '/parts/profile-recent.php');
        }
        
        if($type == 'recent') {
            
            $activities = $user_activities->page($page)
                                            ->get_recent_activities()
                                            ->activities;
                                            
            include(get_template_directory() . '/parts/profile-recent.php');
        }
        
    $output = ob_get_clean();
    
    echo $output;
    
    die;
}

add_action('wp_ajax_profile_paginate', 'profile_paginate');
add_action('wp_ajax_nopriv_profile_paginate', 'profile_paginate');

/**
 * Validates a screen name. Returns 'true' if it is valid and 
 * available; false if not.
 * 
 * @author Dan Crimmins
 * @param string $screen_name
 * @return string - 'true' or 'false'
 */
function validate_screen_name() {
	
	$screen_name = $_POST['screen_name'];
	
	if(class_exists('SSO_Profile')) {
		
		$profile = new SSO_Profile;
		$response = $profile->validate_screen_name($screen_name);
		
		echo ($response['code'] == '200') ? 'true' : 'false';
		
		exit;
	}
	
		
	exit;
}

add_action('wp_ajax_validate_screen_name', 'validate_screen_name');
add_action('wp_ajax_nopriv_validate_screen_name', 'validate_screen_name');

function ajaxify_comments() {
    global $current_user;
    get_currentuserinfo();

    $data = array(
    	'comment_post_ID'  => $_POST['comment_post_ID'],
    	'comment_content'  => $_POST['comment'],
    	'comment_date'     => date('Y-m-d H:i:s'),
    	'comment_date_gmt' => date('Y-m-d H:i:s'),
    	'comment_approved' => 1,
        'comment_type'     => 'flag'
    );

    if(is_user_logged_in()) {
        $data['user_id'] = $current_user->ID;
    }

    $comment_id = wp_insert_comment($data);

    echo $comment_id;
    exit;
}
add_action('wp_ajax_flag_me', 'ajaxify_comments');
add_action('wp_ajax_nopriv_flag_me', 'ajaxify_comments');


/**
 * Sets comment_approve
 * @author Dan Crimmins
 */
function user_delete_comment() {
	
	global $wpdb;
	
	$comment_id = $_POST['cid'];
	$uid = $_POST['uid'];
	
	if(wp_verify_nonce($_POST['_wp_nonce'], 'comment_delete_' . $comment_id . '_' . $uid)) {
		
		$update = $wpdb->update($wpdb->comments, 
							array('comment_approved' => '0'),
							array('comment_ID' => $comment_id));
	
		echo ($update) ? $comment_id : 0;
		
	} else {
		
		echo 0;
	}
	
	exit;
}

add_action('wp_ajax_user_delete_comment', 'user_delete_comment');
add_action('wp_ajax_nopriv_user_delete_comment', 'user_delete_comment');