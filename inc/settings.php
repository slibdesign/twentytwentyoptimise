<?php
if(!defined('ABSPATH'))
{
    exit;
}

function theme_register_settings()
{
  // Disable php error reporting before theme is loaded.
	register_setting('theme_options_group', 'php_reporting', 'tto_callback');

  // Remove print styles including emoji support.
	register_setting('theme_options_group', 'emoji_support', 'tto_callback');

  // Disable XML-RPC.
	register_setting('theme_options_group', 'ping_backs', 'tto_callback');

  // Remove Short Link.
	register_setting('theme_options_group', 'short_link', 'tto_callback');

  // Remove Feed Links.
	register_setting('theme_options_group', 'feed_links', 'tto_callback');

  // Disable Admin Bar.
	register_setting('theme_options_group', 'admin_bar', 'tto_callback');

  // Disable REST API.
	register_setting('theme_options_group', 'rest_api', 'tto_callback');

  // Disable embeds.
	register_setting('theme_options_group', 'oembed', 'tto_callback');

  // Remove HTML <!-- -->.
	register_setting('theme_options_group', 'html_comments', 'tto_callback');

  // Optimise CSS and JS with custom files.
	register_setting('theme_options_group', 'compress_html', 'tto_callback');

  // Twenty TwentyOne Theme: Remove Script Tags.
	register_setting('theme_options_group', 'combine_css_js_files', 'tto_callback');

  // Add Defer Tag To JS files.
	register_setting('theme_options_group', 'defer', 'tto_callback');

  // Twenty TwentyOne Theme: Remove Script Tags.
	register_setting('theme_options_group', 'combine_js_files', 'tto_callback');

  // Add Preload tag to CSS files.
	register_setting('theme_options_group', 'preload', 'tto_callback');

  //Twenty Twenty: Custom Font
  register_setting('theme_options_group', 'custom_font', 'tto_callback');

  // Twenty TwentyTwo Theme: Skip Link.
	register_setting('theme_options_group', 'focus_link', 'tto_callback');

  // Twenty Twenty Theme: Remove CSS Fonts
	register_setting('theme_options_group', 'css_fontless', 'tto_callback');
}
add_action( 'admin_init', 'theme_register_settings' );

function tto_register_options_page()
{
  add_menu_page('Theme Settings', 'Theme Settings', 'manage_options', 'slibdesign', 'theme_options_page','dashicons-superhero-alt', 60);
}
add_action('admin_menu', 'tto_register_options_page');
?>
