<?php
if(!defined('ABSPATH'))
{
  exit;
}

/* WordPress form checkbox and radio option checked selection */
function show_checked($_option, $_additional = 1)
{
  $option = sanitize_text_field($_option);
  $additional = sanitize_text_field($_additional);

  if((get_option($option) === "Yes"))
  {
    echo esc_attr( "checked='checked'" );
  }
  else
  {
    if(((get_option($option) === $additional)))
    {
      echo esc_attr( "checked='checked'" );
    }
  }
}
?>
