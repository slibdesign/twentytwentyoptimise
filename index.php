<?php
/**
* Plugin Name:      Twenty Twenty Optimise
* Description:      I built one of the fastest WordPress websites in the World and I used this plugin to do it. Read more on wpspeedupoptimise.com (TwentyTwenty WordPress parent theme required)
* Version:          3.0.0
* Author:           Slib Design
* Author URI:       https://swww.slibdesign.com
* Text Domain:      twentytwentyoptimise
* License:          GPL-2.0+
* License URI:      http://www.gnu.org/licenses/gpl-2.0.txt
*/


require("inc/settings.php");

require("inc/optimise.php"); 

function twenty_twenty_optimise_options_page()
{
?>

<div>

	<h2>Twenty Twenty Optimise Settings</h2>
	<p>Make your <a href="https://en-gb.wordpress.org/themes/twentytwenty/" target="_blank">TwentyTwenty WordPress theme</a> run faster by turning on these settings. Please note that this plugin only works with an active TwentyTwenty parent theme.</p>
	<p>This plugin was used to build <a href="https://www.wpspeedupoptimisation.com/" target="_blank">one of the fastest WordPress websites in the World</a>. Visit the website to follow all the speed optimisation steps for yourself. Plugin coded by <a href="https://www.slibdesign.com" target="_blank">"Mr WordPress" - slibdesign.com</a></p>
	
	<h2>Speed Settings:</h2>
	<form method="post" action="options.php">
		
		<?php settings_fields( 'twenty_twenty_optimise_options_group' ); ?>

		<table>
			<tr>
				<td>
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
					<p><label><input size="76" type="checkbox" name="tto_7" id="tto_7" <?php if((get_option('tto_7') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
					Disable REST API</label></p>
				</td>
			</tr>
			<tr>
				<td>
					<p><label><input size="76" type="checkbox" name="tto_8" id="tto_8" <?php if((get_option('tto_8') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
					Remove CSS &amp; JS query string</label></p>
				</td>
			</tr>
			<tr>
				<td>
					<p><label><input size="76" type="checkbox" name="tto_9" id="tto_9" <?php if((get_option('tto_9') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
					Disable oembed</label></p> 
				</td>
			</tr>
			<tr>
				<td>
					<p><label><input size="76" type="checkbox" name="tto_10" id="tto_10" <?php if((get_option('tto_10') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' > 
					Remove HTML comments</label></p>
				</td> 
			</tr>
			
			<tr>
				<td> 
					<p><label><input size="76" type="checkbox" name="tto_12" id="tto_12" <?php if((get_option('tto_12') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' >  Combine CSS &amp; JS Files
					</label></p>
					<?php
					if(get_option('tto_13') == "normal")
					{
						?>
						 <p><label><input type="radio" name="tto_13" value="websafe"> Websafe - Impact and Arial font families</label><br><br>
						 <label><input type="radio" name="tto_13" value="normal" checked> Normal - Default TwentyTwenty font families</label></p>
						<?php
					}
					else
					{
						?>
						 <p><label><input type="radio" name="tto_13" value="websafe" checked> Websafe - Impact and Arial font families</label><br><br>
						 <label><input type="radio" name="tto_13" value="normal"> Normal - Default TwentyTwenty font families</label></p>
						<?php
					}
					?>
				</td>
			</tr> 
			<tr>
				<td>
					<p><label><input size="76" type="checkbox" name="tto_14" id="tto_14" <?php if((get_option('tto_14') == "Yes")) { echo ' checked="checked" '; } ?> value='Yes' >Defer .js file
					</label></p>
				</td>
			</tr> 
			<tr>
				<td>
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
?>