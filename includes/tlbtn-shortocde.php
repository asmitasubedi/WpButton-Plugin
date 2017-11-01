<?php


if (!is_admin())
{
  add_filter('widget_text', 'do_shortcode');
}
add_shortcode('tlbtns', 'custombutton_shortcode');
