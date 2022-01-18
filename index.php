<?php
/*
* Plugin Name:	Twenty Twenty Optimise
* Description:  An opensource project which improves the speed of the two most popular WordPress themes. Make your Twenty Twenty or Twenty Twenty-One WordPress theme website run faster using this plugin.
* Version:      4.0.0
* Author:       SLIB Design
* Author URI:   https://www.slibdesign.com
* Text Domain: 	twentytwentyoptimise
* License:      GPL2+
*/


require("inc/settings.php");

require("inc/optimise.php"); 

function twenty_twenty_optimise_options_page()
{
	$my_theme = wp_get_theme();

	if(($my_theme == "Twenty Twenty") || ($my_theme == "Twenty Twenty-One"))
	{ 
?>
<div>
	<h3>Twenty Twenty Optimise Settings</h3>
	<p>An opensource project which improves the speed of the two most popular WordPress themes.</p>
	<h3>Purpose</h3>
	<p>Search engines rank websites that are fast better and user experience is improved if users can access more content quickly.</p>
	<p>Make your Twenty Twenty or Twenty Twenty-One WordPress theme website run faster using this plugin.</p>
	<h3>Disable/Enable</h3>	
	<form method="post" action="options.php">
		
		<?php settings_fields( 'twenty_twenty_optimise_options_group' ); ?>

		<table>
			<tr>
				<td>
					<h4>General</h4>
					<p><label><input size="76" type="checkbox" name="tto_1" id="speed_theme_3" <?php if((get_option('tto_1') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
					Disable PHP error reporting</label></p>
				</td>
			</tr>
			<tr>
				<td>
					<p><label><input size="76" type="checkbox" name="tto_2" id="tto_2" <?php if((get_option('tto_2') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
					Disable emoji support</label></p>
				</td>
			</tr>
			<tr>
				<td>
					<p><label><input size="76" type="checkbox" name="tto_3" id="tto_3" <?php if((get_option('tto_3') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
					Disable ping backs</label></p>
				</td>
			</tr>
			<tr>
				<td>
					<p><label><input size="76" type="checkbox" name="tto_4" id="tto_4" <?php if((get_option('tto_4') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
					Remove short Link</label></p>
				</td>
			</tr>
			<tr>
				<td>
					<p><label><input size="76" type="checkbox" name="tto_5" id="tto_5" <?php if((get_option('tto_5') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
					Remove feed links </label></p>
				</td>
			</tr>
			<tr>
				<td>
					<p><label><input size="76" type="checkbox" name="tto_6" id="tto_6" <?php if((get_option('tto_6') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
					Disable admin bar</label></p>
				</td>
			</tr>
			<tr>
				<td>
					<h4>API</h4>
					<p><label><input size="76" type="checkbox" name="tto_7" id="tto_7" <?php if((get_option('tto_7') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
					Disable REST API for all non logged in users</label></p>
				</td>
			</tr>
			<tr>
				<td>
					<p><label><input size="76" type="checkbox" name="tto_9" id="tto_9" <?php if((get_option('tto_9') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
					Disable oembed</label></p> 
				</td>
			</tr>
			<tr>
				<td><h4>HTML</h4>
					<p><label><input size="76" type="checkbox" name="tto_10" id="tto_10" <?php if((get_option('tto_10') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
					Remove HTML comments</label></p>
				</td> 
			</tr>
			<tr>
				<td>
					<h4>CSS</h4>
					<p><label><input size="76" type="checkbox" name="tto_17" id="tto_17" <?php if((get_option('tto_17') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
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
					<p><label><input size="76" type="checkbox" name="tto_12" id="tto_12" <?php if((get_option('tto_12') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' >  Twenty Twenty One theme: Combine CSS &amp; JS theme files
					</label></p>
				</td>
			</tr> 
			
			<?php
			if((get_option('tto_16') != "yesjsfile") && (get_option('tto_16') != "nojsfile"))
			{
				$tempvar = "none";
			}
			?>
			
			<tr>
				<td> 
					<h4>JS Script Management</h4>
					<p><label><input size="76" type="radio" name="tto_16" id="tto_16" <?php if($tempvar == "none") { echo ' checked="checked" '; } ?> value='none' >  None of these
					</label></p>
				</td>
			</tr>
			<tr>
				<td> 
					<p><label><input size="76" type="radio" name="tto_16" id="tto_16" <?php if((get_option('tto_16') == "yesjsfile")) { echo ' checked="checked" '; } ?> value='yesjsfile' >  Twenty Twenty One theme: Include inline js in a .js file
					</label></p>
				</td>
			</tr> 
			<tr>
				<td> 
					<p><label><input size="76" type="radio" name="tto_16" id="tto_16" <?php if((get_option('tto_16') == "nojsfile")) { echo ' checked="checked" '; } ?> value='nojsfile' >  Twenty Twenty One theme: Remove inline js completely
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
					<p><label><input size="76" type="checkbox" name="tto_12" id="tto_12" <?php if((get_option('tto_12') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' >  Twenty Twenty theme: Combine CSS &amp; JS theme files
					</label></p>
				</td>
			</tr> 
			
			<tr>
				<td> 
					<p><label><input size="76" type="checkbox" name="tto_16" id="tto_16" <?php if((get_option('tto_16') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' >  Twenty Twenty theme: Include footer script tags as .js file
					</label></p>
				</td>
			</tr> 
			<?php
			}
 			?>
			<tr>
				<td>
					<p><label><input size="76" type="checkbox" name="tto_14" id="tto_14" <?php if((get_option('tto_14') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' >Add defer tag to .js files
					</label></p>
				</td>
			</tr> 
			<tr>
				<td>
					<h4>All files</h4>
					<p><label><input size="76" type="checkbox" name="tto_11" id="tto_11" <?php if((get_option('tto_11') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
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
		<h3>Twenty Twenty Optimise Error</h3>
		<p>Make sure you are running the Twenty Twenty or Twenty Twenty-One WordPress theme to use this plugin.</p>
		<p>Visit <a href="https://wpspeedupoptimisation.com/" target="_Blank">wpspeedupoptimisation.com</a> for help.</p>
		<?php		
	}
}
?>