<?php 
/**
 * Custom Comment Types 
 */
if (class_exists(CCT_Controller_Comment_Types)) {
    
    /**
     * 
     */
    function register_flags() {
        $args = array(
            'labels' => array(
                'name' => _x('Flags', 'post type general name'),
                'singular_name' => _x('Flag', 'post type singular name'),
                'add_new' => _x('Add New', 'flag'),
                'add_new_item' => __('Add New Flag'),
                'edit_item' => __('Edit Flag'),
                'new_item' => __('New Flag'),
                'all_items' => __('All Flags'),
                'view_item' => __('View Flags'),
                'search_items' => __('Search Flags'),
                'not_found' => __('No flags found'),
                'not_found_in_trash' => __('No flags found in Trash'),
                'parent_item_colon' => 'Flag:',
                'menu_name' => 'Flag'
            ),
            'parent_domain' => 'post',
            'parent_type' => 'question',
            'capability' => 'administrator',
            'menu_icon' => get_template_directory_uri() . '/assets/img/admin/flags_admin_icon.gif',
            'menu_position' => 28,
            'template' => get_template_directory_uri() . '/parts/flags.php'
        );

        CCT_Controller_Comment_Types::register_comment_type('flag', $args);
    }

    add_action('init', 'register_flags', 10);

    /**
     * 
     */
    function register_answers() {
        $args = array(
            'labels' => array(
                'name' => _x('Answers', 'post type general name'),
                'singular_name' => _x('Answer', 'post type singular name'),
                'add_new' => _x('Add New', 'answer'),
                'add_new_item' => __('Add New Answer'),
                'edit_item' => __('Edit Answer'),
                'new_item' => __('New Answer'),
                'all_items' => __('All Answers'),
                'view_item' => __('View Answers'),
                'search_items' => __('Search Answers'),
                'not_found' => __('No answers found'),
                'not_found_in_trash' => __('No answers found in Trash'),
                'parent_item_colon' => 'Question:',
                'menu_name' => 'Answer'
            ),
            'parent_domain' => 'post',
            'parent_type' => 'question',
            'capability' => 'administrator',
            'menu_position' => 29,
            'template' => get_template_directory_uri() . '/parts/flags.php'
        );

        CCT_Controller_Comment_Types::register_comment_type('answer', $args);
    }

    add_action('init', 'register_answers', 11);

}


/**
 *
 * @param type $is_answer
 * @param type $comment_type
 * @param type $comment_data
 * @param type $parent
 * @return boolean 
 */

function set_answers_comment_type($is_answer, $comment_type, $comment_data, $parent){
    
    $is_answer = false;
    if($_POST['comment_type'] == 'answer' && is_user_logged_in()){
        $is_answer = true;
    }
   
    return $is_answer;
}
add_filter('cct_condition_answer', 'set_answers_comment_type', 10, 4);

function set_flags_comment_type($is_flag, $comment_type, $comment_data, $parent){
    
    $is_flag = false;
    if($_POST['comment_type'] == 'flag' && is_user_logged_in()){
        $is_flag = true;
    }
   
    return $is_flag;
}
add_filter('cct_condition_answer', 'set_flags_comment_type', 10, 4);
