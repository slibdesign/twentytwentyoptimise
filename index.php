<?php
/*
* Plugin Name:	Twenty Twenty Optimise
* Description:  A WordPress plugin to improve the speed of the three most popular WordPress themes.
* Version:      1.7.0
* Author:       Slib Design
* Author URI:   https://www.slibdesign.com
* Text Domain: 	slibdesign
* License:      GNU
*/

if(!defined('ABSPATH'))
{
  exit;
}

define('SD_PLUGIN_PATH', plugin_dir_path( __FILE__ ));

require_once(SD_PLUGIN_PATH. "/inc/settings.php");
require_once(SD_PLUGIN_PATH. "/inc/optimise.php");

function theme_options_page()
{
  require_once(SD_PLUGIN_PATH. "/inc/functions.php");

	if((wp_get_theme("Twenty Twenty")) ||
     (wp_get_theme("Twenty Twenty-One")) ||
     (wp_get_theme("Twenty Twenty-Two")))
	{
    $my_theme = wp_get_theme();
	?>
	<div>
		<h3><?php echo esc_attr($my_theme->get('Name')); ?> Theme Settings</h3>
		<p>This plugin improves the page speed of the three most popular WordPress themes.</p>
		<h3>Settings</h3>
		<form method="post" action="options.php">

			<?php settings_fields('theme_options_group'); ?>

			<table>
				<tr>
					<td>
						<h4>General</h4>
						<p><label><input size="3" type="checkbox" name="php_reporting" id="php_reporting" <?php show_checked("php_reporting"); ?> value="Yes">
						Disable PHP error reporting</label></p>
					</td>
				</tr>
				<tr>
					<td>
						<p><label><input size="3" type="checkbox" name="emoji_support" id="emoji_support" <?php show_checked("emoji_support"); ?> value="Yes">
						Disable emoji support</label></p>
					</td>
				</tr>
				<tr>
					<td>
						<p><label><input size="3" type="checkbox" name="ping_backs" id="ping_backs" <?php show_checked("ping_backs"); ?> value="Yes">
						Disable ping backs</label></p>
					</td>
				</tr>
				<tr>
					<td>
						<p><label><input size="3" type="checkbox" name="short_link" id="short_link" <?php show_checked("short_link"); ?> value="Yes">
						Remove short Link</label></p>
					</td>
				</tr>
				<tr>
					<td>
						<p><label><input size="3" type="checkbox" name="feed_links" id="feed_links" <?php show_checked("feed_links"); ?> value="Yes">
						Remove feed links </label></p>
					</td>
				</tr>
				<tr>
					<td>
						<p><label><input size="3" type="checkbox" name="admin_bar" id="admin_bar" <?php show_checked("admin_bar"); ?> value="Yes">
						Disable admin bar</label></p>
					</td>
				</tr>
				<tr>
					<td>
						<p><label><input size="3" type="checkbox" name="rest_api" id="rest_api" <?php show_checked("rest_api"); ?> value="Yes">
						Disable REST API for all non logged in users</label></p>
					</td>
				</tr>
				<tr>
					<td>
						<p><label><input size="3" type="checkbox" name="oembed" id="oembed" <?php show_checked("oembed"); ?> value="Yes">
						Disable oembed</label></p>
					</td>
				</tr>
				<tr>
					<td><h4>HTML</h4>
						<p><label><input size="3" type="checkbox" name="html_comments" id="html_comments" <?php show_checked("html_comments"); ?> value="Yes">
						Remove HTML comments</label></p>
					</td>
				</tr>
				<tr>
					<td>
						<h4>CSS</h4>
						<p><label><input size="3" type="checkbox" name="preload" id="preload" <?php show_checked("preload"); ?> value="Yes">
						Add preload tag to .css files</label></p>
					</td>
				</tr>
				<?php

				if($my_theme == "Twenty Twenty-One")
				{
				?>
				<tr>
					<td>
						<h4>JS</h4>
						<p><label><input size="3" type="checkbox" name="combine_js_files" id="combine_js_files" <?php show_checked("combine_js_files"); ?> value="Yes" >  Twenty Twenty One theme: Combine CSS &amp; JS theme files
						</label></p>
					</td>
				</tr>
				<tr>
					<td>
						<h4>JS Script Management</h4>
						<p><label><input size="4" type="radio" name="combine_js_files" id="combine_js_files" <?php show_checked("combine_js_files",  "none"); ?> value="none" checked> (Standard) None of these
						</label></p>
					</td>
				</tr>
				<tr>
					<td>
            <p><label><input size="9" type="radio" name="combine_js_files" id="combine_js_files" <?php show_checked("combine_js_files",  "yesjsfile"); ?> value="yesjsfile">  Twenty Twenty One theme: Include inline js in a .js file
						</label></p>
					</td>
				</tr>
				<tr>
					<td>
            <p><label><input size="8" type="radio" name="combine_js_files" id="combine_js_files" <?php show_checked("combine_js_files",  "nojsfile"); ?> value="nojsfile">  Twenty Twenty One theme: Removes inline js from source code
						</label></p>
					</td>
				</tr>

				<?php
				}
				if($my_theme == "Twenty Twenty")
				{
				?>
				<tr>
					<td>
						<p><label><input size="3" type="checkbox" name="combine_css_js_files" id="combine_css_js_files" <?php show_checked("combine_css_js_files"); ?> value="Yes">  Twenty Twenty theme: Combine CSS &amp; JS theme files
						</label></p>
					</td>
				</tr>

				<tr>
					<td>
						<p><label><input size="3" type="checkbox" name="combine_js_files" id="combine_js_files" <?php show_checked("combine_js_files"); ?> value="Yes">  Twenty Twenty theme: Include footer script tags as .js file
						</label></p>
					</td>
				</tr>
				<tr>
					<td>
						<p><label><input size="3" type="checkbox" name="custom_font" id="custom_font" <?php show_checked("custom_font"); ?> value="Yes">  Twenty Twenty theme: Remove custom font
						</label></p>
					</td>
				</tr>
				<?php
				}
				?>
				<?php
				if($my_theme == "Twenty Twenty-Two")
				{
				?>
				<tr>
					<td>
						<p><label><input size="3" type="checkbox" name="combine_css_js_files" id="combine_css_js_files" <?php show_checked("combine_css_js_files"); ?> value="Yes">  Twenty Twenty Two theme: Combine CSS &amp; JS theme files
						</label></p>
					</td>
				</tr>
				<tr>
					<td>
						<p><label><input size="3" type="checkbox" name="focus_link" id="focus_link" <?php show_checked("focus_link"); ?> value="Yes">  Twenty Twenty Two theme: Disable link focus
						</label></p>
					</td>
				</tr>
				<tr>
					<td>
						<p><label><input size="3" type="checkbox" name="css_fontless" id="css_fontless" <?php show_checked("css_fontless"); ?> value="Yes">  Twenty Twenty Two theme: Load stylesheet without custom font
						</label></p>
					</td>
				</tr>
				<?php
				}
				?>
				<tr>
					<td>
						<p><label><input size="3" type="checkbox" name="defer" id="defer" <?php show_checked("defer"); ?> value="Yes"> Add defer tag to .js files
						</label></p>
					</td>
				</tr>
				<tr>
					<td>
						<h4>All files</h4>
						<p><label><input size="3" type="checkbox" name="compress_html" id="compress_html" <?php show_checked("compress_html"); ?> value="Yes">
						Compress HTML</label></p>
					</td>
				</tr>

			</table>

			<?php submit_button(); ?>

		</form>
	</div>

	<?php
	}
	else
	{
		?>
		<h3>Twenty Twenty Optimise Plugin Error</h3>
		<p>Please make sure you are running the Twenty Twenty, Twenty Twenty-One or Twenty Twenty-Two WordPress theme to use this plugin.</p>
		<p>Visit <a href="https://wpspeedupoptimisation.com/" target="_Blank">wpspeedupoptimisation.com</a> for further assistance.</p>
		<?php
	}
}
?>
