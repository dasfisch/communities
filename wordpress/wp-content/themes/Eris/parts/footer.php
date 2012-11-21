<?php
/**
 * @package WordPress
 * @subpackage White Label
 */

// Can anyone else think of a better way to pass this parameter along
?>
                  

      </section> <!-- #content -->

      <footer id="footer" class="clearfix">

        <div id="shc_footer">
          <?php do_action('content-bottom'); ?>
        </div>
        <?php
        if (theme_option("brand") == "kmart") {
          get_template_part('parts/footer_navigation_kmart');
          get_template_part('parts/footer_anterior_kmart');
        }
        else {
          get_template_part('parts/footer_navigation');
          get_template_part('parts/footer_anterior');
        }
         
        //Used to destroy session used only to capture referer information
        session_destroy();       
        ?>

        <?php wp_footer(); ?>

      </footer>

    </div> <!-- #container -->
    <?php get_partial('parts/tooltip'); 
    global $current_user;
    
    $email_from = is_user_logged_in() ? $current_user->user_email : '';

    echo '
        <script type="text/javascript">
            var addthis_config = {
                ui_email_note: "Thought you might like this from My' . ucfirst( theme_option("brand") ) .' Community.",
                ui_email_from: "' . $email_from . '",
                data_track_clickback: true
              }
              function openSYWWindow(theURL,winName,features) { 
                  newwindow=window.open(theURL,winName,features); 
                  if (window.focus) {newwindow.focus()} 
              }
        </script>
    ';?>
    <!-- SiteCatalyst code version: H.20.3. Copyright 1997-2009 Adobe, Inc. More info available at http://www.Adobe.com -->
		<script language="JavaScript" type="text/javascript">
    /************* DO NOT ALTER ANYTHING BELOW THIS LINE ! **************/
    var s_code=s.t();if(s_code)document.write(s_code)//-->
		<!--
		if(navigator.appVersion.indexOf('MSIE')>=0)document.write(unescape('%3C')+'\!-'+'-')
		//-->
		</script>
		<noscript>
			<a href="http://www.Adobe.com" title="Web Analytics"><imgsrc="//om.sears.com/b/ss/<?php echo (theme_option("brand") == 'kmart')? "searskmartcom":"searscom"; ?>/1/H.20.3--NS/0" height="1" width="1" border="0" alt="" /></a>
		</noscript><!--/DO NOT REMOVE/-->
		<!-- End SiteCatalyst code version: H.20.3. -->
  </body> 
</html>
