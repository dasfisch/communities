<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>
    <head>
  
        <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
        
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=7" />
        <meta name="description" content="<?php bloginfo('description'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />
        
        <?php wp_head(); ?>
        
    </head>

    <body <?php body_class(); ?>> 
        
        <!-- SHC Header from SHC Header-Footer Plugin -->
        <div id="shc_header">
            <?php do_action('content-top'); ?>
        </div>
        
        <!-- #page-wrapper -->
        <div id="page_wrapper">

            <div id="wp_header">
                <a href="<?php echo site_url(''); ?>" id="logo"></a>
                <?php wp_nav_menu( array( 'theme_location' => 'main-navigation', 'menu_id' => 'main-nav') ); ?>
            </div>
            
            <nav id="headernav">
                <ul>
                <li style="float: right"><a href="#">Customer Care</a></li>
                  <li><a href="#">Categories</a></li>
                  <li><a href="#">Q&amp;A's</a></li>
                  <li><a href="#">Blog</a></li>
                  <li><a href="#">Buying Guides</a></li>
                </ul>
            </nav>
            
            <!-- #page -->
            <div id="page">
                
                <?php do_action('content-before'); ?>
                
                <div id="subheader">
                    <?php /* Subheaders */ ?>
                </div>
                
                <!-- #content -->
                <div id="content">