<?php
/*
* Plugin Name:      Twenty Twenty Optimise
* Description:      A WordPress plugin to improve the speed of the seven most popular WordPress themes.
* Version:          1.8.0
* Author:           Slib Design
* Author URI:       https://www.slibdesign.com
* Text Domain:      twentytwentyoptimise
*/

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

require_once(plugin_dir_path( __FILE__ ) . "/inc/settings.php");
require_once(plugin_dir_path( __FILE__ ) . "/inc/optimise.php");

/*
* WP Admin Interface
*/
function twenty_twenty_optimise_options_page()
{
	$theme = wp_get_theme();

    if((($theme == "Twenty Twenty-Three") || ($theme == "Twenty Twenty-Two") || ($theme == "Twenty Twenty-One") || ($theme == "Twenty Twenty") || ($theme == "Twenty Nineteen") || ($theme == "Twenty Seventeen") || ($theme == "Twenty Sixteen")) && 
        (get_template_directory() === get_stylesheet_directory()))
    {
    $my_theme = wp_get_theme();
	?>
	<div>
		<h3><?php echo esc_attr($my_theme->get('Name')); ?> Theme Settings</h3>
        <p>This plugin improves the page load speed of the <?php echo esc_attr($my_theme->get('Name')); ?> WordPress parent theme.</p>
        <h3>Settings</h3>
        <form method="post" action="options.php">
			<?php settings_fields( 'twenty_twenty_optimise_options_group' ); ?>
			<table>
				<tr>
					<td>
						<h4>General</h4>
						<p><label><input size="76" type="checkbox" name="php_reporting" id="php_reporting" <?php if((get_option('php_reporting') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
						Disable PHP error reporting</label></p>
					</td>
				</tr>
				<tr>
					<td>
						<p><label><input size="76" type="checkbox" name="emoji_support" id="emoji_support" <?php if((get_option('emoji_support') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
						Disable emoji support</label></p>
					</td>
				</tr>
				<tr>
					<td>
						<p><label><input size="76" type="checkbox" name="ping_backs" id="ping_backs" <?php if((get_option('ping_backs') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
						Disable ping backs</label></p>
					</td>
				</tr>
				<tr>
					<td>
						<p><label><input size="76" type="checkbox" name="short_link" id="short_link" <?php if((get_option('short_link') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
						Remove short Link</label></p>
					</td>
				</tr>
				<tr>
					<td>
						<p><label><input size="76" type="checkbox" name="feed_links" id="feed_links" <?php if((get_option('feed_links') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
						Remove feed links </label></p>
					</td>
				</tr>
				<tr>
					<td>
						<p><label><input size="76" type="checkbox" name="admin_bar" id="admin_bar" <?php if((get_option('admin_bar') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
						 Remove admin bar</label></p>
					</td>
				</tr>
				
				<tr>
					<td>
						<p><label><input size="76" type="checkbox" name="oembed" id="oembed" <?php if((get_option('oembed') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
						Disable oEmbed</label></p> 
					</td>
				</tr>
				<tr>
					<td>
						
						<p><label><input size="76" type="checkbox" name="focus_link" id="focus_link" <?php if((get_option('focus_link') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
						 Disable link focus</label></p>
					</td> 
				</tr>
				<tr>
					<td>
						<h4>REST API</h4>
						<p><label><input size="76" type="checkbox" name="rest_api" id="rest_api" <?php if((get_option('rest_api') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
						Disable REST API for all non logged in users</label></p>
					</td>
				</tr>
				
				<tr>
					<td>
						<h4>HTML</h4>
						<p><label><input size="76" type="checkbox" name="html_comments" id="html_comments" <?php if((get_option('html_comments') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
						Remove HTML comments</label></p>
					</td> 
				</tr>
				<tr>
					<td>
						<h4>Combine JS and CSS</h4>
						<p><label><input size="76" type="checkbox" name="optimise_css_js_files" id="optimise_css_js_files" <?php if((get_option('optimise_css_js_files') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
						 Optimise .js and .css files</label></p>
					</td> 
				</tr>
				<tr>
					<td>
						<h4>Defer JS</h4>
						<p><label><input size="76" type="checkbox" name="defer" id="defer" <?php if((get_option('defer') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' >Add defer tag to .js files
						</label></p>
					</td>
				</tr> 
				<tr>
                    <td>
                        <h4>Disable Gutenberg</h4>
                        <p><label><input size="3" type="checkbox" name="gutenberg" id="gutenberg" <?php if((get_option("gutenberg") == "Yes")) { echo 'checked="checked" '; } ?> value="Yes" > Disable Gutenberg
                        </label></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>Minification</h4>
                        <p><label><input size="3" type="checkbox" name="compress_html" id="compress_html" <?php if((get_option("compress_html") == "Yes")) { echo 'checked="checked" '; } ?> value="Yes">
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
        <p>This plugin only works with the following parent themes:</p>
        <ul>
			<li>Twenty Twenty-Three</li>
            <li>Twenty Twenty-Two</li>
            <li>Twenty Twenty-One</li>
            <li>Twenty Twenty</li>
            <li>Twenty Nineteen</li>
            <li>Twenty Sixteen</li>
        </ul>
		<?php		
	}
}
?>