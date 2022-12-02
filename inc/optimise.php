<?php
if(!defined('ABSPATH')) 
{
    exit; 
}

/* ----------------------------------------------------------------------------------------------------------------------------
!        ___                                                           ___          ___                    ___          ___     
!       /\__\                               _____        _____        /\__\        /\__\                  /\__\        /\  \    
!      /:/ _/_                   ___       /::\  \      /::\  \      /:/ _/_      /:/ _/_      ___       /:/ _/_       \:\  \   
!     /:/ /\  \                 /\__\     /:/\:\  \    /:/\:\  \    /:/ /\__\    /:/ /\  \    /\__\     /:/ /\  \       \:\  \  
!    /:/ /::\  \  ___     ___  /:/__/    /:/ /::\__\  /:/  \:\__\  /:/ /:/ _/_  /:/ /::\  \  /:/__/    /:/ /::\  \  _____\:\  \ 
!   /:/_/:/\:\__\/\  \   /\__\/::\  \   /:/_/:/\:|__|/:/__/ \:|__|/:/_/:/ /\__\/:/_/:/\:\__\/::\  \   /:/__\/\:\__\/::::::::\__\
!   \:\/:/ /:/  /\:\  \ /:/  /\/\:\  \__\:\/:/ /:/  /\:\  \ /:/  /\:\/:/ /:/  /\:\/:/ /:/  /\/\:\  \__\:\  \ /:/  /\:\~~\~~\/__/
!    \::/ /:/  /  \:\  /:/  /  ~~\:\/\__\\::/_/:/  /  \:\  /:/  /  \::/_/:/  /  \::/ /:/  /  ~~\:\/\__\\:\  /:/  /  \:\  \      
!     \/_/:/  /    \:\/:/  /      \::/  / \:\/:/  /    \:\/:/  /    \:\/:/  /    \/_/:/  /      \::/  / \:\/:/  /    \:\  \     
!       /:/  /      \::/  /       /:/  /   \::/  /      \::/  /      \::/  /       /:/  /       /:/  /   \::/  /      \:\__\    
!       \/__/        \/__/        \/__/     \/__/        \/__/        \/__/        \/__/        \/__/     \/__/        \/__/    
 ---------------------------------------------------------------------------------------------------------------------------- */

