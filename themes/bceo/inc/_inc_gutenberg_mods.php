<?php

/** Functions */
function ewereka_gutenberg_scripts()
{
  wp_enqueue_script(
    "ewereka-gutenberg-scripts",
    get_stylesheet_directory_uri() . "/js/dist/editor.js",
    ["wp-blocks", "wp-dom"],
    get_stylesheet_directory() . "/assets/js/editor.js",
    true
  );
}

function ewereka_gutenberg_setup()
{
  add_theme_support("disable-custom-colors");
  add_theme_support("disable-custom-colors");
  add_theme_support("editor-color-palette");
  add_theme_support("editor-gradient-presets", []);
  add_theme_support("disable-custom-gradients");
  add_theme_support("editor-styles");
  add_editor_style("css/editor.css");
}

/** Actions */
add_action("enqueue_block_editor_assets", "ewereka_gutenberg_scripts");
add_action("after_setup_theme", "ewereka_gutenberg_setup");
