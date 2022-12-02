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

/*
** Register Form Settings.
*/
function twenty_twenty_optimise_register_settings() 
{ 	
	register_setting('twenty_twenty_optimise_options_group', 'php_reporting');
	register_setting('twenty_twenty_optimise_options_group', 'emoji_support');
	register_setting('twenty_twenty_optimise_options_group', 'ping_backs');
	register_setting('twenty_twenty_optimise_options_group', 'short_link');
	register_setting('twenty_twenty_optimise_options_group', 'feed_links');
	register_setting('twenty_twenty_optimise_options_group', 'admin_bar');
	register_setting('twenty_twenty_optimise_options_group', 'rest_api');
	register_setting('twenty_twenty_optimise_options_group', 'oembed');
	register_setting('twenty_twenty_optimise_options_group', 'html_comments');
	register_setting('twenty_twenty_optimise_options_group', 'compress_html');
	register_setting('twenty_twenty_optimise_options_group', 'optimise_css_js_files'); 
	register_setting('twenty_twenty_optimise_options_group', 'focus_link');
	register_setting('twenty_twenty_optimise_options_group', 'defer');
	register_setting('twenty_twenty_optimise_options_group', 'gutenberg');
}
add_action( 'admin_init', 'twenty_twenty_optimise_register_settings' );

/*
** Create Admin Settings Options Page
*/
function twenty_twenty_optimise_register_options_page() 
{
	add_options_page('Twenty Twenty Optimise Settings', 'Twenty Twenty Optimise', 'manage_options', 'twentytwentyoptimise', 'twenty_twenty_optimise_options_page');
}
add_action('admin_menu', 'twenty_twenty_optimise_register_options_page');
?>