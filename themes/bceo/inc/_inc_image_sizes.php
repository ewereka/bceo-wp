<?php
add_action("after_setup_theme", "bceo_add_image_sizes");
function bceo_add_image_sizes()
{
  add_image_size("featured-image", 1600, 900, true);
  add_image_size("featured-image-md", 600, 300, true);
  add_image_size("featured-image-sm", 300, 150, true);
}

add_filter("image_size_names_choose", "bceo_image_size_names_choose");
function bceo_image_size_names_choose($sizes)
{
  return array_merge($sizes, [
    "featured-image" => __("Featured Image", "com.ewereka.bceo.theme"),
    "featured-image-md" => __(
      "Featured Image (Medium)",
      "com.ewereka.bceo.theme"
    ),
    "featured-image-sm" => __(
      "Featured Image (Small)",
      "com.ewereka.bceo.theme"
    ),
  ]);
}

/* Add JFIF image file type for uploads */
add_filter("upload_mimes", "custom_myme_types", 1, 1);
function custom_myme_types($mime_types)
{
  $mime_types["jfif"] = "image/jfif+xml"; // Adding .jfif extension
  return $mime_types;
}
