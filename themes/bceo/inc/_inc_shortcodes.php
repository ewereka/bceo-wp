<?php

function shortcode_by_the_numbers() {
  get_template_part('template-part', 'by-the-numbeers');
}

add_shortcode('by_the_numbers', 'shortcode_by_the_numbers');