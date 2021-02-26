<?php

function shortcode_by_the_numbers()
{
  ob_start();
  get_template_part("partials/by-the-numbers");
  $var = ob_get_contents();
  ob_end_clean();
  return $var;
}

add_shortcode("by_the_numbers", "shortcode_by_the_numbers");