if(!is_admin())
{	
	/*
    ** Disable php error reporting before theme is loaded.
    */
    function php_pre_setup()
    {
        if(get_option('php_reporting') == "Yes")
        {
            if(!defined('WP_DEBUG'))
            {
                define('WP_DEBUG', false);
            }

            if(!defined('WP_DEBUG_DISPLAY'))
            {
                define('WP_DEBUG_DISPLAY', false);
            }

            ini_set('display_errors', 'Off');
            ini_set('error_reporting', E_ALL);
        }
    }
    add_action('setup_theme', 'php_pre_setup');
	
   /*
    ** Optimise Speed Theme Function
    */
	function optimise_speed_theme()
	{		
		/*
        ** Remove Print Styles including Emoji Support.
        */
        if(get_option('emoji_support') == "Yes")
        {
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('wp_print_styles', 'print_emoji_styles');
            remove_action('admin_print_scripts', 'print_emoji_detection_script');
            remove_action('admin_print_styles', 'print_emoji_styles');
            remove_action('admin_print_scripts', 'print_emoji_detection_script');
            remove_action('admin_print_styles', 'print_emoji_styles');
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('admin_print_scripts', 'print_emoji_detection_script');
            remove_action('wp_print_styles', 'print_emoji_styles');
            remove_action('admin_print_styles', 'print_emoji_styles');
            add_filter('emoji_svg_url', '__return_false');
        }
		
		/*
        ** Disable XML-RPC.
        */
        if(get_option('ping_backs') == "Yes")
        {
            add_filter('xmlrpc_enabled', '__return_false');
			add_filter('wp_headers', 'disable_x_pingback');

			function disable_x_pingback($headers) 
			{
				unset($headers['X-Pingback']);
				
				return $headers;
			}	
			add_filter('pings_open', '__return_false', PHP_INT_MAX);

			function disable_pingback(&$links)
			{
				foreach($links as $l => $link)
				{
					if(0 === strpos($link, get_option('home')))
					{
						unset($links[$l]);
					}
				}
			}
			add_action('pre_ping', 'disable_pingback');
        }

		/*
        ** Remove Short Link.
        */
        if(get_option('short_link') == "Yes")
        {
            remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
        }
		
		/*
        ** Remove Feed Links.
        */
        if(get_option('feed_links') == "Yes")
        {
            remove_action('wp_head', 'feed_links_extra', 3);
            remove_action('wp_head', 'feed_links', 2);
            remove_action('wp_head', 'rsd_link');
            remove_action('wp_head', 'wlwmanifest_link');
            remove_action('wp_head', 'wp_generator');
            remove_action('wp_head', 'wp_shortlink_wp_head');
            remove_action('wp_head', 'feed_links', 2);
            remove_action('wp_head', 'feed_links_extra', 3);
            remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

            function avia_remove_profile()
            {
                return false;
            }
            add_filter('avf_profile_head_tag','avia_remove_profile');
        }
		
		/*
        ** Disable Admin Bar.
        */
        if(get_option('admin_bar') == "Yes")
        {
            add_filter('show_admin_bar', '__return_false');
        }

		/*
        ** Disable REST API
        */		
		if(get_option('rest_api') == "Yes")
		{
			add_filter('rest_authentication_errors', function($result) 
			{

				if(true === $result || is_wp_error($result)) 
				{
					return $result;
				}

				if(!is_user_logged_in()) 
				{
					return new WP_Error(
						'rest_not_logged_in',
						__( 'You are not currently logged in.' ),
						array( 'status' => 401 )
					);
				}

				return $result;
			});
			
			if(!is_user_logged_in()) 
			{
				remove_action('wp_head', 'rest_output_link_wp_head');
				remove_action('template_redirect', 'rest_output_link_header', 11);
			}
		}		
		
		/*
        ** Disable oEmbed.
        */
        if(get_option('oembed') == "Yes")
        {
            remove_action('rest_api_init', 'wp_oembed_register_route');
            remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
            remove_action('wp_head', 'wp_oembed_add_discovery_links');
            remove_action('wp_head', 'wp_oembed_add_host_js');
        }
		
		/*
        ** Remove <!-- html comments -->.
        */
        if(get_option('html_comments') != "")
        {
            function callback($buffer)
            {
                $buffer = preg_replace('/<!--(.|s)*?-->/', '', $buffer);

                return $buffer;
            }

            function buffer_start()
            {
                ob_start("callback");
            }

            function buffer_end()
            {
                ob_end_flush();
            }

            add_action('get_header', 'buffer_start');
            add_action('wp_footer', 'buffer_end');
        }
		
		/*
        * Optimise CSS and JS with custom files.
        */		
		if(get_option('optimise_css_js_files') == "Yes")
        {
			/*
			* Theme Name.
			*/
			$my_theme = wp_get_theme();
			
		   /* /$$$$$$  /$$        /$$$$$$  /$$$$$$$   /$$$$$$  /$$      
			 /$$__  $$| $$       /$$__  $$| $$__  $$ /$$__  $$| $$      
			| $$  \__/| $$      | $$  \ $$| $$  \ $$| $$  \ $$| $$      
			| $$ /$$$$| $$      | $$  | $$| $$$$$$$ | $$$$$$$$| $$      
			| $$|_  $$| $$      | $$  | $$| $$__  $$| $$__  $$| $$      
			| $$  \ $$| $$      | $$  | $$| $$  \ $$| $$  | $$| $$      
			|  $$$$$$/| $$$$$$$$|  $$$$$$/| $$$$$$$/| $$  | $$| $$$$$$$$
			 \______/ |________/ \______/ |_______/ |__/  |__/|________/ */
                                                            
			function global_remove_scripts()
			{
				//Default Inline Styles
				wp_dequeue_style('global-styles-inline');
				wp_deregister_style('global-styles-inline');
				wp_dequeue_style('global-styles-inline-css');
				wp_deregister_style('global-styles-inline-css');
				wp_dequeue_style('wp-block-library-theme-inline-css');
				wp_deregister_style('wp-block-library-theme-inline-css');
				wp_dequeue_style('wp-block-library-theme');
				wp_deregister_style('wp-block-library-theme');
				//Default Styles
				wp_dequeue_style('wp-block-site-title');
				wp_deregister_style('wp-block-site-title');
				wp_dequeue_style('wp-block-navigation');
				wp_deregister_style('wp-block-navigation');
				wp_dequeue_style('wp-block-post-title');
				wp_deregister_style('wp-block-post-title');
				wp_dequeue_style('wp-block-post-excerpt');
				wp_deregister_style('wp-block-post-excerpt');
				wp_dequeue_style('wp-block-post-date');
				wp_deregister_style('wp-block-post-date');
				wp_dequeue_style('wp-block-query-pagination');
				wp_deregister_style('wp-block-query-pagination');
				wp_dequeue_style('wp-block-query');
				wp_deregister_style('wp-block-query');
				wp_dequeue_style('global-styles');
				wp_deregister_style('global-styles');
				wp_dequeue_style('core-block-supports');
				wp_deregister_style('core-block-supports');
				wp_dequeue_style('wp-webfonts');
				wp_deregister_style('wp-webfonts');
				//Default Separate Stylesheets
				wp_dequeue_style('wp-block-page-list');
				wp_deregister_style('wp-block-page-list');
				wp_dequeue_style('wp-block-group');
				wp_deregister_style('wp-block-group');
				wp_dequeue_style('wp-block-heading');
				wp_deregister_style('wp-block-heading');
				wp_dequeue_style('wp-block-post-featured-image');
				wp_deregister_style('wp-block-post-featured-image');
				wp_dequeue_style('wp-block-paragraph');
				wp_deregister_style('wp-block-paragraph');
				wp_dequeue_style('wp-block-spacer');
				wp_deregister_style('wp-block-spacer');
				wp_dequeue_style('wp-block-post-template');
				wp_deregister_style('wp-block-post-template');
				wp_dequeue_style('wp-block-button');
				wp_deregister_style('wp-block-button');
				wp_dequeue_style('wp-block-buttons');
				wp_deregister_style('wp-block-buttons');
				wp_dequeue_style('wp-block-separator');
				wp_deregister_style('wp-block-separator');
				wp_dequeue_style('wp-block-columns');
				wp_deregister_style('wp-block-columns');
				wp_dequeue_style('wp-block-library');
				wp_deregister_style('wp-block-library');
				wp_dequeue_style('wp-block-list');
				wp_deregister_style('wp-block-list');
				wp_dequeue_style('wp-block-comments');
				wp_deregister_style('wp-block-comments');
				wp_dequeue_style('wp-block-post-content');
				wp_deregister_style('wp-block-post-content');    
			}   
			add_action('wp_enqueue_scripts', 'global_remove_scripts', 19);
					
		   /* /$$$$$$   /$$$$$$    /$$    /$$$$$$ 
			 /$$__  $$ /$$$_  $$ /$$$$   /$$__  $$
			|__/  \ $$| $$$$\ $$|_  $$  | $$  \__/
			  /$$$$$$/| $$ $$ $$  | $$  | $$$$$$$ 
			 /$$____/ | $$\ $$$$  | $$  | $$__  $$
			| $$      | $$ \ $$$  | $$  | $$  \ $$
			| $$$$$$$$|  $$$$$$/ /$$$$$$|  $$$$$$/
			|________/ \______/ |______/ \______/ */
                                      
            if($my_theme == "Twenty Sixteen")
            {
                function twentysixteen()
                {
					//Twenty Sixteen Assets Path
                    define('INCLUDE_ASSET_PATH', plugin_dir_url(dirname(__FILE__, 1)) . "assets/twentysixteen/");

                    //CSS
                    wp_deregister_style('wp-block-library-css');
                    wp_dequeue_style('wp-block-library-css');
                    wp_deregister_style('classic-theme-styles');
                    wp_dequeue_style('classic-theme-styles');
                    wp_deregister_style('twentysixteen-style');
                    wp_dequeue_style('twentysixteen-style');
                    wp_deregister_style('twentysixteen-block-style');
                    wp_dequeue_style('twentysixteen-block-style');
                    wp_enqueue_style('css', INCLUDE_ASSET_PATH . "style.min.css", array(), '6.1.1', 'all');

                    //JS                    
                    wp_enqueue_script('jquery');
                    wp_dequeue_script('twentysixteen-script');
                    wp_deregister_script('twentysixteen-script');
                    wp_enqueue_script('h', INCLUDE_ASSET_PATH . "head-script.min.js", array(), '0.0.1', false);
                    wp_enqueue_script('f', INCLUDE_ASSET_PATH . "footer-script.min.js", array(), '0.0.1', true);
                    
                    wp_localize_script(
                    'f',
                    'screenReaderText',
                    array(
                        'expand'   => __( 'expand child menu', 'twentysixteen' ),
                        'collapse' => __( 'collapse child menu', 'twentysixteen' ),
                        )
                    );

                    /*
                    ** Skip Focus Link.
                    */
                    if(get_option('focus_link') == "Yes")
                    {
                        wp_dequeue_script('twentysixteen-skip-link-focus-fix');
                        wp_deregister_script('twentysixteen-skip-link-focus-fix'); 
                    }
                }
                add_action('wp_enqueue_scripts', 'twentysixteen', 20);

                remove_action( 'wp_head', 'twentysixteen_javascript_detection', 0);
            }

		   /* /$$$$$$   /$$$$$$    /$$   /$$$$$$$$
			 /$$__  $$ /$$$_  $$ /$$$$  |_____ $$/
			|__/  \ $$| $$$$\ $$|_  $$       /$$/ 
			  /$$$$$$/| $$ $$ $$  | $$      /$$/  
			 /$$____/ | $$\ $$$$  | $$     /$$/   
			| $$      | $$ \ $$$  | $$    /$$/    
			| $$$$$$$$|  $$$$$$/ /$$$$$$ /$$/     
			|________/ \______/ |______/|__/ */     
                                      
            if($my_theme == "Twenty Seventeen")
            {
                function twentyseventeen()
                {
                    //Twenty Seventeen Assets Path
                    define('INCLUDE_ASSET_PATH', plugin_dir_url(dirname(__FILE__, 1)) . "assets/twentyseventeen/");

                    //CSS
                    wp_deregister_style('classic-theme-styles');
                    wp_dequeue_style('classic-theme-styles');
                    wp_deregister_style('wp-block-library-css');
                    wp_dequeue_style('wp-block-library-css');
                    wp_deregister_style('classic-theme-styles');
                    wp_dequeue_style('classic-theme-styles');
                    wp_deregister_style('twentyseventeen-style');
                    wp_dequeue_style('twentyseventeen-style');
                    wp_deregister_style('twentyseventeen-block-style-css');
                    wp_dequeue_style('twentyseventeen-block-style-css');
                    wp_enqueue_style('css', INCLUDE_ASSET_PATH . "style.min.css", array(), '6.1.1', 'all');

                    //JS
                    wp_dequeue_script('twentyseventeen-navigation');
                    wp_deregister_script('twentyseventeen-navigation');
                    wp_enqueue_script('jquery');
                    wp_dequeue_script('twentyseventeen-global');
                    wp_deregister_script('twentyseventeen-global');
                    wp_dequeue_script('jquery-scrollto');
                    wp_deregister_script('jquery-scrollto');
                    wp_enqueue_script('h', INCLUDE_ASSET_PATH . "head-script.min.js", array(), '0.0.1', false);
                    wp_enqueue_script('f', INCLUDE_ASSET_PATH . "footer-script.min.js", array(), '0.0.1', true);

                    /*
                    ** Skip Focus Link.
                    */
                    if(get_option('focus_link') == "Yes")
                    {
                        wp_dequeue_script('twentyseventeen-skip-link-focus-fix');
                        wp_deregister_script('twentyseventeen-skip-link-focus-fix');   
                        wp_dequeue_script('twentyseventeen-skip-link-focus-fix-js-extra');
                        wp_deregister_script('twentyseventeen-skip-link-focus-fix-js-extra');
                    }
                }
                add_action('wp_enqueue_scripts', 'twentyseventeen', 20);

                remove_action( 'wp_head', 'twentyseventeen_javascript_detection', 0);
            }

		   /* /$$$$$$   /$$$$$$    /$$    /$$$$$$ 
			 /$$__  $$ /$$$_  $$ /$$$$   /$$__  $$
			|__/  \ $$| $$$$\ $$|_  $$  | $$  \ $$
			  /$$$$$$/| $$ $$ $$  | $$  |  $$$$$$$
			 /$$____/ | $$\ $$$$  | $$   \____  $$
			| $$      | $$ \ $$$  | $$   /$$  \ $$
			| $$$$$$$$|  $$$$$$/ /$$$$$$|  $$$$$$/
			|________/ \______/ |______/ \______/ */
			
            if($my_theme == "Twenty Nineteen")
            {
                function twentynineteen()
                {
                    //Twenty Nineteen Assets Path
                    define('INCLUDE_ASSET_PATH', plugin_dir_url(dirname(__FILE__, 1)) . "assets/twentynineteen/");

                    //CSS
                    wp_deregister_style('classic-theme-styles');
                    wp_dequeue_style('classic-theme-styles');
                    wp_deregister_style('twentynineteen-style');
                    wp_dequeue_style('twentynineteen-style');
                    wp_deregister_style('twentynineteen-print-style');
                    wp_dequeue_style('twentynineteen-print-style');
                    wp_enqueue_style('style', INCLUDE_ASSET_PATH . "style.min.css", array(), '6.1.1', 'all');

                    //JS
                    wp_dequeue_script('twentynineteen-priority-menu');
                    wp_deregister_script('twentynineteen-priority-menu');
                    wp_dequeue_script('twentynineteen-touch-navigation');
                    wp_deregister_script('twentynineteen-touch-navigation');
                    wp_enqueue_script('f', INCLUDE_ASSET_PATH . "script.min.js", array(), '0.0.1', true);

                    /*
                    ** Skip Focus Link.
                    */
                    if(get_option('focus_link') == "Yes")
                    {
                        remove_action('wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix');
                    }
                }
                add_action('wp_enqueue_scripts', 'twentynineteen', 20);

            }
             
		   /* /$$$$$$   /$$$$$$   /$$$$$$   /$$$$$$ 
			 /$$__  $$ /$$$_  $$ /$$__  $$ /$$$_  $$
			|__/  \ $$| $$$$\ $$|__/  \ $$| $$$$\ $$
			  /$$$$$$/| $$ $$ $$  /$$$$$$/| $$ $$ $$
			 /$$____/ | $$\ $$$$ /$$____/ | $$\ $$$$
			| $$      | $$ \ $$$| $$      | $$ \ $$$
			| $$$$$$$$|  $$$$$$/| $$$$$$$$|  $$$$$$/
			|________/ \______/ |________/ \______/ */
                                        
            if($my_theme == "Twenty Twenty")
            {
                /*
                ** Twenty Twenty Theme
                */
                function twentytwenty()
                {
                    //Twenty Twenty Assets Path
                    define('INCLUDE_ASSET_PATH', plugin_dir_url(dirname(__FILE__, 1)) . "assets/twentytwenty/");

                    //CSS
                    wp_deregister_style('classic-theme-styles');
                    wp_dequeue_style('classic-theme-styles');
                    wp_deregister_style('twentytwenty-style');
                    wp_dequeue_style('twentytwenty-style');
                    wp_deregister_style('twentytwenty-style-inline');
                    wp_dequeue_style('twentytwenty-style-inline');
                    wp_deregister_style('twentytwenty-print-style');
                    wp_dequeue_style('twentytwenty-print-style');                    
                    wp_enqueue_style('css', INCLUDE_ASSET_PATH . "style.min.css", array(), '6.1.1', 'all');

                    //JS
                    wp_dequeue_script('twentytwenty-js');
                    wp_deregister_script('twentytwenty-js');
                    remove_action('wp_head', 'twentytwenty_no_js_class');
                    wp_enqueue_script('h', INCLUDE_ASSET_PATH . "script-head.min.js", array(), '0.0.1', false);
                }
                add_action('wp_enqueue_scripts', 'twentytwenty', 20);
            }
			
		   /* /$$$$$$   /$$$$$$   /$$$$$$    /$$  
			 /$$__  $$ /$$$_  $$ /$$__  $$ /$$$$  
			|__/  \ $$| $$$$\ $$|__/  \ $$|_  $$  
			  /$$$$$$/| $$ $$ $$  /$$$$$$/  | $$  
			 /$$____/ | $$\ $$$$ /$$____/   | $$  
			| $$      | $$ \ $$$| $$        | $$  
			| $$$$$$$$|  $$$$$$/| $$$$$$$$ /$$$$$$
			|________/ \______/ |________/|______/ */
			
			if($my_theme == "Twenty Twenty-One")
			{
				function twentytwentyone()
				{            					
					//Twenty Twenty-One Assets Path
					define('INCLUDE_ASSET_PATH', plugin_dir_url(dirname(__FILE__, 1)) . "assets/twentytwentyone/");

					//CSS
					wp_dequeue_style('twenty-twenty-one-style');
					wp_deregister_style('twenty-twenty-one-style');
					wp_dequeue_style('twenty-twenty-one-print-style');
					wp_deregister_style('twenty-twenty-one-print-style');
					wp_dequeue_style('classic-theme-styles');
					wp_deregister_style('classic-theme-styles');
					wp_enqueue_style('css', INCLUDE_ASSET_PATH . "style.min.css", array(), '6.1.1', 'all');

					//JS
					remove_action('wp_footer', 'twentytwentyone_add_ie_class');
					remove_action('wp_footer', 'twenty_twenty_one_supports_js');
					wp_dequeue_script('twenty-twenty-one-ie11-polyfills');
					wp_deregister_script('twenty-twenty-one-ie11-polyfills');
					wp_enqueue_script('f', INCLUDE_ASSET_PATH . "script.min.js", array(), '0.0.1', true);  
				
				   /*
					** Skip Focus Link.
					*/
					if(get_option('focus_link') == "Yes")
					{		
						wp_dequeue_script('twenty_twenty_one_skip_link_focus_fix');
						wp_deregister_script('twenty_twenty_one_skip_link_focus_fix');  
						remove_action('wp_print_footer_scripts', 'twenty_twenty_one_skip_link_focus_fix');
					}
				}
				add_action('wp_enqueue_scripts', 'twentytwentyone', 20);
			}
		}
		
	   /* /$$$$$$   /$$$$$$   /$$$$$$   /$$$$$$ 
		 /$$__  $$ /$$$_  $$ /$$__  $$ /$$__  $$
		|__/  \ $$| $$$$\ $$|__/  \ $$|__/  \ $$
		  /$$$$$$/| $$ $$ $$  /$$$$$$/  /$$$$$$/
		 /$$____/ | $$\ $$$$ /$$____/  /$$____/ 
		| $$      | $$ \ $$$| $$      | $$      
		| $$$$$$$$|  $$$$$$/| $$$$$$$$| $$$$$$$$
		|________/ \______/ |________/|________/ */
		
        if($my_theme == "Twenty Twenty-Two")
        {
            function twentytwentytwo($plugin_url)
            {                   
                //Twenty Twenty Two Assets Path
                define('INCLUDE_ASSET_PATH', plugin_dir_url(dirname(__FILE__, 1)) . "assets/twentytwentytwo/");
                
                //CSS
                wp_dequeue_style('wp-block-site-logo');
                wp_deregister_style('wp-block-site-logo');
                wp_dequeue_style('wp-block-template-part');
                wp_deregister_style('wp-block-template-part');
                wp_dequeue_style('twentytwentytwo-style');
                wp_deregister_style('twentytwentytwo-style');       
                wp_enqueue_style('css', INCLUDE_ASSET_PATH . "style.min.css", array(), '6.1.1', 'all');

                //JS
                wp_dequeue_script('wp-block-navigation-view');
                wp_deregister_script('wp-block-navigation-view');   
                wp_dequeue_script('wp-block-navigation-view-2');
                wp_deregister_script('wp-block-navigation-view-2'); 
                wp_enqueue_script('h', INCLUDE_ASSET_PATH . "script.min.js", array(), '0.0.1', false);

                /*
                ** Skip Focus Link.
                */
                if(get_option('focus_link') == "Yes")
                {
                    remove_action('wp_footer', 'the_block_template_skip_link', 10);
                }
            }
            add_action('wp_enqueue_scripts', 'twentytwentytwo', 20);
        }  
		
	   /* /$$$$$$   /$$$$$$   /$$$$$$   /$$$$$$ 
		 /$$__  $$ /$$$_  $$ /$$__  $$ /$$__  $$
		|__/  \ $$| $$$$\ $$|__/  \ $$|__/  \ $$
		  /$$$$$$/| $$ $$ $$  /$$$$$$/   /$$$$$/
		 /$$____/ | $$\ $$$$ /$$____/   |___  $$
		| $$      | $$ \ $$$| $$       /$$  \ $$
		| $$$$$$$$|  $$$$$$/| $$$$$$$$|  $$$$$$/
		|________/ \______/ |________/ \______/ */
		
		if($my_theme == "Twenty Twenty-Three")
        {
			function twentytwentythree()
			{        
				//Twenty Twenty Three Assets Path
                define('INCLUDE_ASSET_PATH', plugin_dir_url(dirname(__FILE__, 1)) . "assets/twentytwentythree/");

				//CSS
				wp_enqueue_style('css', INCLUDE_ASSET_PATH . "style.css", array(), '6.1.1', 'all');
				wp_enqueue_style('css-print', INCLUDE_ASSET_PATH . "style-print.css", array(), '6.1.1', 'print');

				//JS
				wp_dequeue_script('wp-block-navigation-view');
				wp_deregister_script('wp-block-navigation-view');
				wp_dequeue_script('wp-block-navigation-view-2');
				wp_deregister_script('wp-block-navigation-view-2');
				wp_enqueue_script('js', INCLUDE_ASSET_PATH . "script.js", array(), '0.0.1', true);
				
				/*
                ** Skip Focus Link.
                */
                if(get_option('focus_link') == "Yes")
                {
					remove_action('wp_footer', 'the_block_template_skip_link');
				}
			}
			add_action('wp_enqueue_scripts', 'twentytwentythree', 20);
		}
		
		/*
        ** Add Defer Tag To JS files.
        */
        if(get_option('defer') == "Yes")
        {
            function add_async_attribute($tag, $handle)
            {
                return str_replace( 'src', ' defer src', $tag );
            }
            add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
        }
		
		/*
        ** Minify HTML.
        */
        if(get_option('compress_html') == "Yes")
        {
            if(!(is_admin()))
            {
                function minify_html()
                {
                    ob_start('html_compress');
                }

                function html_compress($buffer)
                {
                    $search = array(
                        '/\n/',
                        '/\>[^\S ]+/s',
                        '/[^\S ]+\</s',
                        '/(\s)+/s',
                        '~<!--//(.*?)-->~s',
                        '/\>\s+\</m'
                    );

                    $replace = array(
                        ' ',
                        '>',
                        '<',
                        '\\1',
                        '',
                        '><'
                    );

                    $buffer = preg_replace($search, $replace, $buffer);

                    return $buffer;
                }
                add_action('wp_loaded','minify_html');
            }
        }
	}
	add_action('init', 'optimise_speed_theme');
	
	$my_theme = wp_get_theme();
	
   /*
    ** Skip Focus Link. Twenty Twenty Theme.
	*/
	if($my_theme == "Twenty Twenty")
	{
		if(get_option('focus_link') == "Yes")
		{
			function twentytwenty_linkfocus($my_theme)
			{                   
				wp_dequeue_script('twentytwenty_skip_link_focus_fix');
				wp_deregister_script('twentytwenty_skip_link_focus_fix');
				remove_action( 'wp_print_footer_scripts', 'twentytwenty_skip_link_focus_fix');
			}
			add_action('wp_enqueue_scripts', 'twentytwenty_linkfocus');
		}
	}
}
?>