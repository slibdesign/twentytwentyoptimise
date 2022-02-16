<?php
if(!defined('ABSPATH')) 
{
    exit; 
}


function twenty_twenty_optimise_register_settings() 
{ 	
	register_setting('twenty_twenty_optimise_options_group', 'tto_1', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_2', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_3', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_4', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_5', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_6', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_7', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_8', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_9', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_10', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_11', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_12', 'tto_callback'); 
	register_setting('twenty_twenty_optimise_options_group', 'tto_13', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_13', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_14', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_15', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_16', 'tto_callback');	
	register_setting('twenty_twenty_optimise_options_group', 'tto_17', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_19', 'tto_callback');
	register_setting('twenty_twenty_optimise_options_group', 'tto_20', 'tto_callback');
}
add_action( 'admin_init', 'twenty_twenty_optimise_register_settings' );


function tto_register_options_page() 
{
	add_options_page('Twenty Twenty Optimise Settings', 'Twenty Twenty Optimise', 'manage_options', 'twentytwentyoptimise', 'twenty_twenty_optimise_options_page');
}
add_action('admin_menu', 'tto_register_options_page');
?>