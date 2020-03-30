<?php
/* Remove comment style from head */
function optimise_speed_pre_setup()
{

	/* Disable php error reporting */
	if(get_option('tto_1') == "Yes")
	{ 
		define('WP_DEBUG', false);
		define('WP_DEBUG_DISPLAY', false);
		ini_set('display_errors','Off');
		ini_set('error_reporting', E_ALL );
	}
}
add_action( 'setup_theme', 'optimise_speed_pre_setup' );


function optimise_speed_theme()
{
	/* Remove emoji styles */	
	if(get_option('tto_2') == "Yes")
	{
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_print_styles', 'print_emoji_styles');
		add_filter( 'emoji_svg_url', '__return_false' );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
	}


	/* Remove Ping Backs */	
	if(get_option('tto_3') == "Yes")
	{
		add_filter('xmlrpc_enabled', '__return_false');
		add_filter( 'wp_headers', 'disable_x_pingback' );

		function disable_x_pingback( $headers ) 
		{
			unset( $headers['X-Pingback'] );
			return $headers;
		}	
		add_filter('pings_open', '__return_false', PHP_INT_MAX);


		function disable_pingback( &$links )
		{
			foreach ( $links as $l => $link )
			if ( 0 === strpos( $link, get_option( 'home' ) ) )
			unset($links[$l]);
		}
		add_action( 'pre_ping', 'disable_pingback' );
	}


	/* Remove Short Link */	
	if(get_option('tto_4') == "Yes")
	{
		remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	}
	
	
	/* Remove Feed Links */	
	if(get_option('tto_5') == "Yes")
	{
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action('wp_head', 'rsd_link'); 
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'wp_generator'); 
		remove_action('wp_head', 'wp_shortlink_wp_head');
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action('wp_head', 'feed_links_extra', 3 );
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
		add_filter('avf_profile_head_tag','avia_remove_profile');
			function avia_remove_profile(){ 
			return false;
		}
	}
	
	
	/* Disable Admin Bar */
	if(get_option('tto_6') == "Yes")
	{
		add_filter('show_admin_bar', '__return_false');
	}

	
	/* Disable REST API */	
	if(get_option('tto_7') == "Yes")
	{
		add_filter('rest_enabled', '__return_false');
		add_filter('rest_jsonp_enabled', '__return_false');
		remove_action('wp_head', 'rest_output_link_wp_head', 10);
	}

	
	/* Remove Script & Style Query String */
	if(get_option('tto_8') == "Yes")
	{
		function _remove_script_version( $src )
		{ 
			$parts = explode( '?', $src ); 	

			if((substr( $parts[0], 0, 32 ) == "https://fonts.googleapis.com/css") ||
			  (substr( $parts[0], 0, 31 ) == "http://fonts.googleapis.com/css"))
			{
				return $src;
			}
			else
			{
				return $parts[0]; 
			}

		} 
		add_filter( 'script_loader_src', '_remove_script_version', 15, 1 ); 
		add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
	}


	/* Disable oEmbed */	
	if(get_option('tto_9') == "Yes")
	{
		remove_action('rest_api_init', 'wp_oembed_register_route');
		remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
		remove_action('wp_head', 'wp_oembed_add_discovery_links');
		remove_action('wp_head', 'wp_oembed_add_host_js');
	}

	/* Remove HTML Comments */
	if(get_option('tto_10') != "")
	{
		function callback($buffer){ $buffer = preg_replace('/<!--(.|s)*?-->/', '', $buffer); return $buffer; }
		function buffer_start(){ ob_start("callback"); }
		function buffer_end(){ ob_end_flush(); }
		add_action('get_header', 'buffer_start');
		add_action('wp_footer', 'buffer_end');
	}

	/* Combine CSS */
	if(get_option('tto_12') == "Yes")
	{
		function twentynineteen_remove_scripts() 
		{
			$plugin_url = plugin_dir_url( __FILE__ );

			wp_dequeue_style( 'wp-block-library' );
			wp_dequeue_style( 'wp-block-library-theme' );

			wp_dequeue_style( 'twentytwenty-style' );
			wp_deregister_style( 'twentytwenty-style' );

			wp_dequeue_style( 'twentytwenty-print-style' );
			wp_deregister_style( 'twentytwenty-print-style' );
			
			if(get_option('tto_14') == "normal")
			{
				wp_enqueue_style( 'twentytwenty-style-optimised', $plugin_url . "files/twentytwenty/style-all.min.css", array(), null );   
			}
			else
			{
				wp_enqueue_style( 'twentytwenty-style-web-safe-fonts-optimised', $plugin_url . "files/twentytwenty/style-all-web-safe-fonts.min.css", array(), null );  
			}
			
			wp_dequeue_script( 'twentytwenty-js' );
			wp_deregister_script( 'twentytwenty-js' );

			wp_enqueue_script( 'twentytwenty-scripts-speed-theme-optimised', $plugin_url . "files/twentytwenty/scripts-all.min.js", array(), null );  
			
			remove_action( 'wp_print_footer_scripts', 'twentytwenty_skip_link_focus_fix' );
			remove_action( 'wp_head', 'twentytwenty_no_js_class' );
			
		}
		add_action( 'wp_enqueue_scripts', 'twentynineteen_remove_scripts', 20 );
	}
	
		
	/* Defer JS */
	if(get_option('tto_13') == "Yes")
	{
		function add_async_attribute($tag, $handle) 
		{
			return str_replace( 'src', ' defer src', $tag );
		}
		add_filter('script_loader_tag', 'add_async_attribute', 10, 2);	
	}


	/* Minify HTML */
	if(get_option('tto_11') == "Yes")
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
					'/\n/',         	// replace end of line by a space
					'/\>[^\S ]+/s',     // strip whitespaces after tags, except space
					'/[^\S ]+\</s',     // strip whitespaces before tags, except space
					'/(\s)+/s',     	// shorten multiple whitespace sequences,
					'~<!--//(.*?)-->~s', //html comments
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
add_action( 'init', 'optimise_speed_theme' );
?>
