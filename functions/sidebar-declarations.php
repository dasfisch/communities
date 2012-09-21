<?php 
/**
 * Register Widgetized Areas 
 */
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Q&A Sidebar',
        'description' => 'Sidebar',
        'before_widget' => '<article class="span12 content-container widget dropzone-widget widget">',
        'after_widget' => '</article>',
        'before_title' => '<header class="content-header"><h3 class="widgettitle">',
        'after_title' => '</h3></header>'
    ));
    register_sidebar(array(
        'name' => 'Q&A Content Area',
        'description' => 'Content Area',
        'before_widget' => '<article class="span12 content-container widget dropzone-widget widget">',
        'after_widget' => '</article>',
        'before_title' => '<header class="content-header"><h3 class="widgettitle">',
        'after_title' => '</h3></header>'
    ));

    register_sidebar(array(
        'name' => 'Blogs Sidebar',
        'description' => 'Sidebar',
        'before_widget' => '<article class="span12 content-container widget dropzone-widget widget">',
        'after_widget' => '</article>',
        'before_title' => '<header class="content-header"><h3 class="widgettitle">',
        'after_title' => '</h3></header>'
    ));
    register_sidebar(array(
        'name' => 'Blogs Content Area',
        'description' => 'Sidebar',
        'before_widget' => '<article class="span12 content-container widget dropzone-widget widget">',
        'after_widget' => '</article>',
        'before_title' => '<header class="content-header"><h3 class="widgettitle">',
        'after_title' => '</h3></header>'
    ));

    register_sidebar(array(
        'name' => 'Buying Guide Sidebar',
        'description' => 'Sidebar',
        'before_widget' => '<article class="span12 content-container widget dropzone-widget widget">',
        'after_widget' => '</article>',
        'before_title' => '<header class="content-header"><h3 class="widgettitle">',
        'after_title' => '</h3></header>'
    ));
    register_sidebar(array(
        'name' => 'Buying Guide Content Area',
        'description' => 'Sidebar',
        'before_widget' => '<article class="span12 content-container widget dropzone-widget widget">',
        'after_widget' => '</article>',
        'before_title' => '<header class="content-header"><h3 class="widgettitle">',
        'after_title' => '</h3></header>'
    ));
    
}