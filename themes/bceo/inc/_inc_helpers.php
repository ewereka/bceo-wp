<?php
function get_relative_file_path($file) {
  $file = (strlen($file) > 0) ? $file : false;
  $output = false;
  if ($file) {
    $file = parse_url($file);
    $output = (strlen($file["path"]) > 0) ? $file["path"] : false;
  }
  return $output;
}

function relative_template_path($echo = false) {
  $echo = (is_bool($echo)) ? $echo : false;
  $tempPath = parse_url(get_bloginfo("template_url"));
  $path = $tempPath["path"];
  if(substr($path, -1) == "/") {
    $path = substr($path, 0, -1);
  }
  if ($echo) {
    echo $path;
  } else {
    return $path;
  }
}

function theme_asset($path, $echo = true) {
  $echo = (is_bool($echo)) ? $echo : true;

  $prefix = relative_template_path();
  $path = sprintf('%s/%s', relative_template_path(), ltrim($path, '/'));

  if ($echo) {
    echo $path;
  } else {
    return $path;
  }
}

function home_path($trailingSlash = false) {
  $path = ABSPATH;
  if (file_exists(ABSPATH . "wp-config.php")) {
    if (site_url() === home_url()) {
      $path = ABSPATH;
    } else {
      $path = dirname(ABSPATH);
    }
  }
  
  if ($trailingSlash) {
    $path = trailingslashit($path);
  } else { $path = untrailingslashit($path); }
  
  return $path;
}

function home_link($echo = false) {
  $echo = (is_bool($echo)) ? $echo : false;
  $returnValue = get_option("home");
  
  if ($echo) {
    echo $returnValue;
  } else {
    return $returnValue;
  }
}

function get_sort_taxonomy($post_type = null) {
  switch ($post_type) {
    case "projects":
      $rVal = "project_status";
      break;
    case "post":
    default:
      $rVal = "category";
  }

  return $rVal;
}

function get_default_header_image() {
  $image = null;
  if (have_rows("default_settings", "option")) {
    while(have_rows("default_settings", "option")) {
      the_row();
      $image = get_sub_field("header_image");
      $image = ($image) ? $image : null;
    }
  }

  return $image;
}

function get_page_header_image() {
  global $post;
  $image = null;
  if (has_post_thumbnail()) $image = get_post_thumbnail_id();

  return $image;
}

function bceo_featured_image($echo = true) {
  global $post;
  global $post_type;

  $image_id = null;

  $rVal = "";
  /**
   * @todo Add alt text to image tag
   */
  if (has_post_thumbnail()) {
    $image_id = get_post_thumbnail_id(get_the_ID());
  } else {
    $settings = sprintf('%s_settings', ($post_type ? $post_type : 'default'));
    $default_settings = 'default_settings';

    if (have_rows($settings, "option")) {
      while(have_rows($settings, "option")) {
        the_row();
        $image_id = get_sub_field('default_featured_image');
      }
    }

    if (!$image_id) {
      if (have_rows($default_settings, "option")) {
        while(have_rows($default_settings, "option")) {
          the_row();
          $image_id = get_sub_field('default_featured_image');
        }
      }
    }
  }
  if ($image_id) {
    $image = wp_get_attachment_image_src($image_id, 'featured-image-md', false);
    $rVal = "<img src=\"" . esc_url($image[0]) . "\" alt=\"\" class=\"img-fluid $post_type\">";
  }
  
  if ($echo) echo $rVal; else return $rVal;
}

/**
 * Get the current archive post type name (e.g: post, page, product).
 *
 * @return String|Boolean  The archive post type name or false if not in an archive page.
 */
function get_archive_post_type() {
  return is_archive() ? get_queried_object()->post_name : false;
}